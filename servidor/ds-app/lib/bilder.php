<?php
/**
 * DIGITAL SOLUTIONS — recebe as imagens do cliente, corrige a rotação,
 * reduz o tamanho e salva como WebP (ou JPEG/PNG se o servidor não tiver WebP).
 * O arquivo é sempre redesenhado: nada do arquivo original vai para o ar.
 * DOC-WEB-MS-005 · v1.0.0
 */
declare(strict_types=1);

const BILDE_MAKS_BYTES = 15 * 1024 * 1024;
const BILDE_MAKS_PIKSLER = 40_000_000;   // 40 megapixels
const BILDE_TYPER = ['image/jpeg', 'image/png', 'image/webp'];
const MAKS_FILER_PER_KUNDE = 60;

/**
 * @param string $type 'logo' (até 800 px, mantém transparência) ou 'foto' (até 1800 px)
 * @return string|null nome do arquivo relativo a MEDIA_DIR (ex.: "12/ab12cd34.webp")
 */
function lagre_bilde(string $kilde, int $kundeId, string $type): ?string
{
    if (!is_file($kilde) || filesize($kilde) > BILDE_MAKS_BYTES) { return null; }
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($kilde) ?: '';
    if (!in_array($mime, BILDE_TYPER, true)) { return null; }
    $info = @getimagesize($kilde);
    if (!$info || $info[0] < 1 || $info[1] < 1 || $info[0] * $info[1] > BILDE_MAKS_PIKSLER) { return null; }

    @ini_set('memory_limit', '384M');
    $img = match ($mime) {
        'image/jpeg' => @imagecreatefromjpeg($kilde),
        'image/png'  => @imagecreatefrompng($kilde),
        'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($kilde) : false,
        default      => false,
    };
    if (!$img) { return null; }

    // Fotos de celular: aplica a rotação gravada no EXIF.
    if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
        $exif = @exif_read_data($kilde);
        $rot = match ((int)($exif['Orientation'] ?? 1)) { 3 => 180, 6 => -90, 8 => 90, default => 0 };
        if ($rot !== 0) {
            $r = imagerotate($img, $rot, 0);
            if ($r) { imagedestroy($img); $img = $r; }
        }
    }

    $maks = $type === 'logo' ? 800 : 1800;
    $b = imagesx($img);
    $h = imagesy($img);
    $skala = min(1, $maks / max($b, $h));
    $nb = max(1, (int)round($b * $skala));
    $nh = max(1, (int)round($h * $skala));
    $ut = imagecreatetruecolor($nb, $nh);
    imagealphablending($ut, false);
    imagesavealpha($ut, true);
    imagefill($ut, 0, 0, imagecolorallocatealpha($ut, 0, 0, 0, 127));
    imagecopyresampled($ut, $img, 0, 0, 0, 0, $nb, $nh, $b, $h);
    imagedestroy($img);

    $mappe = MEDIA_DIR . '/' . $kundeId;
    if (!is_dir($mappe) && !@mkdir($mappe, 0755, true)) {
        error_log("[ds/minside] kan ikke lage $mappe");
        return null;
    }
    $antall = count(glob($mappe . '/*') ?: []);
    if ($antall >= MAKS_FILER_PER_KUNDE) { rydd_bilder($kundeId); }

    $navn = bin2hex(random_bytes(8));
    if (function_exists('imagewebp')) {
        $fil = "$navn.webp";
        $ok = imagewebp($ut, "$mappe/$fil", $type === 'logo' ? 90 : 80);
    } elseif ($type === 'logo') {
        $fil = "$navn.png";
        $ok = imagepng($ut, "$mappe/$fil", 8);
    } else {
        $fil = "$navn.jpg";
        $ok = imagejpeg($ut, "$mappe/$fil", 82);
    }
    imagedestroy($ut);
    if (!$ok) { return null; }
    @chmod("$mappe/$fil", 0644);
    return "$kundeId/$fil";
}

function bilde_url(string $fil): string
{
    return '/m/' . str_replace('%2F', '/', rawurlencode($fil));
}

/** O nome do arquivo pertence a este cliente? (evita apontar para fotos de outro) */
function eget_bilde(string $fil, int $kundeId): bool
{
    return (bool)preg_match('~^' . $kundeId . '/[a-f0-9]{16}\.(webp|png|jpg)$~', $fil)
        && is_file(MEDIA_DIR . '/' . $fil);
}

/** Apaga arquivos que não estão nem no rascunho nem na versão publicada. */
function rydd_bilder(int $kundeId): void
{
    $rad = q('SELECT utkast, publisert FROM kunder WHERE id = ?', [$kundeId])->fetch();
    if (!$rad) { return; }
    $iBruk = [];
    foreach ([json_les($rad['utkast']), json_les($rad['publisert'])] as $inn) {
        foreach (['logo', 'toppbilde'] as $k) { if (!empty($inn[$k])) { $iBruk[$inn[$k]] = true; } }
        foreach ((array)($inn['galleri'] ?? []) as $g) { $iBruk[$g] = true; }
    }
    foreach (glob(MEDIA_DIR . '/' . $kundeId . '/*') ?: [] as $sti) {
        $rel = $kundeId . '/' . basename($sti);
        if (!isset($iBruk[$rel]) && filemtime($sti) < time() - 3600) { @unlink($sti); }
    }
}
