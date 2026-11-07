<?php
/**
 * DIGITAL SOLUTIONS — Min side (minside.dsnorge.com)
 * Login por link no e-mail, editor da página, prévia, publicação e o painel /admin.
 * A interface do cliente segue o idioma dele (lib/sprak.php: no, pt, en, es);
 * o painel /admin fica em norueguês. Comentários em português.
 * DOC-WEB-MS-009 · v1.4.0 (domínio próprio, origem dos pedidos)
 */
declare(strict_types=1);

const TOKEN_MINUTTER   = 30;
const MAKS_LENKER_EPOST = 5;    // por e-post per time
const MAKS_LENKER_IP    = 20;   // por IP per time

function minside_kjor(): void
{
    header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self'; connect-src 'self' https://api.dsnorge.com; font-src 'self'; base-uri 'none'; form-action 'self'; frame-ancestors 'none'");
    header('X-Frame-Options: DENY');
    header('Cache-Control: no-store');
    start_okt();
    // Idioma antes do login: ?lang=pt (fica na sessão), senão o do navegador.
    $valgt = (string)($_GET['lang'] ?? '');
    if (isset(SPRAK[$valgt])) { $_SESSION['sprak'] = $valgt; }
    sprak((string)($_SESSION['sprak'] ?? sprak_fra_nettleser()));

    $sti = parse_url((string)($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/';
    $sti = rtrim($sti, '/') ?: '/';
    $metode = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    try {
        if ($metode === 'POST') { krev_csrf(); }
        match (true) {
            $sti === '/' && $metode === 'GET'               => side_start(),
            $sti === '/logg-inn' && $metode === 'POST'      => handling_send_lenke(),
            $sti === '/inn' && $metode === 'GET'            => side_bekreft_inn(),
            $sti === '/inn' && $metode === 'POST'           => handling_logg_inn(),
            $sti === '/logg-ut' && $metode === 'POST'       => handling_logg_ut(),
            $sti === '/lagre' && $metode === 'POST'         => handling_lagre(),
            $sti === '/forhand' && $metode === 'GET'        => side_forhand(),
            $sti === '/admin' && $metode === 'GET'          => side_admin(),
            $sti === '/admin/handling' && $metode === 'POST' => handling_admin(),
            default                                          => ikke_funnet(),
        };
    } catch (Throwable $e) {
        error_log('[ds/minside] ' . $e::class . ': ' . $e->getMessage() . ' @' . $e->getFile() . ':' . $e->getLine());
        http_response_code(500);
        ramme(t('feil.tittel'), '<div class="boks"><h1>' . th('feil.h') . '</h1><p>' . th('feil.p', '<a href="mailto:' . e(DESTINO) . '">' . e(DESTINO) . '</a>') . '</p></div>');
    }
}

/* ═══ Sessão ═════════════════════════════════════════════════ */

function innlogget(): ?string { return $_SESSION['epost'] ?? null; }

function krev_innlogget(): string
{
    $ep = innlogget();
    if ($ep === null) { videre('/'); }
    return $ep;
}

function krev_admin(): string
{
    $ep = krev_innlogget();
    if (!er_admin($ep)) { ikke_funnet(); }
    return $ep;
}

/** O cliente que está sendo editado (o próprio, ou o escolhido pelo admin). */
function aktiv_kunde(): ?array
{
    $ep = innlogget();
    if ($ep === null) { return null; }
    $k = (er_admin($ep) && !empty($_SESSION['kunde_id']))
        ? q('SELECT * FROM kunder WHERE id = ?', [(int)$_SESSION['kunde_id']])->fetch()
        : q('SELECT * FROM kunder WHERE epost = ?', [$ep])->fetch();
    if (!$k) { return null; }
    sprak((string)($k['sprak'] ?? 'no'));      // o Min side fala a língua do cliente
    return $k;
}

/** Links para trocar o idioma antes do login. */
function sprakvelger(): string
{
    $h = '<p class="sprakvelger">';
    foreach (SPRAK as $kode => $navn) {
        $h .= $kode === sprak()
            ? '<strong lang="' . e(HTML_LANG[$kode]) . '">' . e($navn) . '</strong>'
            : '<a href="?lang=' . e($kode) . '" lang="' . e(HTML_LANG[$kode]) . '" hreflang="' . e(HTML_LANG[$kode]) . '">' . e($navn) . '</a>';
    }
    return $h . '</p>';
}

/* ═══ Login ══════════════════════════════════════════════════ */

function side_start(): void
{
    $ep = innlogget();
    if ($ep === null) { side_logg_inn(); return; }
    $kunde = aktiv_kunde();
    if ($kunde) { side_editor($kunde); return; }
    if (er_admin($ep)) { videre('/admin'); }
    ramme('Min side', '<div class="boks"><h1>' . th('ingen.h') . '</h1><p>'
        . th('ingen.p', e($ep), '<a href="https://dsnorge.com/bestill.html">' . th('ingen.lenke') . '</a>') . '</p>'
        . utlogging() . '</div>');
}

function side_logg_inn(?string $melding = null): void
{
    $f = flash();
    $html = '<div class="boks smal-boks">' . sprakvelger()
        . '<h1>' . th('inn.h') . '</h1>'
        . '<p class="dempet">' . th('inn.p') . '</p>'
        . ($melding ? '<p class="melding ok">' . e($melding) . '</p>' : '')
        . ($f ? '<p class="melding ' . e($f['type']) . '">' . e($f['tekst']) . '</p>' : '')
        . '<form method="post" action="/logg-inn" class="skjema">' . csrf_felt()
        . '<label class="felt"><span>' . th('inn.epost') . '</span><input type="email" name="epost" required autocomplete="email" inputmode="email" maxlength="180"></label>'
        . '<button class="knapp" type="submit">' . th('inn.knapp') . '</button>'
        . '</form>'
        . '<p class="dempet liten">' . th('inn.ny') . ' <a href="https://dsnorge.com/bestill.html">' . th('inn.bestill') . '</a></p>'
        . '</div>';
    ramme(t('inn.tittel'), $html);
}

function handling_send_lenke(): void
{
    $epost = strtolower(trim((string)($_POST['epost'] ?? '')));
    $svar = t('inn.sendt', TOKEN_MINUTTER);
    if (!filter_var($epost, FILTER_VALIDATE_EMAIL) || mb_strlen($epost) > 180) {
        flash(t('inn.ugyldig'), 'feil');
        videre('/');
    }
    $ip = ip_hash();
    $pr_epost = (int)q('SELECT COUNT(*) FROM innlogging WHERE epost = ? AND opprettet > NOW() - INTERVAL 1 HOUR', [$epost])->fetchColumn();
    $pr_ip    = (int)q('SELECT COUNT(*) FROM innlogging WHERE ip_hash = ? AND opprettet > NOW() - INTERVAL 1 HOUR', [$ip])->fetchColumn();
    if ($pr_epost >= MAKS_LENKER_EPOST || $pr_ip >= MAKS_LENKER_IP) {
        flash(t('inn.for_mange'), 'feil');
        videre('/');
    }

    $sideSprak = sprak();
    $rad = q('SELECT id, sprak FROM kunder WHERE epost = ?', [$epost])->fetch();
    if (!$rad && !er_admin($epost) && opprett_fra_bestilling($epost) !== null) {
        $rad = q('SELECT id, sprak FROM kunder WHERE epost = ?', [$epost])->fetch();
    }
    $finnes = (bool)$rad;

    // Registra a tentativa sempre (conta para o limite), mas só envia se existir.
    $token = bin2hex(random_bytes(32));
    q('INSERT INTO innlogging (token_hash, epost, opprettet, utloper, ip_hash) VALUES (?, ?, NOW(), NOW() + INTERVAL ' . TOKEN_MINUTTER . ' MINUTE, ?)',
        [hash('sha256', $token), $epost, $ip]);

    if ($finnes || er_admin($epost)) {
        $lenke = minside_url('/inn?t=' . $token);
        if ($rad) { sprak((string)$rad['sprak']); }          // e-mail na língua do cliente
        send_epost($epost, t('ep.inn.emne'), implode("\n", [
            t('ep.hei'),
            '',
            t('ep.inn.klikk'),
            $lenke,
            '',
            t('ep.inn.gyldig', TOKEN_MINUTTER),
            t('ep.inn.ignorer'),
            '',
            t('ep.hilsen'),
            'Digital Solutions · dsnorge.com',
        ]));
    }
    sprak($sideSprak);                                        // a tela segue na língua escolhida
    side_logg_inn($svar);
}

/** Cria a conta a partir do pedido mais recente feito com este e-mail. */
function opprett_fra_bestilling(string $epost): ?int
{
    try {
        $b = q('SELECT * FROM bestillinger WHERE LOWER(email) = ? AND situacao <> \'cancelado\' ORDER BY id DESC LIMIT 1', [$epost])->fetch();
    } catch (Throwable $e) {
        error_log('[ds/minside] bestillinger: ' . $e->getMessage());
        return null;
    }
    if (!$b) { return null; }
    $forrige = sprak();
    sprak(bestilling_sprak($b));                // textos-padrão (botão etc.) já na língua do cliente
    $inn = innhold_fra_bestilling($b);
    sprak($forrige);
    $slug = ledig_slug(($b['subdominio'] ?? '') !== '' ? $b['subdominio'] : $b['empresa']);
    q('INSERT INTO kunder (opprettet, epost, bestilling_ref, slug, modell, sprak, utkast) VALUES (NOW(), ?, ?, ?, ?, ?, ?)',
        [$epost, $b['ref'], $slug, $b['modelo'], $inn['sprak'], json_skriv($inn)]);
    $id = (int)db()->lastInsertId();

    // Fotos enviadas no pedido viram galeria (o cliente escolhe logo e foto de topo)
    $filer = json_les($b['arquivos'] ?? null);
    foreach ($filer as $fil) {
        if (count($inn['galleri']) >= MAKS_GALLERI) { break; }
        $kilde = BESTILLING_FILER . '/' . basename((string)$fil);
        $ny = lagre_bilde($kilde, $id, 'foto');
        if ($ny) { $inn['galleri'][] = $ny; }
    }
    if ($inn['galleri']) {
        q('UPDATE kunder SET utkast = ? WHERE id = ?', [json_skriv($inn), $id]);
    }
    return $id;
}

/** Brasil → português; Noruega → norueguês; outro país → a língua do site no pedido (ou inglês). */
function bestilling_sprak(array $b): string
{
    $land = (string)($b['land'] ?? 'NO');
    if ($land === 'BR') { return 'pt'; }
    if ($land === 'NO') { return 'no'; }
    $idioma = (string)($b['idioma'] ?? '');
    return in_array($idioma, ['pt', 'en', 'es'], true) ? $idioma : 'en';
}

function side_bekreft_inn(): void
{
    // A entrada só acontece com um clique (POST): leitores de e-mail que
    // abrem os links sozinhos não gastam o código.
    $t = (string)($_GET['t'] ?? '');
    if (!preg_match('/^[a-f0-9]{64}$/', $t)) { flash(t('lenke.ugyldig'), 'feil'); videre('/'); }
    // A língua do e-mail (= a do cliente) também na tela de confirmação.
    $rad = q('SELECT k.sprak FROM innlogging i JOIN kunder k ON k.epost = i.epost WHERE i.token_hash = ?', [hash('sha256', $t)])->fetch();
    if ($rad) { sprak((string)$rad['sprak']); }
    ramme(t('inn.tittel'), '<div class="boks smal-boks"><h1>' . th('inn.tittel') . '</h1><p class="dempet">' . th('inn.bekreft') . '</p>'
        . '<form method="post" action="/inn" class="skjema">' . csrf_felt()
        . '<input type="hidden" name="t" value="' . e($t) . '">'
        . '<button class="knapp" type="submit">' . th('inn.tittel') . '</button></form></div>');
}

function handling_logg_inn(): void
{
    $t = (string)($_POST['t'] ?? '');
    $rad = preg_match('/^[a-f0-9]{64}$/', $t)
        ? q('SELECT * FROM innlogging WHERE token_hash = ? AND brukt IS NULL AND utloper > NOW()', [hash('sha256', $t)])->fetch()
        : false;
    if (!$rad) {
        flash(t('lenke.utlopt'), 'feil');
        videre('/');
    }
    q('UPDATE innlogging SET brukt = NOW() WHERE token_hash = ?', [$rad['token_hash']]);
    $ks = q('SELECT sprak FROM kunder WHERE epost = ?', [$rad['epost']])->fetch();
    if ($ks) { sprak((string)$ks['sprak']); }
    session_regenerate_id(true);
    $_SESSION = ['csrf' => bin2hex(random_bytes(32)), 'epost' => $rad['epost'], 'sprak' => sprak()];
    q('UPDATE kunder SET sist_innlogget = NOW() WHERE epost = ?', [$rad['epost']]);
    videre(er_admin($rad['epost']) ? '/admin' : '/');
}

function handling_logg_ut(): void
{
    $_SESSION = ['sprak' => sprak()];
    session_regenerate_id(true);
    videre('/');
}

function utlogging(): string
{
    return '<form method="post" action="/logg-ut" class="inline">' . csrf_felt() . '<button class="lenkeknapp" type="submit">' . th('utlogg') . '</button></form>';
}

/* ═══ Editor ═════════════════════════════════════════════════ */

function status_tekst(array $k): array
{
    return match ($k['status']) {
        'aktiv'  => [t('st.aktiv'), 'ok', t('st.aktiv.t')],
        'venter' => [t('st.venter'), 'vent', t('st.venter.t')],
        'av'     => [t('st.av'), 'feil', t('st.av.t', DESTINO)],
        default  => [t('st.utkast'), 'info', t('st.utkast.t')],
    };
}

function side_editor(array $k): void
{
    $m   = modell($k['modell']);
    $inn = array_merge(tomt_innhold($k['modell']), json_les($k['utkast']));
    [$stNavn, $stType, $stTekst] = status_tekst($k);
    $f = flash();
    $adresse = kunde_adresse($k);
    $erAdmin = er_admin(innlogget());

    $h  = '';
    if ($erAdmin) {
        $h .= '<p class="admin-stripe">Du redigerer som administrator: <strong>' . e($k['epost']) . '</strong> · <a href="/admin">Tilbake til admin</a></p>';
    }
    $h .= '<div class="hode-rad"><div><h1>' . e($inn['firmanavn'] ?: t('ed.din')) . '</h1>'
        . '<p class="adresse">' . ($k['status'] === 'aktiv'
            ? '<a href="' . e(kunde_url($k)) . '" target="_blank" rel="noopener">' . e($adresse) . ' ↗</a>'
            : e($adresse)) . ' · ' . e($m['navn']) . '</p></div>'
        . '<span class="merkelapp ' . e($stType) . '">' . e($stNavn) . '</span></div>';
    $h .= '<p class="statuslinje">' . e($stTekst) . '</p>';
    if ($f) { $h .= '<p class="melding ' . e($f['type']) . '" role="status">' . e($f['tekst']) . '</p>'; }

    $h .= '<form method="post" action="/lagre" enctype="multipart/form-data" class="editor">' . csrf_felt();

    /* Aparência */
    $h .= '<fieldset class="del"><legend>' . th('ed.utseende') . '</legend>';
    $h .= '<label class="felt"><span>' . th('ed.sprak') . '</span><select name="sprak">';
    foreach (SPRAK as $kode => $navn) {
        $h .= '<option value="' . e($kode) . '" lang="' . e(HTML_LANG[$kode]) . '"' . (($k['sprak'] ?? 'no') === $kode ? ' selected' : '') . '>' . e($navn) . '</option>';
    }
    $h .= '</select><small>' . th('ed.sprak.h') . '</small></label>';
    $h .= '<p class="feltnavn">' . th('ed.oppsett') . '</p><div class="valg-rutenett valg-2">';
    foreach (array_keys(LAYOUTER) as $id) {
        $l = layout_navn($id);
        $h .= '<label class="valg"><input type="radio" name="layout" value="' . e($id) . '"' . ($k['layout'] === $id ? ' checked' : '') . '>'
            . '<span class="valg-kort"><span class="skisse skisse-' . e($id) . '" aria-hidden="true"><i></i><i></i><i></i></span>'
            . '<strong>' . e($l['navn']) . '</strong><small>' . e($l['tekst']) . '</small></span></label>';
    }
    $h .= '</div><p class="feltnavn">' . th('ed.tema') . '</p><div class="valg-rutenett valg-3">';
    foreach (TEMAER as $id => $t) {
        $h .= '<label class="valg"><input type="radio" name="tema" value="' . e($id) . '"' . ($k['tema'] === $id ? ' checked' : '') . '>'
            . '<span class="valg-kort tema-kort" style="background:' . e($t['bg']) . ';color:' . e($t['tekst']) . ';border-color:' . e($t['linje']) . '">'
            . '<span class="prove"><b style="background:' . e($t['aksent']) . '"></b><b style="background:' . e($t['aksent_mork']) . '"></b><b style="background:' . e($t['flate']) . ';border:1px solid ' . e($t['linje']) . '"></b></span>'
            . '<strong class="' . ($t['overskrift'] === 'serif' ? 'serif' : '') . '">' . e(tema_navn($id)) . '</strong></span></label>';
    }
    $h .= '</div></fieldset>';

    /* Textos */
    $h .= '<fieldset class="del"><legend>' . th('ed.om') . '</legend>'
        . felt('firmanavn', t('f.firmanavn'), $inn['firmanavn'], 80, true)
        . felt('slagord', t('f.slagord'), $inn['slagord'], 120, false, t('f.slagord.h'))
        . tekstfelt('intro', t('f.intro'), $inn['intro'], 600, 4, t('f.intro.h'))
        . tekstfelt('om', t('f.om'), $inn['om'], 1500, 6, t('f.om.h'))
        . '</fieldset>';

    /* Lista (serviços / cardápio / tratamentos) */
    $listeT = trim($inn['liste_tittel']) !== '' ? $inn['liste_tittel'] : $m['liste_tittel'];
    $infoT  = trim($inn['info_tittel']) !== '' ? $inn['info_tittel'] : $m['info_tittel'];
    $h .= '<fieldset class="del"><legend>' . e($listeT) . '</legend>'
        . felt('liste_tittel', t('f.liste_tittel'), $inn['liste_tittel'], 40, false, t('f.tittel.h', $m['liste_tittel']))
        . '<p class="hjelp">' . e($m['liste_hint']) . '</p>';
    $rader = $inn['liste'];
    $tomme = max(0, min(3, MAKS_LISTE - count($rader)));
    $alle = array_merge($rader, array_fill(0, $tomme, ['navn' => '', 'tekst' => '', 'pris' => '']));
    $h .= '<div class="liste-rader">';
    foreach ($alle as $i => $r) {
        $ny = $i >= count($rader);
        $eks = $m['eksempel'];
        $h .= '<div class="liste-rad' . ($ny ? ' ny' : '') . '">'
            . '<label class="felt"><span>' . th('l.navn') . '</span><input name="liste_navn[' . $i . ']" value="' . e($r['navn']) . '" maxlength="80"' . ($ny && $i === 0 ? ' placeholder="' . e($eks[0]) . '"' : '') . '></label>'
            . '<label class="felt"><span>' . th('l.tekst') . '</span><input name="liste_tekst[' . $i . ']" value="' . e($r['tekst']) . '" maxlength="240"' . ($ny && $i === 0 ? ' placeholder="' . e($eks[1]) . '"' : '') . '></label>'
            . '<label class="felt felt-pris"><span>' . th('l.pris') . '</span><input name="liste_pris[' . $i . ']" value="' . e($r['pris']) . '" maxlength="40"' . ($ny && $i === 0 ? ' placeholder="' . e($eks[2]) . '"' : '') . '></label>'
            . ($ny ? '' : '<label class="slett"><input type="checkbox" name="liste_slett[' . $i . ']" value="1"> ' . th('fjern') . '</label>')
            . '</div>';
    }
    $h .= '</div><p class="hjelp">' . th('l.flere', th('k.lagre'), MAKS_LISTE) . '</p></fieldset>';

    $h .= '<fieldset class="del"><legend>' . e($infoT) . '</legend>'
        . felt('info_tittel', t('f.info_tittel'), $inn['info_tittel'], 40, false, t('f.tittel.tom', $m['info_tittel']))
        . tekstfelt('info', $infoT, $inn['info'], 600, 3, $m['info_hint'])
        . '</fieldset>';

    /* Contato */
    $h .= '<fieldset class="del"><legend>' . th('ed.kontakt') . '</legend><div class="to-kol">'
        . felt('telefon', t('f.telefon'), $inn['telefon'], 40, false, '', 'tel')
        . felt('epost', t('f.epost'), $inn['epost'], 180, false, '', 'email')
        . '</div>'
        . felt('adresse', t('f.adresse'), $inn['adresse'], 200, false, t('f.adresse.h'))
        . tekstfelt('apningstider', t('f.tider'), $inn['apningstider'], 600, 4, t('f.tider.h'))
        . '</fieldset>';

    $h .= '<fieldset class="del"><legend>' . th('ed.knapp') . '</legend><div class="to-kol">'
        . felt('knapp_tekst', t('f.knapp'), $inn['knapp_tekst'], 40, false, t('f.knapp.h', $m['knapp']))
        . felt('knapp_lenke', t('f.lenke'), $inn['knapp_lenke'], 300, false, t('f.lenke.h'), 'url')
        . felt('facebook', t('f.facebook'), $inn['facebook'], 300, false, '', 'url')
        . felt('instagram', t('f.instagram'), $inn['instagram'], 300, false, '', 'url')
        . '</div></fieldset>';

    /* Imagens */
    $h .= '<fieldset class="del"><legend>' . th('ed.bilder') . '</legend>'
        . '<p class="hjelp">' . th('b.hjelp') . '</p>'
        . '<div class="to-kol">'
        . bildefelt('logo', t('b.logo'), $inn['logo'], t('b.logo.h'))
        . bildefelt('toppbilde', t('b.topp'), $inn['toppbilde'], t('b.topp.h'))
        . '</div>';
    $h .= '<p class="feltnavn">' . th('b.galleri', MAKS_GALLERI) . '</p>';
    if ($inn['galleri']) {
        $h .= '<ul class="galleri-admin">';
        foreach ($inn['galleri'] as $i => $g) {
            $h .= '<li><img src="' . e(bilde_url($g)) . '" alt=""><label class="felt"><span class="sr">' . th('b.nr', $i + 1) . '</span><select name="galleri_valg[' . $i . ']">'
                . '<option value="behold">' . th('g.behold') . '</option>'
                . '<option value="topp">' . th('g.topp') . '</option>'
                . '<option value="logo">' . th('g.logo') . '</option>'
                . '<option value="slett">' . th('g.slett') . '</option>'
                . '</select></label></li>';
        }
        $h .= '</ul>';
    }
    if (count($inn['galleri']) < MAKS_GALLERI) {
        $h .= '<label class="felt"><span>' . th('b.legg_til') . '</span><input type="file" name="galleri_ny[]" accept="image/jpeg,image/png,image/webp" multiple></label>';
    }
    $h .= '</fieldset>';

    /* Botões */
    $h .= '<div class="handlinger">'
        . '<button class="knapp knapp--strek" type="submit" name="handling" value="lagre">' . th('k.lagre') . '</button>'
        . '<button class="knapp knapp--strek" type="submit" name="handling" value="forhand">' . th('k.forhand') . '</button>'
        . '<button class="knapp" type="submit" name="handling" value="publiser">' . th($k['status'] === 'aktiv' ? 'k.publiser2' : 'k.publiser') . '</button>'
        . '</div>';
    $h .= '</form>';

    $h .= '<div class="bunnlenker"><a href="https://billing.stripe.com/p/login/8x200ka6v07Y28SaYm73G00" target="_blank" rel="noopener">' . th('bunn.abo') . ' ↗</a>'
        . ' · <a href="https://dsnorge.com/vilkar.html?lang=' . e(sprak()) . '" target="_blank" rel="noopener">' . th('bunn.vilkar') . '</a> · ' . utlogging() . '</div>';

    ramme('Min side', $h, true);
}

function felt(string $navn, string $etikett, string $verdi, int $maks, bool $paakrevd = false, string $hjelp = '', string $type = 'text'): string
{
    return '<label class="felt"><span>' . e($etikett) . ($paakrevd ? ' *' : '') . '</span>'
        . '<input type="' . e($type) . '" name="' . e($navn) . '" value="' . e($verdi) . '" maxlength="' . $maks . '"' . ($paakrevd ? ' required' : '') . '>'
        . ($hjelp !== '' ? '<small>' . e($hjelp) . '</small>' : '') . '</label>';
}

function tekstfelt(string $navn, string $etikett, string $verdi, int $maks, int $rader, string $hjelp = ''): string
{
    return '<label class="felt"><span>' . e($etikett) . '</span>'
        . '<textarea name="' . e($navn) . '" maxlength="' . $maks . '" rows="' . $rader . '">' . e($verdi) . '</textarea>'
        . ($hjelp !== '' ? '<small>' . nl2br(e($hjelp), false) . '</small>' : '') . '</label>';
}

function bildefelt(string $navn, string $etikett, string $fil, string $hjelp): string
{
    $h = '<div class="bildefelt"><p class="feltnavn">' . e($etikett) . '</p>';
    if ($fil !== '') {
        $h .= '<img class="miniatyr" src="' . e(bilde_url($fil)) . '" alt="">'
            . '<label class="slett"><input type="checkbox" name="fjern_' . e($navn) . '" value="1"> ' . th('fjern') . '</label>';
    }
    $h .= '<label class="felt"><span>' . th($fil !== '' ? 'b.bytt' : 'b.last_opp') . '</span>'
        . '<input type="file" name="' . e($navn) . '_ny" accept="image/jpeg,image/png,image/webp"></label>'
        . '<small>' . e($hjelp) . '</small></div>';
    return $h;
}

function handling_lagre(): void
{
    krev_innlogget();
    $k = aktiv_kunde();
    if (!$k) { videre('/'); }
    $id = (int)$k['id'];
    $gammelt = array_merge(tomt_innhold($k['modell']), json_les($k['utkast']));
    $inn = innhold_fra_skjema($_POST, $gammelt, $k['modell']);

    /* Imagens já existentes: o formulário só manda escolhas, nunca nomes de arquivo */
    if (!empty($_POST['fjern_logo']))      { $inn['logo'] = ''; }
    if (!empty($_POST['fjern_toppbilde'])) { $inn['toppbilde'] = ''; }
    $galleri = [];
    $valg = (array)($_POST['galleri_valg'] ?? []);
    foreach ($gammelt['galleri'] as $i => $g) {
        $v = (string)($valg[$i] ?? 'behold');
        if ($v === 'slett') { continue; }
        if ($v === 'topp') {
            if ($inn['toppbilde'] !== '') { $galleri[] = $inn['toppbilde']; }
            $inn['toppbilde'] = $g;
            continue;
        }
        if ($v === 'logo') { $inn['logo'] = $g; continue; }
        $galleri[] = $g;
    }

    /* Imagens novas */
    $feil = 0;
    foreach (['logo' => 'logo', 'toppbilde' => 'foto'] as $felt => $type) {
        $fil = $_FILES[$felt . '_ny'] ?? null;
        if ($fil && ($fil['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            $ny = ($fil['error'] === UPLOAD_ERR_OK && is_uploaded_file($fil['tmp_name'])) ? lagre_bilde($fil['tmp_name'], $id, $type) : null;
            if ($ny) { $inn[$felt] = $ny; } else { $feil++; }
        }
    }
    $nye = $_FILES['galleri_ny'] ?? null;
    if ($nye && is_array($nye['name'] ?? null)) {
        foreach ($nye['name'] as $i => $n) {
            if (($nye['error'][$i] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) { continue; }
            if (count($galleri) >= MAKS_GALLERI) { $feil++; continue; }
            $ny = ($nye['error'][$i] === UPLOAD_ERR_OK && is_uploaded_file($nye['tmp_name'][$i])) ? lagre_bilde($nye['tmp_name'][$i], $id, 'foto') : null;
            if ($ny) { $galleri[] = $ny; } else { $feil++; }
        }
    }
    $inn['galleri'] = array_values(array_filter($galleri, static fn($g) => eget_bilde($g, $id)));
    foreach (['logo', 'toppbilde'] as $felt) {
        if ($inn[$felt] !== '' && !eget_bilde($inn[$felt], $id)) { $inn[$felt] = ''; }
    }

    $layout = isset(LAYOUTER[$_POST['layout'] ?? '']) ? $_POST['layout'] : $k['layout'];
    $tema   = isset(TEMAER[$_POST['tema'] ?? '']) ? $_POST['tema'] : $k['tema'];
    $gml    = (string)($k['sprak'] ?? 'no');
    $nytt   = isset(SPRAK[$_POST['sprak'] ?? '']) ? (string)$_POST['sprak'] : $gml;
    if ($nytt !== $gml) {
        // Texto do botão ainda é o padrão da língua antiga? Troca pelo padrão da nova.
        $standard = modell($k['modell'])['knapp'];
        sprak($nytt);
        if ($inn['knapp_tekst'] === '' || $inn['knapp_tekst'] === $standard) { $inn['knapp_tekst'] = modell($k['modell'])['knapp']; }
    }
    $inn['sprak'] = $nytt;
    q('UPDATE kunder SET utkast = ?, layout = ?, tema = ?, sprak = ?, sist_lagret = NOW() WHERE id = ?', [json_skriv($inn), $layout, $tema, $nytt, $id]);

    $varsel = $feil ? t('fl.bildefeil', $feil, MAKS_GALLERI) : '';

    $handling = (string)($_POST['handling'] ?? 'lagre');
    if ($handling === 'forhand') {
        if ($feil) { flash(t('fl.lagret') . $varsel, 'feil'); }
        videre('/forhand');
    }
    if ($handling === 'publiser') {
        $k = q('SELECT * FROM kunder WHERE id = ?', [$id])->fetch();
        publiser($k, $inn, $varsel);
    }
    flash(t('fl.lagret') . $varsel, $feil ? 'feil' : 'ok');
    videre('/');
}

function publiser(array $k, array $inn, string $varsel): never
{
    $mangler = [];
    if (trim($inn['firmanavn']) === '') { $mangler[] = t('fl.m.navn'); }
    if (trim($inn['telefon']) === '' && trim($inn['epost']) === '') { $mangler[] = t('fl.m.kontakt'); }
    if ($mangler) {
        flash(t('fl.mangler', implode(', ', $mangler)), 'feil');
        videre('/');
    }
    if ($k['status'] === 'av') {
        flash(t('fl.stengt', DESTINO), 'feil');
        videre('/');
    }
    q('UPDATE kunder SET publisert = utkast, publisert_layout = layout, publisert_tema = tema, sist_publisert = NOW() WHERE id = ?', [$k['id']]);
    rydd_bilder((int)$k['id']);

    if ($k['status'] === 'aktiv') {
        flash(t('fl.publisert', kunde_adresse($k)) . $varsel);
        videre('/');
    }

    $forste = $k['status'] === 'utkast';
    $ny_status = AUTO_AKTIVER ? 'aktiv' : 'venter';
    q('UPDATE kunder SET status = ? WHERE id = ?', [$ny_status, $k['id']]);
    if ($forste) {
        send_epost(DESTINO, '[Min side] ' . (AUTO_AKTIVER ? 'Ny side på nett: ' : 'Klar til publisering: ') . $inn['firmanavn'], implode("\n", [
            AUTO_AKTIVER ? 'Kunden har publisert siden, og den er nå på nett.' : 'Kunden har trykket «Publiser».',
            '',
            'Bedrift:  ' . $inn['firmanavn'],
            'E-post:   ' . $k['epost'],
            'Bestilling: ' . ($k['bestilling_ref'] ?: '—'),
            'Språk:    ' . (SPRAK[$k['sprak'] ?? 'no'] ?? '—'),
            'Adresse:  ' . kunde_url($k),
            '',
            'Gjør dette:',
            '1. Sjekk i Stripe at abonnementet finnes (kunden har lagt inn kort).',
            '   Finnes det ikke: ' . minside_url('/admin') . ' → «Slå av».',
            AUTO_AKTIVER ? '2. Stripe → Abonnementet → avslutt prøveperioden nå (første trekk).' : '2. ' . minside_url('/admin') . ' → «Aktiver».',
            AUTO_AKTIVER ? '' : '3. Stripe → Abonnementet → avslutt prøveperioden nå (første trekk).',
        ]), $k['epost']);
        if (AUTO_AKTIVER) {
            send_epost($k['epost'], t('ep.vel.emne'), velkommen_tekst($k, $inn));
        }
    }
    if (AUTO_AKTIVER) {
        flash(t('fl.gratulerer', kunde_adresse($k)) . $varsel);
    } else {
        flash(t('fl.sendt') . $varsel);
    }
    videre('/');
}

function velkommen_tekst(array $k, array $inn): string
{
    return implode("\n", [
        t('ep.hei'),
        '',
        t('ep.vel.p1', (string)($inn['firmanavn'] ?? '')),
        kunde_url($k),
        '',
        t('ep.vel.p2', minside_url('/')),
        t('ep.vel.p3'),
        '',
        t('ep.hilsen'),
        'Digital Solutions · dsnorge.com',
    ]);
}

function side_forhand(): void
{
    krev_innlogget();
    $k = aktiv_kunde();
    if (!$k) { videre('/'); }
    header("Content-Security-Policy: default-src 'none'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; font-src 'self'; base-uri 'none'; form-action 'none'; frame-ancestors 'none'");
    echo render_side($k, json_les($k['utkast']), $k['layout'], $k['tema'], true);
}

/* ═══ Admin ══════════════════════════════════════════════════ */

function side_admin(): void
{
    krev_admin();
    sprak('no');                                // o painel fica em norueguês
    unset($_SESSION['kunde_id']);
    $f = flash();
    $kunder = q('SELECT id, epost, bestilling_ref, slug, domene, modell, sprak, status, sist_lagret, sist_publisert, sist_innlogget, nota, utkast FROM kunder ORDER BY FIELD(status, \'venter\', \'utkast\', \'aktiv\', \'av\'), id DESC')->fetchAll();

    $h = '<div class="hode-rad"><h1>Admin</h1>' . utlogging() . '</div>';
    if ($f) { $h .= '<p class="melding ' . e($f['type']) . '">' . e($f['tekst']) . '</p>'; }

    $venter = array_filter($kunder, static fn($k) => $k['status'] === 'venter');
    if ($venter) {
        $h .= '<div class="melding vent"><strong>' . count($venter) . ' side(r) venter på aktivering.</strong> Før du trykker «Aktiver»: '
            . 'sjekk abonnementet i Stripe. Etterpå: avslutt prøveperioden i Stripe.</div>';
    }

    $h .= '<div class="tabell-ramme"><table class="tabell"><thead><tr><th>Bedrift</th><th>Adresse</th><th>Status</th><th>Sist</th><th>Handlinger</th></tr></thead><tbody>';
    if (!$kunder) { $h .= '<tr><td colspan="5" class="dempet">Ingen kunder ennå.</td></tr>'; }
    foreach ($kunder as $k) {
        $inn = json_les($k['utkast']);
        [$stNavn, $stType] = status_tekst($k);
        $h .= '<tr><td><strong>' . e($inn['firmanavn'] ?? '—') . '</strong><br><small>' . e($k['epost']) . '<br>'
            . e(MODELLER[$k['modell']]['navn']) . ' · ' . e(strtoupper((string)$k['sprak'])) . ($k['bestilling_ref'] ? ' · ' . e($k['bestilling_ref']) : '') . '</small>'
            . ($k['nota'] ? '<br><small class="nota">' . e($k['nota']) . '</small>' : '') . '</td>'
            . '<td><small>' . e(SIDE_HOST) . '/</small>' . ($k['status'] === 'aktiv' ? '<a href="' . e(side_url($k['slug'])) . '" target="_blank" rel="noopener">' . e($k['slug']) . '</a>' : e($k['slug']))
            . (!empty($k['domene']) ? '<br><small>Domene: </small>' . ($k['status'] === 'aktiv' ? '<a href="' . e(kunde_url($k)) . '" target="_blank" rel="noopener">' . e($k['domene']) . '</a>' : e($k['domene'])) : '') . '</td>'
            . '<td><span class="merkelapp ' . e($stType) . '">' . e($stNavn) . '</span></td>'
            . '<td><small>Lagret: ' . e(kort_dato($k['sist_lagret'])) . '<br>Publisert: ' . e(kort_dato($k['sist_publisert'])) . '<br>Innlogget: ' . e(kort_dato($k['sist_innlogget'])) . '</small></td>'
            . '<td class="admin-handlinger">'
            . admin_knapp($k['id'], 'rediger', 'Åpne editor', 'strek');
        if ($k['status'] !== 'aktiv') {
            $h .= admin_knapp($k['id'], 'aktiver', 'Aktiver', 'hoved', 'Har kunden abonnement i Stripe?');
        }
        if ($k['status'] !== 'av') {
            $h .= admin_knapp($k['id'], 'stenge', 'Slå av', 'strek', 'Slå av siden til ' . ($inn['firmanavn'] ?? $k['slug']) . '?');
        }
        $h .= '<details><summary>Mer</summary>'
            . '<form method="post" action="/admin/handling" class="mini">' . csrf_felt()
            . '<input type="hidden" name="id" value="' . (int)$k['id'] . '"><input type="hidden" name="handling" value="slug">'
            . '<label class="felt"><span>Adresse</span><input name="slug" value="' . e($k['slug']) . '" maxlength="40" pattern="[a-z0-9-]+"></label>'
            . '<button class="knapp knapp--liten knapp--strek" type="submit">Endre adresse</button></form>'
            . '<form method="post" action="/admin/handling" class="mini">' . csrf_felt()
            . '<input type="hidden" name="id" value="' . (int)$k['id'] . '"><input type="hidden" name="handling" value="domene">'
            . '<label class="felt"><span>Eget domene</span><input name="domene" value="' . e($k['domene'] ?? '') . '" maxlength="100" placeholder="bedriften.no"><small>Tomt = fjern. Legg også domenet inn under Webadresser i Domeneshop (mappe /side).</small></label>'
            . '<button class="knapp knapp--liten knapp--strek" type="submit">Lagre domene</button></form>'
            . '<form method="post" action="/admin/handling" class="mini">' . csrf_felt()
            . '<input type="hidden" name="id" value="' . (int)$k['id'] . '"><input type="hidden" name="handling" value="nota">'
            . '<label class="felt"><span>Notat (internt)</span><textarea name="nota" rows="2" maxlength="1000">' . e($k['nota'] ?? '') . '</textarea></label>'
            . '<button class="knapp knapp--liten knapp--strek" type="submit">Lagre notat</button></form>'
            . '</details></td></tr>';
    }
    $h .= '</tbody></table></div>';

    /* Pedidos sem conta ainda */
    try {
        $apne = q('SELECT b.ref, b.criado_em, b.empresa, b.land, b.email, b.modelo FROM bestillinger b LEFT JOIN kunder k ON LOWER(k.epost) = LOWER(b.email) WHERE k.id IS NULL AND b.situacao <> \'cancelado\' ORDER BY b.id DESC LIMIT 50')->fetchAll();
    } catch (Throwable $e) { $apne = []; }
    if ($apne) {
        $h .= '<h2>Bestillinger uten Min side ennå</h2><p class="dempet">Kontoen lages automatisk første gang kunden logger inn med samme e-post.</p><ul class="enkel-liste">';
        foreach ($apne as $b) {
            $h .= '<li><strong>' . e($b['ref']) . '</strong> · ' . e($b['empresa']) . ' (' . e($b['land'] ?? 'NO') . ') · ' . e($b['email']) . ' · ' . e(MODELLER[$b['modelo']]['navn'] ?? $b['modelo']) . ' · <small>' . e(kort_dato($b['criado_em'])) . '</small></li>';
        }
        $h .= '</ul>';
    }

    /* Criar à mão */
    $h .= '<h2>Ny kunde manuelt</h2><form method="post" action="/admin/handling" class="skjema to-kol">' . csrf_felt()
        . '<input type="hidden" name="handling" value="ny">'
        . felt('epost', 'Kundens e-post', '', 180, true, '', 'email')
        . felt('firmanavn', 'Bedriftens navn', '', 80, true)
        . '<label class="felt"><span>Modell</span><select name="modell">';
    foreach (MODELLER as $id => $m) { $h .= '<option value="' . e($id) . '">' . e($m['navn']) . '</option>'; }
    $h .= '</select></label><label class="felt"><span>Språk</span><select name="sprak">';
    foreach (SPRAK as $kode => $navn) { $h .= '<option value="' . e($kode) . '">' . e($navn) . '</option>'; }
    $h .= '</select></label>'
        . felt('slug', 'Ønsket adresse (valgfritt)', '', 40, false, 'Tomt = lages av navnet.')
        . '<div><button class="knapp" type="submit">Opprett</button></div></form>';

    /* De onde vêm os pedidos (últimos 90 dias) */
    try {
        $kilder = q("SELECT COALESCE(kilde, '') AS k, COUNT(*) AS n FROM bestillinger WHERE criado_em >= NOW() - INTERVAL 90 DAY GROUP BY k ORDER BY n DESC")->fetchAll();
        $kamp   = q("SELECT utm, COUNT(*) AS n FROM bestillinger WHERE utm IS NOT NULL AND criado_em >= NOW() - INTERVAL 90 DAY GROUP BY utm ORDER BY n DESC LIMIT 15")->fetchAll();
    } catch (Throwable $e) { $kilder = $kamp = []; }
    if ($kilder) {
        $navn = ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'google' => 'Google', 'flyer' => 'Brosjyre', 'anbefaling' => 'Anbefalt', 'annet' => 'Annet', '' => 'Ikke oppgitt'];
        $h .= '<h2>Hvor kommer bestillingene fra? <small class="dempet">(siste 90 dager)</small></h2><div class="tabell-ramme"><table class="tabell"><thead><tr><th>Kilde (kunden svarte)</th><th>Bestillinger</th></tr></thead><tbody>';
        foreach ($kilder as $r) { $h .= '<tr><td>' . e($navn[$r['k']] ?? $r['k']) . '</td><td>' . (int)$r['n'] . '</td></tr>'; }
        $h .= '</tbody></table></div>';
        if ($kamp) {
            $h .= '<div class="tabell-ramme"><table class="tabell"><thead><tr><th>Kampanje (lenke med utm_)</th><th>Bestillinger</th></tr></thead><tbody>';
            foreach ($kamp as $r) { $h .= '<tr><td>' . e($r['utm']) . '</td><td>' . (int)$r['n'] . '</td></tr>'; }
            $h .= '</tbody></table></div>';
        }
    }

    $h .= systemsjekk();
    ramme('Admin', $h, true);
}

function admin_knapp(int|string $id, string $handling, string $tekst, string $stil, string $bekreft = ''): string
{
    return '<form method="post" action="/admin/handling" class="inline">' . csrf_felt()
        . '<input type="hidden" name="id" value="' . (int)$id . '"><input type="hidden" name="handling" value="' . e($handling) . '">'
        . ($bekreft !== '' ? '<label class="bekreft"><input type="checkbox" name="bekreftet" value="1" required> ' . e($bekreft) . '</label>' : '')
        . '<button class="knapp knapp--liten' . ($stil === 'strek' ? ' knapp--strek' : '') . '" type="submit">' . e($tekst) . '</button></form>';
}

function handling_admin(): void
{
    krev_admin();
    $handling = (string)($_POST['handling'] ?? '');
    $id = (int)($_POST['id'] ?? 0);
    $k = $id ? q('SELECT * FROM kunder WHERE id = ?', [$id])->fetch() : null;

    switch ($handling) {
        case 'rediger':
            if (!$k) { break; }
            $_SESSION['kunde_id'] = $id;
            videre('/');

        case 'aktiver':
            if (!$k) { break; }
            if ($k['publisert'] === null) {
                q('UPDATE kunder SET publisert = utkast, publisert_layout = layout, publisert_tema = tema, sist_publisert = NOW() WHERE id = ?', [$id]);
            }
            q("UPDATE kunder SET status = 'aktiv' WHERE id = ?", [$id]);
            $inn = json_les($k['utkast']);
            sprak((string)($k['sprak'] ?? 'no'));
            send_epost($k['epost'], t('ep.vel.emne'), velkommen_tekst($k, $inn));
            sprak('no');
            flash('Aktivert: ' . side_adresse($k['slug']) . '. Husk å avslutte prøveperioden i Stripe.');
            break;

        case 'stenge':
            if (!$k) { break; }
            q("UPDATE kunder SET status = 'av' WHERE id = ?", [$id]);
            flash('Slått av: ' . side_adresse($k['slug']) . '. Husk å avslutte abonnementet i Stripe hvis kunden har sluttet.');
            break;

        case 'slug':
            if (!$k) { break; }
            $ny = strtolower(trim((string)($_POST['slug'] ?? '')));
            if (!slug_gyldig($ny)) { flash('Ugyldig adresse: bruk a–z, 0–9 og bindestrek.', 'feil'); break; }
            if (q('SELECT id FROM kunder WHERE slug = ? AND id <> ?', [$ny, $id])->fetch()) { flash('Adressen er i bruk.', 'feil'); break; }
            q('UPDATE kunder SET slug = ? WHERE id = ?', [$ny, $id]);
            flash('Ny adresse: ' . side_adresse($ny) . '. Den gamle adressen virker ikke lenger.');
            break;

        case 'domene':
            if (!$k) { break; }
            $raa = trim((string)($_POST['domene'] ?? ''));
            if ($raa === '') {
                q('UPDATE kunder SET domene = NULL WHERE id = ?', [$id]);
                flash('Domenet er fjernet. Siden ligger fortsatt på ' . side_adresse($k['slug']) . '.');
                break;
            }
            $dom = rens_domene($raa);
            if ($dom === '') { flash('Ugyldig domene. Skriv for eksempel bedriften.no (uten https:// og www).', 'feil'); break; }
            if (q('SELECT id FROM kunder WHERE domene = ? AND id <> ?', [$dom, $id])->fetch()) { flash('Domenet er allerede koblet til en annen kunde.', 'feil'); break; }
            q('UPDATE kunder SET domene = ? WHERE id = ?', [$dom, $id]);
            flash('Domene lagret: ' . $dom . '. Husk: Webadresser i Domeneshop for ' . $dom . ' og www.' . $dom . ' → mappe /side, med HTTPS.');
            break;

        case 'nota':
            if (!$k) { break; }
            q('UPDATE kunder SET nota = ? WHERE id = ?', [mb_substr(trim((string)($_POST['nota'] ?? '')), 0, 1000), $id]);
            flash('Notat lagret.');
            break;

        case 'ny':
            $epost = strtolower(trim((string)($_POST['epost'] ?? '')));
            $navn = mb_substr(trim((string)($_POST['firmanavn'] ?? '')), 0, 80);
            $modell = isset(MODELLER[$_POST['modell'] ?? '']) ? $_POST['modell'] : 'handverk';
            $nySprak = isset(SPRAK[$_POST['sprak'] ?? '']) ? (string)$_POST['sprak'] : 'no';
            if (!filter_var($epost, FILTER_VALIDATE_EMAIL) || $navn === '') { flash('Fyll inn e-post og navn.', 'feil'); break; }
            if (q('SELECT id FROM kunder WHERE epost = ?', [$epost])->fetch()) { flash('Det finnes allerede en kunde med denne e-posten.', 'feil'); break; }
            $onsket = trim((string)($_POST['slug'] ?? ''));
            $slug = ledig_slug($onsket !== '' ? $onsket : $navn);
            sprak($nySprak);
            $inn = tomt_innhold($modell);
            sprak('no');
            $inn['firmanavn'] = $navn;
            $inn['epost'] = $epost;
            q('INSERT INTO kunder (opprettet, epost, slug, modell, sprak, utkast) VALUES (NOW(), ?, ?, ?, ?, ?)', [$epost, $slug, $modell, $nySprak, json_skriv($inn)]);
            flash('Opprettet: ' . $navn . ' (' . side_adresse($slug) . '). Kunden logger inn på ' . MINSIDE_HOST . ' med ' . $epost . '.');
            break;
    }
    videre('/admin');
}

function kort_dato(?string $d): string
{
    return $d ? date('d.m.Y H:i', strtotime($d)) : '—';
}

function systemsjekk(): string
{
    $rader = [
        'PHP ' . PHP_VERSION                     => version_compare(PHP_VERSION, '8.1', '>='),
        'GD (bildebehandling)'                   => function_exists('imagecreatetruecolor'),
        'WebP'                                   => function_exists('imagewebp'),
        'EXIF (rotasjon av mobilbilder)'         => function_exists('exif_read_data'),
        'Bildemappe skrivbar (side/m)'           => is_dir(MEDIA_DIR) && is_writable(MEDIA_DIR),
        'Datamappe skrivbar (ds-app/data)'       => is_dir(DATA_DIR) ? is_writable(DATA_DIR) : @mkdir(DATA_DIR, 0700, true),
        'Bestillingsfiler lesbare'               => !is_dir(BESTILLING_FILER) || is_readable(BESTILLING_FILER),
        'Maks opplasting: ' . ini_get('upload_max_filesize') . ' / ' . ini_get('post_max_size') => true,
    ];
    $h = '<details class="sjekk"><summary>Systemsjekk</summary><ul class="enkel-liste">';
    foreach ($rader as $navn => $ok) {
        $h .= '<li>' . ($ok ? '✅' : '❌') . ' ' . e($navn) . '</li>';
    }
    return $h . '</ul></details>';
}

/* ═══ Moldura das páginas ════════════════════════════════════ */

function ikke_funnet(): never
{
    http_response_code(404);
    ramme(t('nf.tittel'), '<div class="boks"><h1>' . th('nf.h') . '</h1><p><a href="/">' . th('nf.lenke') . '</a></p></div>');
    exit;
}

function ramme(string $tittel, string $innhold, bool $bred = false): void
{
    echo '<!doctype html><html lang="' . e(HTML_LANG[sprak()]) . '"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<meta name="robots" content="noindex, nofollow"><title>' . e($tittel) . ' · Digital Solutions</title>'
        . '<link rel="stylesheet" href="/assets/minside.css?v=2"></head><body>'
        . '<header class="ms-topp"><div class="ms-ramme"><a class="ms-merke" href="/">Min side</a><span class="ms-av">Digital Løsninger · dsnorge.com</span></div></header>'
        . '<main class="ms-ramme' . ($bred ? '' : ' ms-smal') . '">' . $innhold . '</main>'
        . '<script src="/assets/chat.js?v=1" defer data-sted="minside"></script></body></html>';
}
