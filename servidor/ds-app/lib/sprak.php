<?php
/**
 * DIGITAL SOLUTIONS — idiomas do Min side, dos e-mails ao cliente e da página publicada.
 * Cada cliente tem um idioma (kunder.sprak): no, pt, en ou es. O painel /admin fica em norueguês.
 * Para mudar um texto, mude-o aqui nos quatro idiomas: [no, pt, en, es].
 * DOC-WEB-MS-010 · v1.0.0
 */
declare(strict_types=1);

const SPRAK = ['no' => 'Norsk', 'pt' => 'Português', 'en' => 'English', 'es' => 'Español'];
const HTML_LANG = ['no' => 'nb', 'pt' => 'pt-BR', 'en' => 'en', 'es' => 'es'];

/** Idioma atual. Com argumento válido, muda o idioma e o devolve. */
function sprak(?string $sett = null): string
{
    static $aktiv = 'no';
    if ($sett !== null && isset(SPRAK[$sett])) { $aktiv = $sett; }
    return $aktiv;
}

/** Primeiro idioma conhecido do navegador (Accept-Language), ou norueguês. */
function sprak_fra_nettleser(): string
{
    $hdr = strtolower((string)($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? ''));
    foreach (explode(',', $hdr) as $del) {
        $kode = substr(trim(explode(';', $del)[0]), 0, 2);
        if (in_array($kode, ['nb', 'nn', 'no'], true)) { return 'no'; }
        if (isset(SPRAK[$kode])) { return $kode; }
    }
    return 'no';
}

/** Texto puro no idioma atual; %s/%d como em sprintf. */
function t(string $nokkel, string|int ...$verdier): string
{
    $rad = TEKST[$nokkel] ?? null;
    if ($rad === null) { return $nokkel; }
    $i = array_search(sprak(), array_keys(SPRAK), true);
    $s = $rad[$i] ?? $rad[0];
    return $verdier ? vsprintf($s, $verdier) : $s;
}

/** Texto já escapado para HTML; os argumentos entram como HTML pronto (links etc.). */
function th(string $nokkel, string|int ...$html): string
{
    $rad = TEKST[$nokkel] ?? null;
    if ($rad === null) { return e($nokkel); }
    $i = array_search(sprak(), array_keys(SPRAK), true);
    $s = e($rad[$i] ?? $rad[0]);
    return $html ? vsprintf($s, $html) : $s;
}

/** Textos do modelo (serviços / cardápio / tratamentos) no idioma atual. */
function modell(string $id): array
{
    return MODELL_TEKST[sprak()][$id] ?? MODELL_TEKST['no'][$id] ?? MODELL_TEKST['no']['handverk'];
}

const MODELL_TEKST = [
    'no' => [
        'handverk' => ['navn' => 'Håndverk og service', 'liste_tittel' => 'Tjenester', 'liste_hint' => 'Hva tilbyr dere? F.eks. «Baderomsrenovering» – kort forklaring – «fra 650 kr/t».',
            'info_tittel' => 'Område', 'info_hint' => 'Hvilke steder dekker dere? F.eks. «Larvik, Sandefjord og Kvelde».', 'knapp' => 'Be om tilbud',
            'eksempel' => ['Tømrerarbeid', 'Nye vinduer, terrasser og tilbygg.', 'fra 650 kr/t']],
        'mat' => ['navn' => 'Mat og butikk', 'liste_tittel' => 'Meny', 'liste_hint' => 'Retter eller varer. F.eks. «Pizza Margherita» – tomat, mozzarella, basilikum – «159 kr».',
            'info_tittel' => 'Bestilling og levering', 'info_hint' => 'Take away, levering, bordbestilling, betaling med Vipps osv.', 'knapp' => 'Ring og bestill',
            'eksempel' => ['Pizza Margherita', 'Tomat, mozzarella og fersk basilikum.', '159 kr']],
        'velvaere' => ['navn' => 'Velvære og timer', 'liste_tittel' => 'Behandlinger', 'liste_hint' => 'Behandlinger med varighet og pris. F.eks. «Dameklipp» – 45 min – «590 kr».',
            'info_tittel' => 'Om timebestilling', 'info_hint' => 'Hvordan bestiller man time? Avbestillingsregler?', 'knapp' => 'Bestill time',
            'eksempel' => ['Dameklipp', 'Vask, klipp og føn. 45 min.', '590 kr']],
    ],
    'pt' => [
        'handverk' => ['navn' => 'Artesanato e serviços', 'liste_tittel' => 'Serviços', 'liste_hint' => 'O que vocês oferecem? Ex.: «Reforma de banheiro» – breve explicação – «a partir de R$ 80/h».',
            'info_tittel' => 'Região atendida', 'info_hint' => 'Quais lugares vocês atendem? Ex.: «Centro, Zona Sul e Niterói».', 'knapp' => 'Peça um orçamento',
            'eksempel' => ['Marcenaria', 'Janelas, decks e ampliações.', 'a partir de R$ 80/h']],
        'mat' => ['navn' => 'Comida e loja', 'liste_tittel' => 'Cardápio', 'liste_hint' => 'Pratos ou produtos. Ex.: «Pizza Margherita» – tomate, muçarela, manjericão – «R$ 45».',
            'info_tittel' => 'Pedidos e entrega', 'info_hint' => 'Retirada, entrega, reservas, pagamento com Pix etc.', 'knapp' => 'Ligue e peça',
            'eksempel' => ['Pizza Margherita', 'Tomate, muçarela e manjericão fresco.', 'R$ 45']],
        'velvaere' => ['navn' => 'Bem-estar e agendamento', 'liste_tittel' => 'Tratamentos', 'liste_hint' => 'Tratamentos com duração e preço. Ex.: «Corte feminino» – 45 min – «R$ 90».',
            'info_tittel' => 'Sobre o agendamento', 'info_hint' => 'Como marcar horário? Regras de cancelamento?', 'knapp' => 'Agende seu horário',
            'eksempel' => ['Corte feminino', 'Lavagem, corte e escova. 45 min.', 'R$ 90']],
    ],
    'en' => [
        'handverk' => ['navn' => 'Trades and services', 'liste_tittel' => 'Services', 'liste_hint' => 'What do you offer? E.g. «Bathroom renovation» – short description – «from 650 kr/h».',
            'info_tittel' => 'Service area', 'info_hint' => 'Which places do you cover? E.g. «Larvik, Sandefjord and Kvelde».', 'knapp' => 'Request a quote',
            'eksempel' => ['Carpentry', 'New windows, decks and extensions.', 'from 650 kr/h']],
        'mat' => ['navn' => 'Food and shop', 'liste_tittel' => 'Menu', 'liste_hint' => 'Dishes or products. E.g. «Pizza Margherita» – tomato, mozzarella, basil – «159 kr».',
            'info_tittel' => 'Ordering and delivery', 'info_hint' => 'Takeaway, delivery, table booking, payment options etc.', 'knapp' => 'Call to order',
            'eksempel' => ['Pizza Margherita', 'Tomato, mozzarella and fresh basil.', '159 kr']],
        'velvaere' => ['navn' => 'Wellness and booking', 'liste_tittel' => 'Treatments', 'liste_hint' => 'Treatments with duration and price. E.g. «Women\'s haircut» – 45 min – «590 kr».',
            'info_tittel' => 'About booking', 'info_hint' => 'How do people book? Cancellation rules?', 'knapp' => 'Book an appointment',
            'eksempel' => ['Women\'s haircut', 'Wash, cut and blow-dry. 45 min.', '590 kr']],
    ],
    'es' => [
        'handverk' => ['navn' => 'Oficios y servicios', 'liste_tittel' => 'Servicios', 'liste_hint' => '¿Qué ofrecéis? P. ej. «Reforma de baño» – breve explicación – «desde 40 €/h».',
            'info_tittel' => 'Zona de servicio', 'info_hint' => '¿Qué lugares cubrís? P. ej. «Centro, Norte y alrededores».', 'knapp' => 'Pide presupuesto',
            'eksempel' => ['Carpintería', 'Ventanas, terrazas y ampliaciones.', 'desde 40 €/h']],
        'mat' => ['navn' => 'Comida y tienda', 'liste_tittel' => 'Carta', 'liste_hint' => 'Platos o productos. P. ej. «Pizza Margherita» – tomate, mozzarella, albahaca – «12 €».',
            'info_tittel' => 'Pedidos y entrega', 'info_hint' => 'Para llevar, a domicilio, reservas, formas de pago, etc.', 'knapp' => 'Llama y pide',
            'eksempel' => ['Pizza Margherita', 'Tomate, mozzarella y albahaca fresca.', '12 €']],
        'velvaere' => ['navn' => 'Bienestar y citas', 'liste_tittel' => 'Tratamientos', 'liste_hint' => 'Tratamientos con duración y precio. P. ej. «Corte de mujer» – 45 min – «35 €».',
            'info_tittel' => 'Sobre las citas', 'info_hint' => '¿Cómo se pide cita? ¿Normas de cancelación?', 'knapp' => 'Pide cita',
            'eksempel' => ['Corte de mujer', 'Lavado, corte y secado. 45 min.', '35 €']],
    ],
];

/** [no, pt, en, es] */
const TEKST = [
    /* Moldura e erros */
    'feil.tittel'   => ['Feil', 'Erro', 'Error', 'Error'],
    'feil.h'        => ['Noe gikk galt', 'Algo deu errado', 'Something went wrong', 'Algo salió mal'],
    'feil.p'        => ['Prøv igjen om litt. Hvis feilen fortsetter, send e-post til %s.', 'Tente de novo daqui a pouco. Se o erro continuar, escreva para %s.', 'Please try again shortly. If the error persists, email %s.', 'Inténtalo de nuevo en un momento. Si el error continúa, escribe a %s.'],
    'nf.tittel'     => ['Ikke funnet', 'Não encontrado', 'Not found', 'No encontrado'],
    'nf.h'          => ['Siden finnes ikke', 'A página não existe', 'This page does not exist', 'La página no existe'],
    'nf.lenke'      => ['Til Min side', 'Ir para o Min side', 'Go to Min side', 'Ir a Min side'],
    'for_store'     => ['Bildene var for store til å sendes samlet. Prøv færre eller mindre bilder om gangen.', 'As imagens eram grandes demais para enviar de uma vez. Tente menos imagens, ou imagens menores, por vez.', 'The images were too large to send together. Try fewer or smaller images at a time.', 'Las imágenes eran demasiado grandes para enviarlas juntas. Prueba con menos imágenes, o más pequeñas, cada vez.'],
    'okt_utlopt'    => ['Økten er utløpt. Gå tilbake og prøv igjen.', 'A sessão expirou. Volte e tente de novo.', 'Your session has expired. Go back and try again.', 'La sesión ha caducado. Vuelve atrás e inténtalo de nuevo.'],
    'utlogg'        => ['Logg ut', 'Sair', 'Log out', 'Cerrar sesión'],

    /* Login */
    'ingen.h'       => ['Ingen side funnet', 'Nenhuma página encontrada', 'No page found', 'No se encontró ninguna página'],
    'ingen.p'       => ['Vi fant ingen landingsside knyttet til %s. Har du bestilt med en annen e-postadresse? Ellers kan du %s.', 'Não encontramos nenhuma landing page ligada a %s. Você fez o pedido com outro e-mail? Se não, pode %s.', 'We found no landing page linked to %s. Did you order with a different email address? Otherwise you can %s.', 'No encontramos ninguna landing page vinculada a %s. ¿Hiciste el pedido con otro correo? Si no, puedes %s.'],
    'ingen.lenke'   => ['bestille her', 'fazer o pedido aqui', 'order here', 'hacer el pedido aquí'],
    'inn.tittel'    => ['Logg inn', 'Entrar', 'Log in', 'Entrar'],
    'inn.h'         => ['Logg inn på Min side', 'Entrar no Min side', 'Log in to Min side', 'Entrar en Min side'],
    'inn.p'         => ['Her lager og endrer du landingssiden din. Skriv e-postadressen du brukte da du bestilte, så sender vi deg en innloggingslenke.', 'Aqui você cria e edita a sua landing page. Digite o e-mail que usou no pedido e enviaremos um link de acesso.', 'This is where you create and edit your landing page. Enter the email address you used when ordering and we will send you a login link.', 'Aquí creas y editas tu landing page. Escribe el correo que usaste en el pedido y te enviaremos un enlace de acceso.'],
    'inn.epost'     => ['E-post', 'E-mail', 'Email', 'Correo electrónico'],
    'inn.knapp'     => ['Send meg innloggingslenke', 'Enviar link de acesso', 'Send me a login link', 'Enviarme el enlace de acceso'],
    'inn.ny'        => ['Ikke kunde ennå?', 'Ainda não é cliente?', 'Not a customer yet?', '¿Aún no eres cliente?'],
    'inn.bestill'   => ['Bestill landingsside', 'Peça sua landing page', 'Order a landing page', 'Pide tu landing page'],
    'inn.sendt'     => ['Hvis e-postadressen er registrert hos oss, har vi nå sendt deg en innloggingslenke. Den virker i %d minutter. Sjekk også søppelpost.', 'Se o e-mail estiver cadastrado, acabamos de enviar um link de acesso. Ele vale por %d minutos. Confira também a caixa de spam.', 'If the email address is registered with us, we have now sent you a login link. It works for %d minutes. Check your spam folder too.', 'Si el correo está registrado, te acabamos de enviar un enlace de acceso. Sirve durante %d minutos. Revisa también la carpeta de spam.'],
    'inn.ugyldig'   => ['Skriv en gyldig e-postadresse.', 'Digite um e-mail válido.', 'Enter a valid email address.', 'Escribe un correo válido.'],
    'inn.for_mange' => ['For mange forsøk. Vent en time og prøv igjen.', 'Tentativas demais. Espere uma hora e tente de novo.', 'Too many attempts. Wait an hour and try again.', 'Demasiados intentos. Espera una hora e inténtalo de nuevo.'],
    'inn.bekreft'   => ['Klikk for å fortsette til Min side.', 'Clique para continuar para o Min side.', 'Click to continue to Min side.', 'Haz clic para continuar a Min side.'],
    'lenke.ugyldig' => ['Lenken er ugyldig.', 'O link é inválido.', 'The link is invalid.', 'El enlace no es válido.'],
    'lenke.utlopt'  => ['Lenken er utløpt eller allerede brukt. Be om en ny nedenfor.', 'O link expirou ou já foi usado. Peça um novo abaixo.', 'The link has expired or has already been used. Request a new one below.', 'El enlace ha caducado o ya se usó. Pide uno nuevo abajo.'],

    /* E-mails */
    'ep.hei'        => ['Hei!', 'Olá!', 'Hi!', '¡Hola!'],
    'ep.hilsen'     => ['Vennlig hilsen', 'Atenciosamente,', 'Kind regards,', 'Saludos,'],
    'ep.inn.emne'   => ['Innloggingslenke til Min side', 'Link de acesso ao Min side', 'Login link for Min side', 'Enlace de acceso a Min side'],
    'ep.inn.klikk'  => ['Klikk på lenken for å logge inn på Min side hos Digital Solutions:', 'Clique no link para entrar no Min side da Digital Solutions:', 'Click the link to log in to Min side at Digital Solutions:', 'Haz clic en el enlace para entrar en Min side de Digital Solutions:'],
    'ep.inn.gyldig' => ['Lenken virker i %d minutter og kan brukes én gang.', 'O link vale por %d minutos e só pode ser usado uma vez.', 'The link works for %d minutes and can be used once.', 'El enlace sirve durante %d minutos y solo se puede usar una vez.'],
    'ep.inn.ignorer'=> ['Har du ikke bedt om denne e-posten, kan du se bort fra den.', 'Se você não pediu este e-mail, pode ignorá-lo.', 'If you did not ask for this email, you can ignore it.', 'Si no pediste este correo, puedes ignorarlo.'],
    'ep.vel.emne'   => ['Landingssiden din er på nett', 'Sua landing page está no ar', 'Your landing page is online', 'Tu landing page ya está en línea'],
    'ep.vel.p1'     => ['Landingssiden til %s er nå på nett:', 'A landing page de %s já está no ar:', 'The landing page for %s is now online:', 'La landing page de %s ya está en línea:'],
    'ep.vel.p2'     => ['Du kan endre tekst, bilder og farger når du vil på %s.', 'Você pode mudar textos, fotos e cores quando quiser em %s.', 'You can change text, photos and colours whenever you like at %s.', 'Puedes cambiar textos, fotos y colores cuando quieras en %s.'],
    'ep.vel.p3'     => ['Del gjerne lenken på Facebook, Instagram og Google-profilen din.', 'Compartilhe o link no Facebook, no Instagram e no seu perfil do Google.', 'Share the link on Facebook, Instagram and your Google profile.', 'Comparte el enlace en Facebook, Instagram y tu perfil de Google.'],

    /* Status */
    'st.aktiv'      => ['Publisert', 'Publicada', 'Published', 'Publicada'],
    'st.aktiv.t'    => ['Siden din er på nett. Endringer blir synlige når du trykker «Publiser endringer».', 'Sua página está no ar. As mudanças aparecem quando você clica em «Publicar mudanças».', 'Your page is online. Changes become visible when you press «Publish changes».', 'Tu página está en línea. Los cambios se verán cuando pulses «Publicar cambios».'],
    'st.venter'     => ['Venter på aktivering', 'Aguardando ativação', 'Awaiting activation', 'Pendiente de activación'],
    'st.venter.t'   => ['Takk! Siden blir aktivert av oss, normalt innen én virkedag. Du får e-post når den er på nett. Du kan fortsatt gjøre endringer.', 'Obrigado! Nós ativamos a página, normalmente em até um dia útil. Você recebe um e-mail quando ela entrar no ar. Ainda pode fazer mudanças.', 'Thank you! We activate the page, normally within one working day. You will get an email when it is online. You can still make changes.', '¡Gracias! Activamos la página, normalmente en un día laborable. Recibirás un correo cuando esté en línea. Aún puedes hacer cambios.'],
    'st.av'         => ['Stengt', 'Desativada', 'Closed', 'Desactivada'],
    'st.av.t'       => ['Siden er ikke på nett. Ta kontakt med oss på %s.', 'A página não está no ar. Fale com a gente em %s.', 'The page is not online. Contact us at %s.', 'La página no está en línea. Escríbenos a %s.'],
    'st.utkast'     => ['Ikke publisert', 'Não publicada', 'Not published', 'Sin publicar'],
    'st.utkast.t'   => ['Fyll inn, se forhåndsvisning og trykk «Publiser» når du er fornøyd.', 'Preencha, veja a prévia e clique em «Publicar» quando estiver satisfeito.', 'Fill in, check the preview and press «Publish» when you are happy.', 'Rellena, mira la vista previa y pulsa «Publicar» cuando estés conforme.'],

    /* Editor */
    'ed.din'        => ['Din landingsside', 'Sua landing page', 'Your landing page', 'Tu landing page'],
    'ed.utseende'   => ['Utseende', 'Aparência', 'Appearance', 'Apariencia'],
    'ed.oppsett'    => ['Oppsett', 'Layout', 'Layout', 'Diseño'],
    'ed.tema'       => ['Fargetema', 'Tema de cores', 'Colour theme', 'Tema de color'],
    'ed.sprak'      => ['Språk', 'Idioma', 'Language', 'Idioma'],
    'ed.sprak.h'    => ['Språket på siden din og her på Min side. Siden får nytt språk når du publiserer.', 'Idioma da sua página e deste Min side. A página muda de idioma quando você publicar.', 'The language of your page and of Min side. The page switches language when you publish.', 'Idioma de tu página y de Min side. La página cambia de idioma cuando publiques.'],
    'ed.om'         => ['Om bedriften', 'Sobre a empresa', 'About the business', 'Sobre la empresa'],
    'f.firmanavn'   => ['Bedriftens navn', 'Nome da empresa', 'Business name', 'Nombre de la empresa'],
    'f.slagord'     => ['Slagord', 'Slogan', 'Slogan', 'Eslogan'],
    'f.slagord.h'   => ['Én kort setning, f.eks. «Din lokale rørlegger i Larvik siden 1998».', 'Uma frase curta, ex.: «O encanador do seu bairro desde 1998».', 'One short sentence, e.g. «Your local plumber since 1998».', 'Una frase corta, p. ej. «Tu fontanero de barrio desde 1998».'],
    'f.intro'       => ['Kort introduksjon', 'Introdução curta', 'Short introduction', 'Introducción breve'],
    'f.intro.h'     => ['Vises øverst. 2–3 setninger om hva dere gjør og for hvem.', 'Aparece no topo. 2–3 frases sobre o que vocês fazem e para quem.', 'Shown at the top. 2–3 sentences about what you do and for whom.', 'Aparece arriba. 2–3 frases sobre lo que hacéis y para quién.'],
    'f.om'          => ['Om oss', 'Sobre nós', 'About us', 'Sobre nosotros'],
    'f.om.h'        => ['Historie, erfaring, hvem som jobber der. Kan stå tomt.', 'História, experiência, quem trabalha aí. Pode ficar em branco.', 'History, experience, who works there. Can be left empty.', 'Historia, experiencia, quién trabaja ahí. Puede quedar vacío.'],
    'l.navn'        => ['Navn', 'Nome', 'Name', 'Nombre'],
    'l.tekst'       => ['Beskrivelse', 'Descrição', 'Description', 'Descripción'],
    'l.pris'        => ['Pris', 'Preço', 'Price', 'Precio'],
    'l.flere'       => ['Trenger du flere linjer? Trykk «%s», så kommer det nye tomme linjer (maks %d).', 'Precisa de mais linhas? Clique em «%s» e aparecem linhas novas em branco (máx. %d).', 'Need more lines? Press «%s» and new empty lines appear (max %d).', '¿Necesitas más líneas? Pulsa «%s» y aparecerán líneas nuevas vacías (máx. %d).'],
    'fjern'         => ['Fjern', 'Remover', 'Remove', 'Quitar'],
    'ed.kontakt'    => ['Kontakt og åpningstider', 'Contato e horário', 'Contact and opening hours', 'Contacto y horario'],
    'f.telefon'     => ['Telefon', 'Telefone', 'Phone', 'Teléfono'],
    'f.epost'       => ['E-post på siden', 'E-mail na página', 'Email on the page', 'Correo en la página'],
    'f.adresse'     => ['Adresse', 'Endereço', 'Address', 'Dirección'],
    'f.adresse.h'   => ['Gir kartlenke på siden. Kan stå tomt.', 'Vira um link para o mapa na página. Pode ficar em branco.', 'Becomes a map link on the page. Can be left empty.', 'Se convierte en un enlace al mapa. Puede quedar vacío.'],
    'f.tider'       => ['Åpningstider', 'Horário de funcionamento', 'Opening hours', 'Horario'],
    'f.tider.h'     => ["Én linje per dag, f.eks.\nMan–fre 08–16\nLør 10–14", "Uma linha por dia, ex.:\nSeg–sex 8h–18h\nSáb 9h–13h", "One line per day, e.g.\nMon–Fri 08–16\nSat 10–14", "Una línea por día, p. ej.\nLun–vie 9–18\nSáb 10–14"],
    'ed.knapp'      => ['Hovedknapp og sosiale medier', 'Botão principal e redes sociais', 'Main button and social media', 'Botón principal y redes sociales'],
    'f.knapp'       => ['Tekst på knappen', 'Texto do botão', 'Button text', 'Texto del botón'],
    'f.knapp.h'     => ['F.eks. «%s».', 'Ex.: «%s».', 'E.g. «%s».', 'P. ej. «%s».'],
    'f.lenke'       => ['Lenke for knappen', 'Link do botão', 'Button link', 'Enlace del botón'],
    'f.lenke.h'     => ['Tomt = knappen ringer telefonnummeret ditt.', 'Em branco = o botão liga para o seu telefone.', 'Empty = the button calls your phone number.', 'Vacío = el botón llama a tu teléfono.'],
    'f.facebook'    => ['Facebook-side', 'Página do Facebook', 'Facebook page', 'Página de Facebook'],
    'f.instagram'   => ['Instagram-profil', 'Perfil do Instagram', 'Instagram profile', 'Perfil de Instagram'],
    'ed.bilder'     => ['Bilder', 'Imagens', 'Images', 'Imágenes'],
    'b.hjelp'       => ['JPG, PNG eller WebP, maks 15 MB per bilde. Vi gjør bildene mindre automatisk, så siden laster raskt.', 'JPG, PNG ou WebP, máx. 15 MB por imagem. Reduzimos as imagens automaticamente para a página carregar rápido.', 'JPG, PNG or WebP, max 15 MB per image. We shrink images automatically so the page loads fast.', 'JPG, PNG o WebP, máx. 15 MB por imagen. Reducimos las imágenes automáticamente para que la página cargue rápido.'],
    'b.logo'        => ['Logo', 'Logo', 'Logo', 'Logo'],
    'b.logo.h'      => ['Helst PNG med gjennomsiktig bakgrunn.', 'De preferência PNG com fundo transparente.', 'Preferably PNG with a transparent background.', 'Preferiblemente PNG con fondo transparente.'],
    'b.topp'        => ['Toppbilde', 'Imagem de topo', 'Top image', 'Imagen principal'],
    'b.topp.h'      => ['Et bredt bilde av arbeidet, lokalet eller maten.', 'Uma foto larga do trabalho, do local ou da comida.', 'A wide photo of your work, premises or food.', 'Una foto ancha del trabajo, el local o la comida.'],
    'b.galleri'     => ['Bildegalleri (maks %d)', 'Galeria de fotos (máx. %d)', 'Photo gallery (max %d)', 'Galería de fotos (máx. %d)'],
    'b.nr'          => ['Bilde %d', 'Imagem %d', 'Image %d', 'Imagen %d'],
    'g.behold'      => ['Behold i galleriet', 'Manter na galeria', 'Keep in gallery', 'Mantener en la galería'],
    'g.topp'        => ['Bruk som toppbilde', 'Usar como imagem de topo', 'Use as top image', 'Usar como imagen principal'],
    'g.logo'        => ['Bruk som logo', 'Usar como logo', 'Use as logo', 'Usar como logo'],
    'g.slett'       => ['Slett', 'Apagar', 'Delete', 'Eliminar'],
    'b.legg_til'    => ['Legg til bilder i galleriet', 'Adicionar fotos à galeria', 'Add photos to the gallery', 'Añadir fotos a la galería'],
    'b.bytt'        => ['Bytt bilde', 'Trocar imagem', 'Replace image', 'Cambiar imagen'],
    'b.last_opp'    => ['Last opp', 'Enviar imagem', 'Upload', 'Subir imagen'],
    'k.lagre'       => ['Lagre', 'Salvar', 'Save', 'Guardar'],
    'k.forhand'     => ['Lagre og forhåndsvis', 'Salvar e ver prévia', 'Save and preview', 'Guardar y ver vista previa'],
    'k.publiser'    => ['Publiser', 'Publicar', 'Publish', 'Publicar'],
    'k.publiser2'   => ['Publiser endringer', 'Publicar mudanças', 'Publish changes', 'Publicar cambios'],
    'bunn.abo'      => ['Abonnement og kvitteringer', 'Assinatura e recibos', 'Subscription and receipts', 'Suscripción y recibos'],
    'bunn.vilkar'   => ['Vilkår', 'Termos', 'Terms', 'Condiciones'],

    /* Avisos depois de salvar/publicar */
    'fl.lagret'     => ['Lagret.', 'Salvo.', 'Saved.', 'Guardado.'],
    'fl.bildefeil'  => [' %d bilde(r) kunne ikke brukes (bare JPG, PNG eller WebP, maks 15 MB, maks %d i galleriet).', ' Não foi possível usar %d imagem(ns) (só JPG, PNG ou WebP, máx. 15 MB, máx. %d na galeria).', ' %d image(s) could not be used (JPG, PNG or WebP only, max 15 MB, max %d in the gallery).', ' No se pudo usar %d imagen(es) (solo JPG, PNG o WebP, máx. 15 MB, máx. %d en la galería).'],
    'fl.mangler'    => ['Lagret, men ikke publisert. Fyll inn: %s.', 'Salvo, mas não publicado. Preencha: %s.', 'Saved, but not published. Please fill in: %s.', 'Guardado, pero sin publicar. Rellena: %s.'],
    'fl.m.navn'     => ['bedriftens navn', 'nome da empresa', 'business name', 'nombre de la empresa'],
    'fl.m.kontakt'  => ['telefon eller e-post', 'telefone ou e-mail', 'phone or email', 'teléfono o correo'],
    'fl.stengt'     => ['Lagret. Siden er stengt og kan ikke publiseres nå. Kontakt %s.', 'Salvo. A página está desativada e não pode ser publicada agora. Fale com %s.', 'Saved. The page is closed and cannot be published now. Contact %s.', 'Guardado. La página está desactivada y no se puede publicar ahora. Escribe a %s.'],
    'fl.publisert'  => ['Publisert! Endringene er nå på %s.', 'Publicado! As mudanças já estão em %s.', 'Published! The changes are now live at %s.', '¡Publicado! Los cambios ya están en %s.'],
    'fl.gratulerer' => ['Gratulerer! Siden din er nå på nett: %s.', 'Parabéns! Sua página já está no ar: %s.', 'Congratulations! Your page is now online: %s.', '¡Enhorabuena! Tu página ya está en línea: %s.'],
    'fl.sendt'      => ['Takk! Siden er sendt til aktivering. Du får e-post når den er på nett, normalt innen én virkedag.', 'Obrigado! A página foi enviada para ativação. Você recebe um e-mail quando ela entrar no ar, normalmente em até um dia útil.', 'Thank you! The page has been sent for activation. You will get an email when it is online, normally within one working day.', '¡Gracias! La página se ha enviado para activarla. Recibirás un correo cuando esté en línea, normalmente en un día laborable.'],

    /* Página publicada */
    's.bedriften'   => ['Bedriften din', 'Sua empresa', 'Your business', 'Tu empresa'],
    's.forhand'     => ['Forhåndsvisning – ikke publisert.', 'Prévia – não publicada.', 'Preview – not published.', 'Vista previa – sin publicar.'],
    's.tilbake'     => ['Tilbake til Min side', 'Voltar ao Min side', 'Back to Min side', 'Volver a Min side'],
    's.meny'        => ['Hovedmeny', 'Menu principal', 'Main menu', 'Menú principal'],
    's.om'          => ['Om oss', 'Sobre nós', 'About us', 'Sobre nosotros'],
    's.kontakt'     => ['Kontakt', 'Contato', 'Contact', 'Contacto'],
    's.kontakt_oss' => ['Kontakt oss', 'Fale com a gente', 'Contact us', 'Contáctanos'],
    's.ring'        => ['Ring %s', 'Ligue %s', 'Call %s', 'Llama al %s'],
    's.se'          => ['Se %s', 'Ver %s', 'See %s', 'Ver %s'],
    's.telefon'     => ['Telefon', 'Telefone', 'Phone', 'Teléfono'],
    's.epost'       => ['E-post', 'E-mail', 'Email', 'Correo'],
    's.adresse'     => ['Adresse', 'Endereço', 'Address', 'Dirección'],
    's.tider'       => ['Åpningstider', 'Horário de funcionamento', 'Opening hours', 'Horario'],
    's.bilder'      => ['Bilder', 'Fotos', 'Photos', 'Fotos'],
    's.fra'         => ['Nettside fra Digital Løsninger', 'Site feito com Digital Solutions', 'Website by Digital Solutions', 'Web hecha con Digital Solutions'],
    's.404.h'       => ['Siden finnes ikke', 'A página não existe', 'This page does not exist', 'La página no existe'],
    's.404.p'       => ['Denne adressen er ikke i bruk, eller siden er midlertidig stengt.', 'Este endereço não está em uso, ou a página está temporariamente desativada.', 'This address is not in use, or the page is temporarily closed.', 'Esta dirección no está en uso, o la página está desactivada temporalmente.'],
    's.404.lenke'   => ['Til dsnorge.com', 'Ir para dsnorge.com', 'Go to dsnorge.com', 'Ir a dsnorge.com'],
];

/** Nomes de layouts e temas no idioma atual. */
function layout_navn(string $id): array
{
    $n = [
        'a' => [['Bilde øverst', 'Stort bilde over hele toppen, tekst oppå.'], ['Imagem no topo', 'Imagem grande em todo o topo, com o texto por cima.'], ['Image on top', 'Large image across the top, text over it.'], ['Imagen arriba', 'Imagen grande en toda la parte superior, con el texto encima.']],
        'b' => [['Bilde ved siden', 'Tekst til venstre, bilde til høyre, tjenester som kort.'], ['Imagem ao lado', 'Texto à esquerda, imagem à direita, serviços em cartões.'], ['Image beside', 'Text on the left, image on the right, services as cards.'], ['Imagen al lado', 'Texto a la izquierda, imagen a la derecha, servicios en tarjetas.']],
    ][$id] ?? null;
    $i = array_search(sprak(), array_keys(SPRAK), true);
    return $n ? ['navn' => $n[$i][0], 'tekst' => $n[$i][1]] : ['navn' => $id, 'tekst' => ''];
}

function tema_navn(string $id): string
{
    $n = [
        'babyblaa'  => ['Babyblå', 'Azul bebê', 'Baby blue', 'Azul bebé'],
        'babygronn' => ['Babygrønn', 'Verde bebê', 'Baby green', 'Verde bebé'],
        'babygul'   => ['Babygul', 'Amarelo bebê', 'Baby yellow', 'Amarillo bebé'],
        'rosa'      => ['Rosa', 'Rosa', 'Pink', 'Rosa'],
        'lilla'     => ['Lilla', 'Lilás', 'Lilac', 'Lila'],
        'sand'      => ['Sand', 'Areia', 'Sand', 'Arena'],
    ][$id] ?? [$id];
    $i = array_search(sprak(), array_keys(SPRAK), true);
    return $n[$i] ?? $n[0];
}
