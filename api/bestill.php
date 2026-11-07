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
 * Documento controlado: DOC-WEB-API-003 · v1.2.0 (país + CNPJ + e-mail em 4 idiomas)
 */

declare(strict_types=1);

/* ─── Configuração ────────────────────────────────────────── */
const ORIGENS      = ['https://dsnorge.com', 'https://www.dsnorge.com'];
const LIMITE_HORA  = 5;                        // pedidos por IP por hora
const STRIPE_LINK  = 'https://buy.stripe.com/8x200ka6v07Y28SaYm73G00';
const TERMOS_VERSAO = '2026-11-07';            // data no topo de /vilkar.html
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

const MODELOS = [                              // e-mail interno (norueguês)
    'handverk' => 'Tjenester og håndverk',
    'mat'      => 'Mat, butikk og varer',
    'velvaere' => 'Timebestilling og velvære',
];
const MODELOS_IDIOMA = [                       // confirmação ao cliente
    'no' => MODELOS,
    'pt' => ['handverk' => 'Serviços e profissionais', 'mat' => 'Comida, loja e produtos', 'velvaere' => 'Agendamento e bem-estar'],
    'en' => ['handverk' => 'Services and trades', 'mat' => 'Food, shop and products', 'velvaere' => 'Appointments and wellness'],
    'es' => ['handverk' => 'Servicios y profesionales', 'mat' => 'Comida, tienda y productos', 'velvaere' => 'Citas y bienestar'],
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
$land       = in_array($campo('land', 2), ['NO', 'BR', 'XX'], true) ? $campo('land', 2) : 'NO';
$orgnr      = orgnr_normalizar($land, $campo('orgnr', 40));
$contato    = $campo('contato', 120);
$email      = $campo('email', 180);
$telefone   = $campo('telefone', 40);
$subdominio = strtolower($campo('subdominio', 40));
$descricao  = $campo('descricao', 4000);
$horario    = $campo('horario', 2000);
$facebook   = $campo('facebook', 300);
$instagram  = $campo('instagram', 300);
$kilde      = in_array($campo('kilde', 20), ['facebook', 'instagram', 'google', 'flyer', 'anbefaling', 'annet'], true) ? $campo('kilde', 20) : null;
$utm        = trim(preg_replace('/[^\p{L}\p{N} _.\/-]/u', '', $campo('utm', 150)) ?? '') ?: null;
$idioma     = in_array($campo('idioma', 5), ['pt', 'en', 'no', 'es'], true) ? $campo('idioma', 5) : 'no';

$erros = [];
if (!isset(MODELOS[$modelo]))                                $erros[] = 'modelo';
if (mb_strlen($empresa) < 2)                                 $erros[] = 'empresa';
if (!orgnr_ok($land, $orgnr))                                $erros[] = 'orgnr';
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
             (criado_em, ref, modelo, empresa, land, orgnr, contato, email, telefone, subdominio,
              descricao, horario, facebook, instagram, arquivos, kilde, utm, idioma, termos_versao, ip_hash)
             VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        )->execute([
            $ref, $modelo, $empresa, $land, $orgnr, $contato, $email, $telefone, $subdominio ?: null,
            $descricao, $horario ?: null, $facebook ?: null, $instagram ?: null,
            $salvos ? json_encode($salvos) : null, $kilde, $utm, $idioma, TERMOS_VERSAO, hash('sha256', $ip),
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
    'Land:       ' . ['NO' => 'Norge', 'BR' => 'Brasil', 'XX' => 'Annet land'][$land],
    ($land === 'BR' ? 'CNPJ:       ' : 'Org.nr.:    ') . orgnr_formatado($land, $orgnr),
    "Kontakt:    $contato",
    "E-post:     $email",
    "Telefon:    $telefone",
    'Adresse:    ' . ($subdominio !== '' ? "side.dsnorge.com/$subdominio" : '—'),
    'Facebook:   ' . ($facebook ?: '—'),
    'Instagram:  ' . ($instagram ?: '—'),
    'Kilde:      ' . ($kilde ?: '—') . ($utm ? '  (kampanje: ' . $utm . ')' : ''),
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

/* ─── Confirmação para o cliente (no idioma do site) ───── */
[$assuntoCliente, $confirmacao] = confirmacao($idioma, $contato, $empresa, $ref, $modelo);
enviar($email, $assuntoCliente, $confirmacao, DESTINO);

/* ─── Resposta: segue para o Stripe ─────────────────────── */
$redirect = STRIPE_LINK . '?' . http_build_query([
    'prefilled_email'     => $email,
    'client_reference_id' => $ref,
    'locale'              => ['no' => 'nb', 'pt' => 'pt-BR', 'en' => 'en', 'es' => 'es'][$idioma],
]);
responder(200, 'ok', 'Pedido recebido.', ['ref' => $ref, 'redirect' => $redirect]);

/* ─── Funções ───────────────────────────────────────────── */

/** Guarda só o essencial: dígitos (NO), 14 caracteres maiúsculos (BR) ou o texto limpo (outro país). */
function orgnr_normalizar(string $land, string $v): string
{
    return match ($land) {
        'NO'    => preg_replace('/\D/', '', $v) ?? '',
        'BR'    => strtoupper(preg_replace('/[^0-9A-Za-z]/', '', $v) ?? ''),
        default => trim(preg_replace('/\s+/', ' ', $v) ?? ''),
    };
}

function orgnr_ok(string $land, string $n): bool
{
    return match ($land) {
        'NO'    => orgnr_valido($n),
        'BR'    => cnpj_valido($n),
        default => (bool)preg_match('/^[A-Za-z0-9][A-Za-z0-9 .\/-]{2,29}$/', $n),
    };
}

function orgnr_formatado(string $land, string $n): string
{
    if ($land === 'NO' && strlen($n) === 9) {
        return substr($n, 0, 3) . ' ' . substr($n, 3, 3) . ' ' . substr($n, 6);
    }
    if ($land === 'BR' && strlen($n) === 14) {
        return substr($n, 0, 2) . '.' . substr($n, 2, 3) . '.' . substr($n, 5, 3) . '/' . substr($n, 8, 4) . '-' . substr($n, 12);
    }
    return $n;
}

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

/**
 * CNPJ brasileiro, numérico ou alfanumérico (Receita Federal, a partir de jul/2026):
 * 12 caracteres [0-9A-Z] + 2 dígitos verificadores; valor de cada caractere = código ASCII − 48.
 */
function cnpj_valido(string $c): bool
{
    if (!preg_match('/^[0-9A-Z]{12}[0-9]{2}$/', $c) || preg_match('/^(.)\1{13}$/', $c)) { return false; }
    $dv = static function (string $base): int {
        $pesos = strlen($base) === 12 ? [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2] : [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        foreach ($pesos as $i => $p) { $soma += (ord($base[$i]) - 48) * $p; }
        $r = $soma % 11;
        return $r < 2 ? 0 : 11 - $r;
    };
    $d1 = $dv(substr($c, 0, 12));
    $d2 = $dv(substr($c, 0, 12) . $d1);
    return $c[12] === (string)$d1 && $c[13] === (string)$d2;
}

/** Assunto e texto da confirmação ao cliente, no idioma em que ele fez o pedido. */
function confirmacao(string $idioma, string $contato, string $empresa, string $ref, string $modelo): array
{
    $v = TERMOS_VERSAO;
    $m = MINSIDE;
    $mod = MODELOS_IDIOMA[$idioma][$modelo] ?? MODELOS[$modelo];
    $t = [
        'no' => [
            "Bestilling mottatt – $ref",
            "Hei $contato,", "Takk for bestillingen av landingsside for $empresa.", "Referanse: $ref", "Modell: $mod",
            'Hva skjer nå:',
            '1. Fullfør registreringen av kortet i betalingsvinduet (hvis du ikke allerede har gjort det).',
            "2. Logg inn på Min side med denne e-postadressen: $m\n   Siden din er allerede fylt ut med det du sendte oss. Juster tekst, bilder, farger og språk.",
            '3. Trykk «Publiser», så er siden på nett med en gang.',
            "Pris: 399 kr/mnd, totalpris. De første 30 dagene er gratis. Første trekk skjer\nnår siden publiseres, eller senest etter 30 dager.",
            "Viktige vilkår (du har godtatt versjon $v):",
            [
                "399 kr/mnd, totalpris. Ingen bindingstid: du kan si opp når som helst,\n  og oppsigelsen gjelder ut måneden du har betalt for.",
                "Du er selv ansvarlig for alt innhold på siden din: tekst, bilder,\n  priser og lenker. Innholdet må være lovlig og ikke krenke andres\n  rettigheter (opphavsrett, varemerker, personvern).",
                "Siden kan ikke brukes til ulovlige varer eller tjenester, svindel,\n  villedende reklame, hets, seksuelt innhold eller andres\n  personopplysninger uten samtykke.",
                "Vi kontrollerer ikke innholdet før publisering, men kan ta ned siden\n  straks hvis den bryter med loven eller vilkårene.",
            ],
            'Fullstendige vilkår: https://dsnorge.com/vilkar.html',
            'Spørsmål? Svar på denne e-posten og oppgi referansen.',
            'Vennlig hilsen',
        ],
        'pt' => [
            "Pedido recebido – $ref",
            "Olá, $contato,", "Obrigado pelo pedido da landing page de $empresa.", "Referência: $ref", "Modelo: $mod",
            'O que acontece agora:',
            '1. Conclua o cadastro do cartão na janela de pagamento (se ainda não fez).',
            "2. Entre na sua área (Min side) com este e-mail: $m\n   Sua página já vem preenchida com o que você nos enviou. Ajuste textos, fotos, cores e idioma.",
            '3. Clique em «Publicar» e a página entra no ar na hora.',
            "Preço: 399 NOK/mês, preço total. Os primeiros 30 dias são grátis. A primeira cobrança\nacontece ao publicar a página, ou no máximo após 30 dias. O cartão é cobrado em coroas\nnorueguesas (NOK); o banco do cartão pode acrescentar câmbio e IOF.",
            "Condições importantes (você aceitou a versão $v):",
            [
                "399 NOK/mês, preço total. Sem fidelidade: você pode cancelar quando quiser,\n  e o cancelamento vale até o fim do mês já pago.",
                "Você é o único responsável por todo o conteúdo da página: textos, fotos,\n  preços e links. O conteúdo deve ser legal e não pode violar direitos\n  de terceiros (direitos autorais, marcas, privacidade).",
                "A página não pode ser usada para produtos ou serviços ilegais, fraude,\n  publicidade enganosa, discurso de ódio, conteúdo sexual ou dados\n  pessoais de terceiros sem consentimento.",
                "Não revisamos o conteúdo antes da publicação, mas podemos tirar a\n  página do ar imediatamente se ela violar a lei ou as condições.",
            ],
            'Condições completas: https://dsnorge.com/vilkar.html',
            'Dúvidas? Responda a este e-mail informando a referência.',
            'Atenciosamente,',
        ],
        'en' => [
            "Order received – $ref",
            "Hi $contato,", "Thank you for ordering a landing page for $empresa.", "Reference: $ref", "Model: $mod",
            'What happens now:',
            '1. Finish registering your card in the payment window (if you have not already).',
            "2. Log in to your account (Min side) with this email address: $m\n   Your page is already filled in with what you sent us. Adjust text, photos, colours and language.",
            '3. Press «Publish» and the page is online right away.',
            "Price: NOK 399/month, total price. The first 30 days are free. The first charge\nhappens when the page is published, or after 30 days at the latest. Your card is\ncharged in Norwegian kroner (NOK).",
            "Key terms (you accepted version $v):",
            [
                "NOK 399/month, total price. No commitment: you can cancel at any time,\n  effective at the end of the month you have paid for.",
                "You alone are responsible for all content on your page: text, photos,\n  prices and links. The content must be lawful and must not infringe\n  the rights of others (copyright, trademarks, privacy).",
                "The page may not be used for illegal goods or services, fraud,\n  misleading advertising, hate speech, sexual content or other\n  people's personal data without consent.",
                "We do not review content before publication, but may take the page\n  down at once if it breaks the law or the terms.",
            ],
            'Full terms: https://dsnorge.com/vilkar.html',
            'Questions? Reply to this email and quote the reference.',
            'Kind regards,',
        ],
        'es' => [
            "Pedido recibido – $ref",
            "Hola, $contato:", "Gracias por pedir una landing page para $empresa.", "Referencia: $ref", "Modelo: $mod",
            'Qué pasa ahora:',
            '1. Termina de registrar la tarjeta en la ventana de pago (si aún no lo has hecho).',
            "2. Entra en tu área (Min side) con este correo: $m\n   Tu página ya viene rellenada con lo que nos enviaste. Ajusta textos, fotos, colores e idioma.",
            '3. Pulsa «Publicar» y la página estará en línea al instante.',
            "Precio: 399 NOK/mes, precio total. Los primeros 30 días son gratis. El primer cargo\nse hace al publicar la página o, como máximo, a los 30 días. La tarjeta se cobra\nen coronas noruegas (NOK).",
            "Condiciones importantes (aceptaste la versión $v):",
            [
                "399 NOK/mes, precio total. Sin permanencia: puedes cancelar cuando quieras,\n  y la cancelación vale hasta el final del mes ya pagado.",
                "Eres el único responsable de todo el contenido de tu página: textos,\n  fotos, precios y enlaces. El contenido debe ser legal y no puede\n  vulnerar derechos de terceros (autor, marcas, privacidad).",
                "La página no puede usarse para productos o servicios ilegales, fraude,\n  publicidad engañosa, discurso de odio, contenido sexual ni datos\n  personales de terceros sin consentimiento.",
                "No revisamos el contenido antes de publicarlo, pero podemos retirar\n  la página de inmediato si infringe la ley o las condiciones.",
            ],
            'Condiciones completas: https://dsnorge.com/vilkar.html',
            '¿Dudas? Responde a este correo indicando la referencia.',
            'Saludos,',
        ],
    ][$idioma] ?? null;
    if ($t === null) { return confirmacao('no', $contato, $empresa, $ref, $modelo); }
    [$assunto, $oi, $obrigado, $refL, $modL, $agora, $p1, $p2, $p3, $preco, $vilkTit, $vilk, $completo, $duvida, $tchau] = $t;
    $corpo = implode("\n", [
        $oi, '', $obrigado, $refL, $modL, '', $agora, $p1, $p2, $p3, '', $preco, '',
        $vilkTit, '- ' . implode("\n- ", $vilk), $completo, '', $duvida, '', $tchau,
        'Digital Solutions · dsnorge.com',
    ]);
    return [$assunto, $corpo];
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
