<?php
/**
 * DIGITAL SOLUTIONS — api/bestill.php
 * Recebe o pedido de landing page (dsnorge.com/bestill.html), grava em MySQL,
 * guarda logo e fotos fora do public_html, avisa info@dsnorge.com, confirma ao
 * cliente e devolve o endereço do pagamento no Stripe.
 *
 * Onde instalar (Domeneshop): pasta ~/api do webhotell, que responde por
 * api.dsnorge.com → https://api.dsnorge.com/bestill.php
 * Requisitos: PHP 8.1+, pdo_mysql, fileinfo, função mail() habilitada.
 *
 * Os dados do cliente ficam só no seu Domeneshop. O Stripe recebe apenas o
 * e-mail e a referência do pedido (DS-000123), para ligar o pagamento ao pedido.
 *
 * Documento controlado: DOC-WEB-API-003 · v1.1.0
 */

declare(strict_types=1);

/* ─── Configuração ────────────────────────────────────────── */
const ORIGENS      = ['https://dsnorge.com', 'https://www.dsnorge.com'];
const LIMITE_HORA  = 5;                        // pedidos por IP por hora
const STRIPE_LINK  = 'https://buy.stripe.com/8x200ka6v07Y28SaYm73G00';
const TERMOS_VERSAO = '2026-11-05';            // data no topo de /vilkar.html
const MINSIDE      = 'https://minside.dsnorge.com/';

// Senha e dados do banco ficam SÓ no servidor, em ~/ds-app/config.php
// (o mesmo arquivo do Min side). Sem esse arquivo, o pedido segue só por e-mail.
$cfg = dirname(__DIR__) . '/ds-app/config.php';
if (is_file($cfg)) { require $cfg; }
if (!defined('DESTINO'))   { define('DESTINO', 'info@dsnorge.com'); }
if (!defined('REMETENTE')) { define('REMETENTE', 'no-reply@dsnorge.com'); }
define('DB_ATIVO', defined('DB_SENHA') && DB_SENHA !== 'TROCAR_ESTA_SENHA');

// Pasta FORA da pasta pública para logo e fotos. No Domeneshop, api.dsnorge.com
// aponta para ~/api, então os arquivos ficam em ~/bestillinger-filer (criada sozinha).
define('PASTA_ARQUIVOS', dirname(__DIR__) . '/bestillinger-filer');
const MAX_ARQUIVOS   = 6;
const MAX_BYTES      = 8 * 1024 * 1024;        // por arquivo
const TIPOS_ACEITOS  = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

const MODELOS = [
    'handverk' => 'Håndverk og service',
    'mat'      => 'Mat og butikk',
    'velvaere' => 'Velvære og timer',
];

/* ─── CORS e método ─────────────────────────────────────── */
$origem = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origem, ORIGENS, true)) {
    header("Access-Control-Allow-Origin: $origem");
    header('Vary: Origin');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
}
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    responder(405, 'metodo_nao_permitido', 'Use POST.');
}

/* ─── Entrada (multipart/form-data) ─────────────────────── */
$campo = static fn(string $k, int $max = 500): string =>
    mb_substr(trim((string)($_POST[$k] ?? '')), 0, $max);

// Armadilha anti-robô: humano não preenche.
if ($campo('website') !== '') {
    responder(200, 'ok', 'Recebido.', ['redirect' => 'https://dsnorge.com/takk.html']);
}

$modelo     = $campo('modelo', 20);
$empresa    = $campo('empresa', 160);
$orgnr      = preg_replace('/\D/', '', $campo('orgnr', 20)) ?? '';
$contato    = $campo('contato', 120);
$email      = $campo('email', 180);
$telefone   = $campo('telefone', 40);
$subdominio = strtolower($campo('subdominio', 40));
$descricao  = $campo('descricao', 4000);
$horario    = $campo('horario', 2000);
$facebook   = $campo('facebook', 300);
$instagram  = $campo('instagram', 300);
$idioma     = in_array($campo('idioma', 5), ['pt', 'en', 'no', 'es'], true) ? $campo('idioma', 5) : 'no';

$erros = [];
if (!isset(MODELOS[$modelo]))                                $erros[] = 'modelo';
if (mb_strlen($empresa) < 2)                                 $erros[] = 'empresa';
if (!orgnr_valido($orgnr))                                   $erros[] = 'orgnr';
if (mb_strlen($contato) < 2)                                 $erros[] = 'contato';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))              $erros[] = 'email';
if (strlen(preg_replace('/\D/', '', $telefone) ?? '') < 8)   $erros[] = 'telefone';
if ($subdominio !== '' && !preg_match('/^[a-z0-9](?:[a-z0-9-]{0,38}[a-z0-9])?$/', $subdominio))
                                                             $erros[] = 'subdominio';
if (mb_strlen($descricao) < 20)                              $erros[] = 'descricao';
foreach (['facebook' => $facebook, 'instagram' => $instagram] as $k => $url) {
    if ($url !== '' && !filter_var($url, FILTER_VALIDATE_URL)) $erros[] = $k;
}
if (empty($_POST['termos']))                                 $erros[] = 'termos';
if ($erros) {
    responder(422, 'dados_invalidos', 'Campos inválidos: ' . implode(', ', $erros), ['campos' => $erros]);
}

/* ─── Limite por IP ─────────────────────────────────────── */
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$ip = trim(explode(',', $ip)[0]);
$marca = sys_get_temp_dir() . '/ds_bestill_' . hash('sha256', $ip) . '.txt';
$agora = time();
$batidas = is_file($marca)
    ? array_filter(array_map('intval', explode("\n", (string)file_get_contents($marca))),
                   static fn(int $t): bool => $t > $agora - 3600)
    : [];
if (count($batidas) >= LIMITE_HORA) {
    responder(429, 'limite_excedido', 'Muitos envios. Tente novamente daqui a pouco.');
}
$batidas[] = $agora;
@file_put_contents($marca, implode("\n", $batidas), LOCK_EX);

/* ─── Referência provisória (vira DS-000123 com o banco) ── */
$ref = 'DS-' . date('ymdHis');

/* ─── Arquivos ──────────────────────────────────────────── */
$salvos = [];
$lista = normalizar_arquivos($_FILES['arquivos'] ?? null);
if (count($lista) > MAX_ARQUIVOS) {
    responder(422, 'dados_invalidos', 'Arquivos demais.', ['campos' => ['arquivos']]);
}
if ($lista) {
    if (!is_dir(PASTA_ARQUIVOS) && !@mkdir(PASTA_ARQUIVOS, 0750, true)) {
        error_log('[ds/bestill] não consegui criar ' . PASTA_ARQUIVOS);
        $lista = [];   // segue sem arquivos; o cliente pode mandar depois
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    foreach ($lista as $i => $f) {
        if ($f['error'] !== UPLOAD_ERR_OK || $f['size'] > MAX_BYTES || !is_uploaded_file($f['tmp_name'])) {
            responder(422, 'dados_invalidos', 'Arquivo inválido ou grande demais.', ['campos' => ['arquivos']]);
        }
        $tipo = $finfo->file($f['tmp_name']) ?: '';
        if (!isset(TIPOS_ACEITOS[$tipo])) {
            responder(422, 'dados_invalidos', 'Tipo de arquivo não aceito.', ['campos' => ['arquivos']]);
        }
        $nome = sprintf('%s-%02d-%s.%s', $ref, $i + 1, bin2hex(random_bytes(4)), TIPOS_ACEITOS[$tipo]);
        if (move_uploaded_file($f['tmp_name'], PASTA_ARQUIVOS . '/' . $nome)) {
            @chmod(PASTA_ARQUIVOS . '/' . $nome, 0640);
            $salvos[] = $nome;
        }
    }
}

/* ─── Banco ─────────────────────────────────────────────── */
if (DB_ATIVO) {
    try {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NOME . ';charset=utf8mb4',
            DB_USER, DB_SENHA,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
        );
        $pdo->beginTransaction();
        $pdo->prepare(
            'INSERT INTO bestillinger
             (criado_em, ref, modelo, empresa, orgnr, contato, email, telefone, subdominio,
              descricao, horario, facebook, instagram, arquivos, idioma, termos_versao, ip_hash)
             VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        )->execute([
            $ref, $modelo, $empresa, $orgnr, $contato, $email, $telefone, $subdominio ?: null,
            $descricao, $horario ?: null, $facebook ?: null, $instagram ?: null,
            $salvos ? json_encode($salvos) : null, $idioma, TERMOS_VERSAO, hash('sha256', $ip),
        ]);
        $id = (int)$pdo->lastInsertId();
        $novaRef = sprintf('DS-%06d', $id);
        $pdo->prepare('UPDATE bestillinger SET ref = ? WHERE id = ?')->execute([$novaRef, $id]);
        $pdo->commit();
        $ref = $novaRef;
    } catch (Throwable $e) {
        if (isset($pdo) && $pdo->inTransaction()) { $pdo->rollBack(); }
        error_log('[ds/bestill] banco: ' . $e->getMessage());
        // Falha de banco não pode perder o pedido: o e-mail abaixo leva tudo.
    }
}

/* ─── E-mail para você ──────────────────────────────────── */
$linhas = [
    "Referência: $ref",
    'Recebido:   ' . date('Y-m-d H:i:s T'),
    'Modelo:     ' . MODELOS[$modelo],
    '',
    "Bedrift:    $empresa",
    "Org.nr.:    $orgnr",
    "Kontakt:    $contato",
    "E-post:     $email",
    "Telefon:    $telefone",
    'Adresse:    ' . ($subdominio !== '' ? "$subdominio.dsnorge.com" : '—'),
    'Facebook:   ' . ($facebook ?: '—'),
    'Instagram:  ' . ($instagram ?: '—'),
    '',
    'Om bedriften:',
    $descricao,
    '',
    'Åpningstider / område:',
    $horario ?: '—',
    '',
    'Filer (' . count($salvos) . '): ' . ($salvos ? implode(', ', $salvos) : '—'),
    'Vilkår godtatt: versjon ' . TERMOS_VERSAO,
    "Språk: $idioma",
    '',
    'Neste steg: kunden sendes til Stripe nå. Sjekk i Stripe at abonnementet med',
    "client_reference_id = $ref er opprettet (30 dager prøveperiode).",
];
enviar(DESTINO, "[dsnorge.com · $ref] Ny bestilling — $empresa", implode("\n", $linhas), $email);

/* ─── Confirmação para o cliente (norueguês) ────────────── */
$confirmacao = implode("\n", [
    "Hei $contato,",
    '',
    "Takk for bestillingen av landingsside for $empresa.",
    "Referanse: $ref",
    'Modell: ' . MODELOS[$modelo],
    '',
    'Hva skjer nå:',
    '1. Fullfør registreringen av kortet i betalingsvinduet (hvis du ikke allerede har gjort det).',
    '2. Logg inn på Min side med denne e-postadressen: ' . MINSIDE,
    '   Siden din er allerede fylt ut med det du sendte oss. Juster tekst, bilder og farger.',
    '3. Trykk «Publiser». Vi aktiverer adressen din, normalt innen én virkedag.',
    '',
    'Pris: 399 kr/mnd, totalpris. De første 30 dagene er gratis. Første trekk skjer',
    'når siden publiseres, eller senest etter 30 dager.',
    'Vilkår: https://dsnorge.com/vilkar.html',
    '',
    'Spørsmål? Svar på denne e-posten og oppgi referansen.',
    '',
    'Vennlig hilsen',
    'Digital Solutions · dsnorge.com',
]);
enviar($email, "Bestilling mottatt – $ref", $confirmacao, DESTINO);

/* ─── Resposta: segue para o Stripe ─────────────────────── */
$redirect = STRIPE_LINK . '?' . http_build_query([
    'prefilled_email'     => $email,
    'client_reference_id' => $ref,
    'locale'              => $idioma === 'no' ? 'nb' : $idioma,
]);
responder(200, 'ok', 'Pedido recebido.', ['ref' => $ref, 'redirect' => $redirect]);

/* ─── Funções ───────────────────────────────────────────── */
function orgnr_valido(string $n): bool
{
    // Org.nr. norueguês: 9 dígitos, dígito de controle módulo 11.
    if (!preg_match('/^\d{9}$/', $n)) { return false; }
    $pesos = [3, 2, 7, 6, 5, 4, 3, 2];
    $soma = 0;
    foreach ($pesos as $i => $p) { $soma += (int)$n[$i] * $p; }
    $resto = $soma % 11;
    $dv = $resto === 0 ? 0 : 11 - $resto;
    return $dv !== 10 && $dv === (int)$n[8];
}

function normalizar_arquivos(?array $f): array
{
    if (!$f || !isset($f['name'])) { return []; }
    if (!is_array($f['name'])) { $f = array_map(static fn($v) => [$v], $f); }
    $saida = [];
    foreach ($f['name'] as $i => $nome) {
        if (($f['error'][$i] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) { continue; }
        $saida[] = [
            'name' => (string)$nome, 'tmp_name' => (string)$f['tmp_name'][$i],
            'size' => (int)$f['size'][$i], 'error' => (int)$f['error'][$i],
        ];
    }
    return $saida;
}

function enviar(string $para, string $assunto, string $corpo, string $responderPara): void
{
    $cab = implode("\r\n", [
        'From: Digital Solutions <' . REMETENTE . '>',
        'Reply-To: ' . $responderPara,
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
        'X-Mailer: dsnorge.com',
    ]);
    if (!@mail($para, mb_encode_mimeheader($assunto), $corpo, $cab)) {
        error_log("[ds/bestill] mail() falhou para $para ($assunto)");
    }
}

function responder(int $http, string $estado, string $texto, array $extra = []): never
{
    http_response_code($http);
    echo json_encode(
        ['estado' => $estado, 'mensagem' => $texto] + $extra,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
    exit;
}
