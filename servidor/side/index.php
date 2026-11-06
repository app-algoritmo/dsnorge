<?php
/**
 * DIGITAL SOLUTIONS — porta de entrada de ~/side
 *   minside.dsnorge.com  → área do cliente (Min side) e /admin
 *   side.dsnorge.com/<slug> → landingsside publicada do cliente
 *   <slug>.dsnorge.com   → idem (se um dia o endereço for criado na Domeneshop)
 * Tudo o que não é arquivo (assets, m/) chega aqui pelo .htaccess.
 * DOC-WEB-MS-008 · v1.1.0
 */
declare(strict_types=1);

$app = dirname(__DIR__) . '/ds-app';
require $app . '/lib/base.php';
require $app . '/lib/innhold.php';
require $app . '/lib/bilder.php';
require $app . '/maler/side.php';

header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

$host = host();

if ($host === MINSIDE_HOST) {
    require $app . '/minside.php';
    minside_kjor();
    exit;
}

if ($host === SIDE_HOST) {
    $sti = parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
    $slug = strtolower(trim($sti, '/'));
    if ($slug === '') {
        header('Location: https://' . BASE_DOMENE . '/', true, 302);
        exit;
    }
    if ($sti !== '/' . $slug) {                 // /Firma/ → /firma
        header('Location: ' . side_url($slug), true, 301);
        exit;
    }
    vis_kundeside($slug, true);
    exit;
}

$suffiks = '.' . BASE_DOMENE;
if (str_ends_with($host, $suffiks)) {
    $slug = substr($host, 0, -strlen($suffiks));
    vis_kundeside($slug);
    exit;
}

http_response_code(404);
echo render_ikke_funnet();

function vis_kundeside(string $slug, bool $sti_ok = false): void
{
    header("Content-Security-Policy: default-src 'none'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; font-src 'self'; base-uri 'none'; form-action 'none'; frame-ancestors 'self'");
    $sti = parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
    $kunde = null;
    if (slug_gyldig($slug) && ($sti_ok || in_array($sti, ['/', '/index.html', '/index.php'], true))) {
        try {
            $kunde = q("SELECT * FROM kunder WHERE slug = ? AND status = 'aktiv' AND publisert IS NOT NULL", [$slug])->fetch() ?: null;
        } catch (Throwable $e) {
            error_log('[ds/side] banco: ' . $e->getMessage());
            http_response_code(503);
            header('Retry-After: 120');
            echo render_ikke_funnet();
            return;
        }
    }
    if (!$kunde) {
        http_response_code(404);
        echo render_ikke_funnet();
        return;
    }
    // O navegador sempre confere se há versão nova (publicação aparece na hora);
    // se nada mudou, responde 304 sem montar a página.
    $etag = '"' . substr(hash('sha256', $kunde['sist_publisert'] . '|' . $kunde['publisert_tema'] . '|' . $kunde['publisert_layout'] . '|' . md5((string)$kunde['publisert']) . '|2'), 0, 20) . '"';
    header('Cache-Control: no-cache');
    header('ETag: ' . $etag);
    if (trim((string)($_SERVER['HTTP_IF_NONE_MATCH'] ?? '')) === $etag) {
        http_response_code(304);
        return;
    }
    echo render_side($kunde, json_les($kunde['publisert']), (string)$kunde['publisert_layout'], (string)$kunde['publisert_tema']);
}
