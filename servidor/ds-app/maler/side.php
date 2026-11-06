<?php
/**
 * DIGITAL SOLUTIONS — monta a landingsside de um cliente.
 * Usado no ar (<slug>.dsnorge.com) e na prévia do Min side.
 * DOC-WEB-MS-006 · v1.0.0
 */
declare(strict_types=1);

function render_side(array $kunde, array $inn, string $layout, string $tema, bool $forhand = false): string
{
    $modell = $kunde['modell'];
    $m      = MODELLER[$modell];
    $layout = isset(LAYOUTER[$layout]) ? $layout : 'a';
    $tema   = isset(TEMAER[$tema]) ? $tema : STANDARD_TEMA;
    $inn    = array_merge(tomt_innhold($modell), $inn);

    $navn    = $inn['firmanavn'] !== '' ? $inn['firmanavn'] : 'Bedriften din';
    $tlfLenke = $inn['telefon'] !== '' ? 'tel:' . preg_replace('/[^\d+]/', '', $inn['telefon']) : '';
    $hovedLenke = $inn['knapp_lenke'] ?: ($tlfLenke ?: ($inn['epost'] ? 'mailto:' . $inn['epost'] : '#kontakt'));
    $hovedTekst = $inn['knapp_tekst'] !== '' ? $inn['knapp_tekst'] : $m['knapp'];
    $ekstern = str_starts_with($hovedLenke, 'http');
    $kart = $inn['adresse'] !== '' ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($inn['adresse']) : '';
    $beskrivelse = mb_substr(trim(preg_replace('/\s+/u', ' ', $inn['slagord'] ?: $inn['intro']) ?? ''), 0, 160);
    $url = side_url($kunde['slug']);
    $harListe = !empty($inn['liste']);
    $harGalleri = !empty($inn['galleri']);
    $harKontakt = $inn['telefon'] || $inn['epost'] || $inn['adresse'] || $inn['apningstider'];

    $ld = array_filter([
        '@context'  => 'https://schema.org',
        '@type'     => $modell === 'mat' ? 'FoodEstablishment' : ($modell === 'velvaere' ? 'HealthAndBeautyBusiness' : 'LocalBusiness'),
        'name'      => $navn,
        'url'       => $url,
        'telephone' => $inn['telefon'] ?: null,
        'email'     => $inn['epost'] ?: null,
        'address'   => $inn['adresse'] ?: null,
        'image'     => $inn['toppbilde'] ? side_rot() . bilde_url($inn['toppbilde']) : null,
        'sameAs'    => array_values(array_filter([$inn['facebook'], $inn['instagram']])) ?: null,
    ]);

    ob_start();
?><!doctype html>
<html lang="nb">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($navn) ?><?= $inn['slagord'] !== '' ? ' – ' . e($inn['slagord']) : '' ?></title>
<?php if ($beskrivelse !== ''): ?><meta name="description" content="<?= e($beskrivelse) ?>">
<?php endif; ?>
<?php if ($forhand): ?><meta name="robots" content="noindex, nofollow">
<?php else: ?><link rel="canonical" href="<?= e($url) ?>">
<?php endif; ?>
<meta property="og:title" content="<?= e($navn) ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($url) ?>">
<?php if ($beskrivelse !== ''): ?><meta property="og:description" content="<?= e($beskrivelse) ?>">
<?php endif; ?>
<?php if ($inn['toppbilde']): ?><meta property="og:image" content="<?= e(side_rot() . bilde_url($inn['toppbilde'])) ?>">
<?php endif; ?>
<?php if ($inn['logo']): ?><link rel="icon" href="<?= e(bilde_url($inn['logo'])) ?>">
<?php endif; ?>
<link rel="preload" href="/assets/fonts/work-sans-latin-wght-normal.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/assets/side.css?v=1">
<style><?= tema_css($tema) ?></style>
<script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
</head>
<body class="layout-<?= e($layout) ?> modell-<?= e($modell) ?>">
<?php if ($forhand): ?>
<div class="forhand">Forhåndsvisning – ikke publisert. <a href="<?= e(minside_url('/')) ?>">Tilbake til Min side</a></div>
<?php endif; ?>

<header class="topp">
  <div class="ramme topp-inn">
    <a class="merke" href="#">
      <?php if ($inn['logo']): ?><img src="<?= e(bilde_url($inn['logo'])) ?>" alt="<?= e($navn) ?>" class="logo"><?php else: ?><span class="merke-navn"><?= e($navn) ?></span><?php endif; ?>
    </a>
    <nav class="meny" aria-label="Hovedmeny">
      <?php if ($harListe): ?><a href="#liste"><?= e($m['liste_tittel']) ?></a><?php endif; ?>
      <?php if ($inn['om'] !== ''): ?><a href="#om">Om oss</a><?php endif; ?>
      <?php if ($harKontakt): ?><a href="#kontakt">Kontakt</a><?php endif; ?>
    </nav>
    <?php if ($tlfLenke): ?><a class="knapp knapp--liten" href="<?= e($tlfLenke) ?>">Ring <?= e($inn['telefon']) ?></a><?php endif; ?>
  </div>
</header>

<main>
<?php if ($layout === 'a'): ?>
<section class="helt-a<?= $inn['toppbilde'] ? ' har-bilde' : '' ?>">
  <?php if ($inn['toppbilde']): ?><img class="helt-bilde" src="<?= e(bilde_url($inn['toppbilde'])) ?>" alt="" fetchpriority="high"><?php endif; ?>
  <div class="ramme helt-tekst">
    <h1><?= e($navn) ?></h1>
    <?php if ($inn['slagord'] !== ''): ?><p class="slagord"><?= e($inn['slagord']) ?></p><?php endif; ?>
    <div class="knapper">
      <a class="knapp" href="<?= e($hovedLenke) ?>"<?= $ekstern ? ' target="_blank" rel="noopener"' : '' ?>><?= e($hovedTekst) ?></a>
      <?php if ($harListe): ?><a class="knapp knapp--lys" href="#liste">Se <?= e(mb_strtolower($m['liste_tittel'])) ?></a><?php endif; ?>
    </div>
  </div>
</section>
<?php if ($inn['intro'] !== ''): ?>
<section class="seksjon intro">
  <div class="ramme smal"><?= avsnitt($inn['intro']) ?></div>
</section>
<?php endif; ?>
<?php else: ?>
<section class="helt-b">
  <div class="ramme helt-b-inn<?= $inn['toppbilde'] ? '' : ' uten-bilde' ?>">
    <div class="helt-tekst">
      <h1><?= e($navn) ?></h1>
      <?php if ($inn['slagord'] !== ''): ?><p class="slagord"><?= e($inn['slagord']) ?></p><?php endif; ?>
      <?php if ($inn['intro'] !== ''): ?><div class="intro-tekst"><?= avsnitt($inn['intro']) ?></div><?php endif; ?>
      <div class="knapper">
        <a class="knapp" href="<?= e($hovedLenke) ?>"<?= $ekstern ? ' target="_blank" rel="noopener"' : '' ?>><?= e($hovedTekst) ?></a>
        <?php if ($harListe): ?><a class="knapp knapp--strek" href="#liste">Se <?= e(mb_strtolower($m['liste_tittel'])) ?></a><?php endif; ?>
      </div>
    </div>
    <?php if ($inn['toppbilde']): ?><figure class="helt-figur"><img src="<?= e(bilde_url($inn['toppbilde'])) ?>" alt="" fetchpriority="high"></figure><?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php if ($harListe): ?>
<section class="seksjon liste" id="liste">
  <div class="ramme">
    <h2><?= e($m['liste_tittel']) ?></h2>
    <?php if ($layout === 'a'): ?>
    <ul class="rader">
      <?php foreach ($inn['liste'] as $l): ?>
      <li class="rad">
        <div class="rad-topp"><span class="rad-navn"><?= e($l['navn']) ?></span><?php if ($l['pris'] !== ''): ?><span class="prikker" aria-hidden="true"></span><span class="rad-pris"><?= e($l['pris']) ?></span><?php endif; ?></div>
        <?php if ($l['tekst'] !== ''): ?><p class="rad-tekst"><?= e($l['tekst']) ?></p><?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <ul class="kort-rutenett">
      <?php foreach ($inn['liste'] as $l): ?>
      <li class="kort">
        <h3><?= e($l['navn']) ?></h3>
        <?php if ($l['tekst'] !== ''): ?><p><?= e($l['tekst']) ?></p><?php endif; ?>
        <?php if ($l['pris'] !== ''): ?><p class="kort-pris"><?= e($l['pris']) ?></p><?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php if ($inn['info'] !== ''): ?>
<section class="seksjon info">
  <div class="ramme smal">
    <h2><?= e($m['info_tittel']) ?></h2>
    <?= avsnitt($inn['info']) ?>
  </div>
</section>
<?php endif; ?>

<?php if ($inn['om'] !== ''): ?>
<section class="seksjon om" id="om">
  <div class="ramme smal">
    <h2>Om oss</h2>
    <?= avsnitt($inn['om']) ?>
  </div>
</section>
<?php endif; ?>

<?php if ($harGalleri): ?>
<section class="seksjon galleri" aria-label="Bilder">
  <div class="ramme">
    <ul class="galleri-rutenett">
      <?php foreach ($inn['galleri'] as $g): ?>
      <li><img src="<?= e(bilde_url($g)) ?>" alt="" loading="lazy"></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>

<?php if ($harKontakt): ?>
<section class="seksjon kontakt" id="kontakt">
  <div class="ramme kontakt-inn">
    <div>
      <h2>Kontakt oss</h2>
      <ul class="kontakt-liste">
        <?php if ($inn['telefon'] !== ''): ?><li><span class="etikett">Telefon</span><a href="<?= e($tlfLenke) ?>"><?= e($inn['telefon']) ?></a></li><?php endif; ?>
        <?php if ($inn['epost'] !== ''): ?><li><span class="etikett">E-post</span><a href="mailto:<?= e($inn['epost']) ?>"><?= e($inn['epost']) ?></a></li><?php endif; ?>
        <?php if ($inn['adresse'] !== ''): ?><li><span class="etikett">Adresse</span><a href="<?= e($kart) ?>" target="_blank" rel="noopener"><?= e($inn['adresse']) ?></a></li><?php endif; ?>
      </ul>
      <?php if ($inn['facebook'] || $inn['instagram']): ?>
      <p class="sosiale">
        <?php if ($inn['facebook']): ?><a href="<?= e($inn['facebook']) ?>" target="_blank" rel="noopener">Facebook</a><?php endif; ?>
        <?php if ($inn['instagram']): ?><a href="<?= e($inn['instagram']) ?>" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
      </p>
      <?php endif; ?>
    </div>
    <?php if ($inn['apningstider'] !== ''): ?>
    <div class="tider">
      <h3>Åpningstider</h3>
      <?= avsnitt($inn['apningstider']) ?>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
</main>

<footer class="bunn">
  <div class="ramme bunn-inn">
    <span>© <?= date('Y') ?> <?= e($navn) ?></span>
    <a href="https://dsnorge.com" target="_blank" rel="noopener">Nettside fra Digital Løsninger</a>
  </div>
</footer>
</body>
</html>
<?php
    return (string)ob_get_clean();
}

function render_ikke_funnet(): string
{
    return '<!doctype html><html lang="nb"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<meta name="robots" content="noindex"><title>Siden finnes ikke</title><link rel="stylesheet" href="/assets/side.css?v=1"><style>' . tema_css(STANDARD_TEMA) . '</style></head>'
        . '<body><main class="ikke-funnet ramme smal"><h1>Siden finnes ikke</h1><p>Denne adressen er ikke i bruk, eller siden er midlertidig stengt.</p>'
        . '<p><a class="knapp" href="https://dsnorge.com">Til dsnorge.com</a></p></main></body></html>';
}
