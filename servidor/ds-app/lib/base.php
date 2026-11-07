<?php
/**
 * DIGITAL SOLUTIONS — funções comuns do Min side e das páginas dos clientes.
 * DOC-WEB-MS-003 · v1.2.0
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/sprak.php';

// Valores novos com padrão, para um config.php antigo continuar valendo.
if (!defined('SIDE_HOST'))    { define('SIDE_HOST', 'side.dsnorge.com'); }
if (!defined('AUTO_AKTIVER')) { define('AUTO_AKTIVER', true); }

mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Oslo');

/* ─── Banco ─────────────────────────────────────────────── */
function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NOME . ';charset=utf8mb4',
            DB_USER, DB_SENHA,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
    }
    return $pdo;
}

function q(string $sql, array $p = []): PDOStatement
{
    $st = db()->prepare($sql);
    $st->execute($p);
    return $st;
}

/* ─── Saída ─────────────────────────────────────────────── */
function e(?string $s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Texto com quebras de linha → parágrafos/linhas seguros. */
function avsnitt(?string $s): string
{
    $s = trim((string)$s);
    if ($s === '') { return ''; }
    $blokker = preg_split("/\R{2,}/u", $s) ?: [];
    $ut = '';
    foreach ($blokker as $b) {
        $ut .= '<p>' . nl2br(e(trim($b)), false) . '</p>';
    }
    return $ut;
}

/* ─── Host ──────────────────────────────────────────────── */
function host(): string
{
    $h = strtolower((string)($_SERVER['HTTP_HOST'] ?? ''));
    $h = preg_replace('/:\d+$/', '', $h) ?? '';
    return preg_replace('/^www\./', '', $h) ?? '';
}

function minside_url(string $sti = '/'): string
{
    return (HTTPS ? 'https://' : 'http://') . MINSIDE_HOST . port_suffiks() . $sti;
}

/** Endereço público da página: https://side.dsnorge.com/<slug> */
function side_url(string $slug): string
{
    return side_rot() . '/' . $slug;
}

function side_rot(): string
{
    return (HTTPS ? 'https://' : 'http://') . SIDE_HOST . port_suffiks();
}

/** Endereço público de um cliente: o domínio próprio, se tiver, senão side.dsnorge.com/<slug>. */
function kunde_url(array $k): string
{
    return !empty($k['domene']) ? 'https://' . $k['domene'] : side_url((string)$k['slug']);
}

function kunde_adresse(array $k): string
{
    return !empty($k['domene']) ? (string)$k['domene'] : side_adresse((string)$k['slug']);
}

/** Domínio digitado no admin → forma limpa (sem https://, www. e barra), ou '' se inválido. */
function rens_domene(string $d): string
{
    $d = strtolower(trim($d));
    $d = preg_replace('~^https?://~', '', $d) ?? '';
    $d = preg_replace('~^www\.~', '', $d) ?? '';
    $d = rtrim(explode('/', $d)[0], '.');
    if (function_exists('idn_to_ascii') && preg_match('/[^\x20-\x7e]/', $d)) { $d = (string)idn_to_ascii($d); }
    return preg_match('/^(?=.{4,100}$)([a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,}$/', $d)
        && !str_ends_with($d, BASE_DOMENE) ? $d : '';
}

/** Como o endereço aparece em textos: side.dsnorge.com/<slug> */
function side_adresse(string $slug): string
{
    return SIDE_HOST . '/' . $slug;
}

function port_suffiks(): string
{
    // Só faz diferença em testes locais (ex.: :8090)
    $h = (string)($_SERVER['HTTP_HOST'] ?? '');
    return preg_match('/(:\d+)$/', $h, $m) && !HTTPS ? $m[1] : '';
}

/* ─── Sessão (só no Min side) ───────────────────────────── */
function start_okt(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) { return; }
    $dir = DATA_DIR . '/okter';
    if (!is_dir($dir)) { @mkdir($dir, 0700, true); }
    if (is_dir($dir) && is_writable($dir)) { session_save_path($dir); }
    session_name('ds_minside');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => HTTPS,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    ini_set('session.use_strict_mode', '1');
    ini_set('session.gc_maxlifetime', (string)(8 * 3600));
    session_start();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
}

function csrf_felt(): string
{
    return '<input type="hidden" name="csrf" value="' . e($_SESSION['csrf'] ?? '') . '">';
}

function krev_csrf(): void
{
    $t = (string)($_POST['csrf'] ?? '');
    if (!hash_equals((string)($_SESSION['csrf'] ?? ''), $t)) {
        // Envio grande demais: o PHP descarta tudo e o formulário chega vazio.
        if (!$_POST && (int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
            flash(t('for_store'), 'feil');
            videre('/');
        }
        http_response_code(400);
        header('Content-Type: text/plain; charset=utf-8');
        exit(t('okt_utlopt'));
    }
}

function flash(?string $melding = null, string $type = 'ok'): ?array
{
    if ($melding !== null) {
        $_SESSION['flash'] = ['tekst' => $melding, 'type' => $type];
        return null;
    }
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

function videre(string $sti): never
{
    header('Location: ' . $sti, true, 303);
    exit;
}

function ip_hash(): string
{
    return hash('sha256', 'ds|' . ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'));
}

/* ─── E-post ────────────────────────────────────────────── */
function send_epost(string $til, string $emne, string $tekst, ?string $svarTil = null): bool
{
    $emneKod = '=?UTF-8?B?' . base64_encode($emne) . '?=';
    $hoder = [
        'From: Digital Solutions <' . REMETENTE . '>',
        'Reply-To: ' . ($svarTil ?: DESTINO),
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
    ];
    if (EPOST_TIL_FIL !== '') {
        file_put_contents(EPOST_TIL_FIL, "TIL: $til\nEMNE: $emne\n\n$tekst\n-----\n", FILE_APPEND);
        return true;
    }
    $ok = @mail($til, $emneKod, $tekst, implode("\r\n", $hoder), '-f' . REMETENTE);
    if (!$ok) { error_log("[ds/minside] e-post feilet til $til"); }
    return $ok;
}

/* ─── Diverse ───────────────────────────────────────────── */
function slugify(string $s): string
{
    $s = mb_strtolower(trim($s));
    $s = strtr($s, ['æ' => 'ae', 'ø' => 'o', 'å' => 'a', 'ä' => 'a', 'ö' => 'o', 'ü' => 'u', 'é' => 'e', 'è' => 'e', '&' => '-og-']);
    $s = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s) ?: $s;
    $s = preg_replace('/[^a-z0-9]+/', '-', $s) ?? '';
    $s = trim(preg_replace('/-+/', '-', $s) ?? '', '-');
    $s = substr($s, 0, 40);
    return rtrim($s, '-');
}

const RESERVERTE_SLUGS = ['assets', 'robots', 'favicon', 'www', 'api', 'minside', 'admin', 'mail', 'epost', 'ftp', 'smtp', 'imap', 'pop',
    'webmail', 'dsnorge', 'ds', 'test', 'demo', 'static', 'cdn', 'm', 'side', 'blogg', 'shop', 'butikk', 'support', 'hjelp'];

function slug_gyldig(string $s): bool
{
    return (bool)preg_match('/^[a-z0-9](?:[a-z0-9-]{0,38}[a-z0-9])?$/', $s)
        && !in_array($s, RESERVERTE_SLUGS, true);
}

function ledig_slug(string $onsket, ?int $unntakId = null): string
{
    $base = slugify($onsket);
    if (!slug_gyldig($base)) { $base = 'firma'; }
    $kandidat = $base;
    for ($i = 2; $i < 500; $i++) {
        $rad = q('SELECT id FROM kunder WHERE slug = ?', [$kandidat])->fetch();
        if (!$rad || ($unntakId !== null && (int)$rad['id'] === $unntakId)) {
            if (!in_array($kandidat, RESERVERTE_SLUGS, true)) { return $kandidat; }
        }
        $kandidat = substr($base, 0, 36) . '-' . $i;
    }
    return $base . '-' . bin2hex(random_bytes(3));
}

function trygg_url(?string $u): string
{
    $u = trim((string)$u);
    if ($u === '') { return ''; }
    if (!preg_match('~^https?://~i', $u)) { $u = 'https://' . $u; }
    if (!filter_var($u, FILTER_VALIDATE_URL)) { return ''; }
    $skjema = strtolower((string)parse_url($u, PHP_URL_SCHEME));
    return in_array($skjema, ['http', 'https'], true) ? $u : '';
}

function er_admin(?string $epost): bool
{
    return $epost !== null && in_array(strtolower($epost), array_map('strtolower', ADMIN_EPOST), true);
}

function json_les(?string $s): array
{
    $d = json_decode((string)$s, true);
    return is_array($d) ? $d : [];
}

function json_skriv(array $d): string
{
    return json_encode($d, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
}
