<?php
/**
 * DIGITAL SOLUTIONS — modelos, temas, layouts e o conteúdo de cada página.
 * O cliente só escolhe entre opções desta lista: é isso que protege a qualidade.
 * DOC-WEB-MS-004 · v1.1.0
 * Os textos de modelos, layouts e temas em cada idioma ficam em lib/sprak.php.
 */
declare(strict_types=1);

// Nomes em norueguês (painel /admin). Os textos para o cliente vêm de modell() em lib/sprak.php.
const MODELLER = [
    'handverk' => ['navn' => 'Håndverk og service'],
    'mat'      => ['navn' => 'Mat og butikk'],
    'velvaere' => ['navn' => 'Velvære og timer'],
];

const LAYOUTER = [
    'a' => ['navn' => 'Bilde øverst',    'tekst' => 'Stort bilde over hele toppen, tekst oppå.'],
    'b' => ['navn' => 'Bilde ved siden', 'tekst' => 'Tekst til venstre, bilde til høyre, tjenester som kort.'],
];

// Fargetemaer (pastell). «aksent» = fundo de botões e destaques (claro);
// «aksent_mork» = mesma cor, escura, para textos e links (contraste ≥ 4,5:1);
// «paa_aksent» = texto em cima do «aksent». «overskrift»: serif (Fraunces) ou sans (Work Sans).
const TEMAER = [
    'babyblaa'  => ['navn' => 'Babyblå',  'bg' => '#F4F9FD', 'flate' => '#FFFFFF', 'tekst' => '#1E2B38', 'dempet' => '#4F6070', 'aksent' => '#B9DDF5', 'aksent_mork' => '#23608E', 'paa_aksent' => '#16324A', 'linje' => '#D8E7F2', 'overskrift' => 'serif'],
    'babygronn' => ['navn' => 'Babygrønn', 'bg' => '#F4FAF5', 'flate' => '#FFFFFF', 'tekst' => '#1F2E24', 'dempet' => '#4E6355', 'aksent' => '#BFE6C8', 'aksent_mork' => '#2D6B41', 'paa_aksent' => '#173A22', 'linje' => '#D7EADB', 'overskrift' => 'serif'],
    'babygul'   => ['navn' => 'Babygul',  'bg' => '#FFFCF0', 'flate' => '#FFFFFF', 'tekst' => '#2E2A1C', 'dempet' => '#625B44', 'aksent' => '#FBE7A1', 'aksent_mork' => '#7A5C00', 'paa_aksent' => '#3B2F05', 'linje' => '#F0E6C4', 'overskrift' => 'sans'],
    'rosa'      => ['navn' => 'Rosa',     'bg' => '#FDF6F8', 'flate' => '#FFFFFF', 'tekst' => '#33222A', 'dempet' => '#6A5260', 'aksent' => '#F6CFDB', 'aksent_mork' => '#9A3B5E', 'paa_aksent' => '#4A1B2C', 'linje' => '#F1DDE4', 'overskrift' => 'sans'],
    'lilla'     => ['navn' => 'Lilla',    'bg' => '#F8F6FD', 'flate' => '#FFFFFF', 'tekst' => '#2A2438', 'dempet' => '#5C5470', 'aksent' => '#DCD3F4', 'aksent_mork' => '#5B47A0', 'paa_aksent' => '#2B2150', 'linje' => '#E4DEF3', 'overskrift' => 'serif'],
    'sand'      => ['navn' => 'Sand',     'bg' => '#FBF8F3', 'flate' => '#FFFFFF', 'tekst' => '#2D2620', 'dempet' => '#62574C', 'aksent' => '#EBDCC6', 'aksent_mork' => '#85582F', 'paa_aksent' => '#3D2A17', 'linje' => '#EADFD0', 'overskrift' => 'serif'],
];
const STANDARD_TEMA = 'babyblaa';

const MAKS_LISTE   = 15;
const MAKS_GALLERI = 8;

// Campos de texto: nome => tamanho máximo
const TEKSTFELT = [
    'firmanavn'    => 80,
    'slagord'      => 120,
    'intro'        => 600,
    'om'           => 1500,
    'info'         => 600,
    'apningstider' => 600,
    'telefon'      => 40,
    'epost'        => 180,
    'adresse'      => 200,
    'knapp_tekst'  => 40,
];

function tomt_innhold(string $modell): array
{
    return [
        'firmanavn' => '', 'slagord' => '', 'intro' => '', 'om' => '',
        'liste' => [], 'info' => '', 'apningstider' => '',
        'telefon' => '', 'epost' => '', 'adresse' => '',
        'knapp_tekst' => modell($modell)['knapp'], 'knapp_lenke' => '',
        'facebook' => '', 'instagram' => '',
        'logo' => '', 'toppbilde' => '', 'galleri' => [],
        'sprak' => sprak(),
    ];
}

/** Lê o formulário do editor e devolve o conteúdo limpo (sem as imagens). */
function innhold_fra_skjema(array $post, array $gammelt, string $modell): array
{
    $ny = array_merge(tomt_innhold($modell), $gammelt);
    foreach (TEKSTFELT as $felt => $maks) {
        $v = trim(str_replace("\r\n", "\n", (string)($post[$felt] ?? '')));
        $ny[$felt] = mb_substr($v, 0, $maks);
    }
    if ($ny['epost'] !== '' && !filter_var($ny['epost'], FILTER_VALIDATE_EMAIL)) { $ny['epost'] = ''; }
    $ny['telefon']     = preg_replace('/[^\d +()-]/', '', $ny['telefon']) ?? '';
    $ny['knapp_lenke'] = trygg_url($post['knapp_lenke'] ?? '');
    $ny['facebook']    = trygg_url($post['facebook'] ?? '');
    $ny['instagram']   = trygg_url($post['instagram'] ?? '');

    $liste = [];
    $navn  = (array)($post['liste_navn'] ?? []);
    $tekst = (array)($post['liste_tekst'] ?? []);
    $pris  = (array)($post['liste_pris'] ?? []);
    foreach ($navn as $i => $n) {
        $n = mb_substr(trim((string)$n), 0, 80);
        $t = mb_substr(trim((string)($tekst[$i] ?? '')), 0, 240);
        $p = mb_substr(trim((string)($pris[$i] ?? '')), 0, 40);
        if ($n === '' && $t === '' && $p === '') { continue; }
        if (!empty($post['liste_slett'][$i])) { continue; }
        $liste[] = ['navn' => $n, 'tekst' => $t, 'pris' => $p];
        if (count($liste) >= MAKS_LISTE) { break; }
    }
    $ny['liste'] = $liste;
    return $ny;
}

/** Primeira versão a partir do pedido feito em dsnorge.com/bestill.html */
function innhold_fra_bestilling(array $b): array
{
    $modell = $b['modelo'];
    $inn = tomt_innhold($modell);
    $inn['firmanavn']    = mb_substr((string)$b['empresa'], 0, 80);
    $inn['intro']        = mb_substr((string)$b['descricao'], 0, 600);
    $horario             = (string)($b['horario'] ?? '');
    if ($modell === 'handverk') { $inn['info'] = mb_substr($horario, 0, 600); }
    else                        { $inn['apningstider'] = mb_substr($horario, 0, 600); }
    $inn['telefon']   = (string)$b['telefone'];
    $inn['epost']     = (string)$b['email'];
    $inn['facebook']  = trygg_url($b['facebook'] ?? '');
    $inn['instagram'] = trygg_url($b['instagram'] ?? '');
    return $inn;
}

function tema_css(string $tema): string
{
    $t = TEMAER[$tema] ?? TEMAER[STANDARD_TEMA];
    $font = $t['overskrift'] === 'serif' ? "'Fraunces', Georgia, serif" : "'Work Sans', system-ui, sans-serif";
    return ':root{--bg:' . $t['bg'] . ';--flate:' . $t['flate'] . ';--tekst:' . $t['tekst'] . ';--dempet:' . $t['dempet']
        . ';--aksent:' . $t['aksent'] . ';--aksent-mork:' . $t['aksent_mork'] . ';--paa-aksent:' . $t['paa_aksent'] . ';--linje:' . $t['linje']
        . ';--overskrift:' . $font . '}';
}
