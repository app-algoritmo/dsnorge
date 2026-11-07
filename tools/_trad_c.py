# -*- coding: utf-8 -*-
"""Tabela de tradução — parte C: landing page e páginas de pedido
(src/pages/index.html, bestill.html, takk.html e os partials landing-*).
Ordem de cada tupla: (en, no, es). Ver tools/traduzir.py.
A página vilkar.html usa as chaves vilk.* (tools/_trad_d.py)."""

T = {
# Cabeçalho
"lp.nav.modelos": ("Models", "Modeller", "Modelos"),
"lp.nav.preco": ("Price", "Pris", "Precio"),
"lp.nav.como": (
  "How it works",
  "Slik fungerer det",
  "Cómo funciona"),
"lp.nav.faq": ("Questions", "Spørsmål", "Preguntas"),
"lp.nav.bestill": ('Get started', 'Kom i gang', 'Empieza ahora'),
"lp.hero.eyebrow": ('Websites for every sector and profession', 'Nettsider for alle bransjer og yrker', 'Webs para todos los sectores y profesiones'),
"lp.hero.titulo": (
  "Is your business not online yet?",
  "Er bedriften din ikke på nett ennå?",
  "¿Tu empresa todavía no está en internet?"),
"lp.hero.lead": (
  "Most customers search online before they get in touch. With our editor you build a simple, good-looking page in just a few clicks, no coding needed.",
  "De fleste kunder sjekker nettet før de tar kontakt. Med vår editor lager du en enkel og pen side med noen få klikk, uten å kunne koding.",
  "La mayoría de los clientes busca en internet antes de contactar. Con nuestro editor montas una página sencilla y bonita en pocos clics, sin saber programar."),
"lp.hero.cta2": ("See the models", "Se modellene", "Ver los modelos"),
"lp.cta.pedir": ('Start for free', 'Kom i gang gratis', 'Empieza gratis'),
"lp.selo": (
  "30 days free",
  "30 dager gratis",
  "30 días gratis"),
"lp.oferta.titulo": (
  "Build your landing page in a few clicks",
  "Lag landingssiden din med noen få klikk",
  "Monta tu landing page en pocos clics"),
"lp.oferta.mes": ("/month, total price", "/mnd, totalpris", "/mes, precio final"),
"lp.oferta.cond": (
  'No setup fee. 30 days free. No commitment. Your own domain connected for free.',
  'Ingen oppstartskostnad. 30 dager gratis. Ingen bindingstid. Eget domene kobles til gratis.',
  'Sin coste inicial. 30 días gratis. Sin permanencia. Tu propio dominio conectado gratis.'),
"lp.mod.titulo": ("Choose the model for your business", "Velg modellen som passer bedriften din", "Elige el modelo para tu empresa"),
"lp.mod.lead": (
  "Three ready-made models, all at the same price. You choose the layout and colours and add your own text and photos.",
  "Tre ferdige modeller, alle til samme pris. Du velger oppsett og farger og legger inn egne tekster og bilder.",
  "Tres modelos listos, todos al mismo precio. Tú eliges el diseño y los colores y pones tus textos y fotos."),
"lp.mod.m1.t": (
  'Services and trades',
  'Tjenester og håndverk',
  'Servicios y profesionales'),
"lp.mod.m1.d": (
  'For anyone selling a service: carpenter, electrician, lawyer, accountant, gardener, firewood cutter. What you do, where you work and how to ask for a quote.',
  'For alle som selger tjenester: snekker, elektriker, advokat, regnskapsfører, gartner, vedhogger. Hva du gjør, hvor du jobber og hvordan kunden ber om tilbud.',
  'Para quien ofrece servicios: carpintero, electricista, abogado, gestor, jardinero, leñador. Qué haces, dónde trabajas y cómo pedir presupuesto.'),
"lp.mod.m2.t": (
  'Food, shop and products',
  'Mat, butikk og varer',
  'Comida, tienda y productos'),
"lp.mod.m2.d": (
  'For cafés, pizzerias, bakeries, farm shops and firewood sales: menu or products with prices, opening hours and map.',
  'For kafé, pizzeria, bakeri, gårdsbutikk og vedsalg: meny eller varer med pris, åpningstider og kart.',
  'Para cafeterías, pizzerías, panaderías, tiendas de granja y venta de leña: carta o productos con precio, horario y mapa.'),
"lp.mod.m3.t": (
  'Appointments and wellness',
  'Timebestilling og velvære',
  'Citas y bienestar'),
"lp.mod.m3.d": (
  'For hairdressers, nail studios, physiotherapists, personal trainers and dog groomers: treatments, prices and a booking link.',
  'For frisør, negler, fysioterapeut, PT og hundefrisør: behandlinger, priser og lenke til timebestilling.',
  'Para peluquerías, uñas, fisioterapeutas, entrenadores personales y peluquerías caninas: tratamientos, precios y enlace para pedir cita.'),
"lp.mod.m1.alt": ("Example of a carpenter's page on a computer and a phone", "Eksempel på nettside for en tømrer på PC og mobil", "Ejemplo de página de carpintero en el ordenador y el móvil"),
"lp.mod.m2.alt": ("Example of a bakery and café page on a computer and a phone", "Eksempel på nettside for et bakeri og en kafé på PC og mobil", "Ejemplo de página de panadería y cafetería en el ordenador y el móvil"),
"lp.mod.m3.alt": ("Example of a hair salon page on a computer and a phone", "Eksempel på nettside for en frisørsalong på PC og mobil", "Ejemplo de página de peluquería en el ordenador y el móvil"),
"lp.mod.preco": ("399 kr/month", "399 kr/mnd", "399 kr/mes"),

# Incluído
"lp.inc.titulo": (
  "Everything you need to get online",
  "Alt du trenger for å komme på nett",
  "Todo lo que necesitas para estar en internet"),
"lp.inc.lead": ('Build your own website in 5 minutes.', 'Lag nettsiden din selv på 5 minutter.', 'Crea tu propia web en 5 minutos.'),
"lp.inc.i1": (
  "Easy editor with 2 layouts and 6 colour themes",
  "Enkel editor med 2 oppsett og 6 fargetemaer",
  "Editor fácil, con 2 diseños y 6 temas de colores"),
"lp.inc.i2": ("Works on mobile and tablet", "Tilpasset mobil og nettbrett", "Adaptada a móvil y tableta"),
"lp.inc.i3": ("Hosting and SSL certificate", "Webhotell og SSL-sertifikat", "Alojamiento y certificado SSL"),
"lp.inc.i4": (
  "Phone, SMS and email buttons for your customers",
  "Knapper for telefon, SMS og e-post for kundene dine",
  "Botones de teléfono, SMS y correo para tus clientes"),
"lp.inc.i5": ("Links to Facebook and Instagram", "Lenker til Facebook og Instagram", "Enlaces a Facebook e Instagram"),
"lp.inc.i6": (
  "Change text, prices, opening hours and photos whenever you like and publish instantly",
  "Endre tekst, priser, åpningstider og bilder når du vil, og publiser med en gang",
  "Cambia textos, precios, horarios y fotos cuando quieras y publica al instante"),
"lp.inc.i7": (
  'Free address side.dsnorge.com/yourbusiness, or your own domain connected for free',
  'Gratis adresse side.dsnorge.com/dinbedrift, eller ditt eget domene koblet til gratis',
  'Dirección gratis side.dsnorge.com/tuempresa, o tu propio dominio conectado gratis'),
"lp.plano.rot": ("Landing page", "Landingsside", "Landing page"),
"lp.preco.r1": ("<strong>Setup fee:</strong> 0 kr", "<strong>Oppstart:</strong> 0 kr", "<strong>Coste de creación:</strong> 0 kr"),
"lp.preco.r2": (
  '<strong>Commitment:</strong> none',
  '<strong>Bindingstid:</strong> ingen',
  '<strong>Permanencia:</strong> ninguna'),
"lp.preco.r3": (
  '<strong>Cancellation:</strong> any time, effective at the end of the paid month',
  '<strong>Oppsigelse:</strong> når som helst, gjelder ut betalt måned',
  '<strong>Cancelación:</strong> cuando quieras, válida hasta el final del mes pagado'),
"lp.preco.r4": (
  '<strong>Own domain:</strong> you buy it (about 100–150 kr/year) and we connect it for free',
  '<strong>Eget domene:</strong> du kjøper det (ca. 100–150 kr/år), vi kobler det til gratis',
  '<strong>Dominio propio:</strong> lo compras tú (unos 100–150 kr/año) y lo conectamos gratis'),
"lp.preco.r5": (
  "<strong>Free period:</strong> 30 days",
  "<strong>Gratisperiode:</strong> 30 dager",
  "<strong>Periodo gratuito:</strong> 30 días"),
"lp.preco.r6": (
  '<strong>Support:</strong> chat assistant on the website and in Min side, at no extra cost',
  '<strong>Support:</strong> chatassistent på nettsiden og på Min side, uten ekstra kostnad',
  '<strong>Soporte:</strong> asistente de chat en la web y en Min side, sin coste adicional'),

# Como trabalhamos
"lp.como.titulo": (
  "How it works",
  "Slik fungerer det",
  "Cómo funciona"),
"lp.como.p1.t": ('Sign up online', 'Registrer deg på nett', 'Regístrate online'),
"lp.como.p1.d": (
  "Choose the model, tell us about your business and send your logo and photos. It takes a few minutes.",
  "Velg modell, fortell om bedriften og send logo og bilder. Det tar bare noen minutter.",
  "Elige el modelo, cuéntanos sobre tu empresa y envía logo y fotos. Lleva pocos minutos."),
"lp.como.p2.t": (
  "Build the page in Min side",
  "Lag siden i Min side",
  "Monta la página en Min side"),
"lp.como.p2.d": (
  "Log in with your email and find the page already filled in with what you sent. Adjust text, photos, colours and layout, and see a preview.",
  "Logg inn med e-postadressen din, og siden er allerede fylt ut med det du sendte. Juster tekst, bilder, farger og oppsett, og se forhåndsvisning.",
  "Entra con tu e-mail y encontrarás la página ya rellenada con lo que enviaste. Ajusta textos, fotos, colores y diseño, y mira la vista previa."),
"lp.como.p3.t": (
  "Publish",
  "Publiser",
  "Publica"),
"lp.como.p3.d": (
  "Click publish and the page goes live instantly at side.dsnorge.com/yourbusiness. Every later change also goes live instantly.",
  "Trykk på publiser, så er siden på nett med en gang, på side.dsnorge.com/dinbedrift. Alle senere endringer vises også med en gang.",
  "Haz clic en publicar y la página se publica al instante en side.dsnorge.com/tuempresa. Cada cambio posterior también se publica al instante."),

# Perguntas
"lp.faq.titulo": ("Frequently asked questions", "Vanlige spørsmål", "Preguntas frecuentes"),
"lp.faq.q1": (
  'Is there a commitment period?',
  'Er det bindingstid?',
  '¿Hay permanencia?'),
"lp.faq.a1": (
  'No. The subscription runs month to month and you can cancel any time. Your page stays online until the end of the month you have paid for.',
  'Nei. Abonnementet løper måned for måned, og du kan si opp når som helst. Siden er på nett ut måneden du har betalt for.',
  'No. La suscripción es mes a mes y puedes cancelarla cuando quieras. Tu página sigue en línea hasta el final del mes ya pagado.'),
"lp.faq.q2": ("How long does it take?", "Hvor lang tid tar det?", "¿Cuánto tarda?"),
"lp.faq.a2": (
  "You just fill in the fields and choose the colours, and the page is ready in no time. When you click publish, it goes live instantly.",
  "Du fyller bare inn feltene og velger farger, så er siden klar på kort tid. Når du trykker på publiser, er den på nett med en gang.",
  "Solo rellenas los campos y eliges los colores, y la página queda lista enseguida. Cuando haces clic en publicar, se publica al instante."),
"lp.faq.q3": ("What do you need from me?", "Hva trenger dere fra meg?", "¿Qué necesitáis de mí?"),
"lp.faq.a3": (
  "Your logo, if you have one, a few photos and a short description of the business. You can send it all with the order or add it directly in the editor.",
  "Logoen din hvis du har en, noen bilder og en kort beskrivelse av bedriften. Du kan sende alt med bestillingen eller legge det inn rett i editoren.",
  "Tu logo, si tienes, algunas fotos y una breve descripción de la empresa. Puedes enviarlo todo con el pedido o directamente en el editor."),
"lp.faq.q4": ("How do I update the page?", "Hvordan oppdaterer jeg siden?", "¿Cómo actualizo la página?"),
"lp.faq.a4": (
  'Log in at minside.dsnorge.com with your email. There you change text, prices, opening hours, photos and colours and publish instantly. Any questions? Ask our assistant in the corner of the screen.',
  'Logg inn på minside.dsnorge.com med e-postadressen din. Der endrer du tekst, priser, åpningstider, bilder og farger og publiserer med en gang. Lurer du på noe? Spør assistenten vår nede i hjørnet.',
  'Entra en minside.dsnorge.com con tu e-mail. Allí cambias textos, precios, horarios, fotos y colores y publicas al instante. ¿Tienes dudas? Pregunta a nuestro asistente en la esquina de la pantalla.'),
"lp.faq.q5": ("What about the domain?", "Hva med domene?", "¿Y el dominio?"),
"lp.faq.a5": (
  'Your page gets a free address, such as side.dsnorge.com/yourbusiness. If you want your own domain, such as yourbusiness.no, you buy it in your own name (about 100–150 kr a year, for example at Domeneshop) and we connect it to your page for free.',
  'Siden får en gratis adresse, som side.dsnorge.com/dinbedrift. Vil du ha eget domene, som dinbedrift.no, kjøper du det i ditt navn (ca. 100–150 kr i året, for eksempel hos Domeneshop), og vi kobler det til siden din gratis.',
  'Tu página recibe una dirección gratis, como side.dsnorge.com/tuempresa. Si quieres tu propio dominio, como tuempresa.no, lo compras a tu nombre (unos 100–150 kr al año, por ejemplo en Domeneshop) y lo conectamos a tu página gratis.'),
"lp.faq.q6": ("How do I pay?", "Hvordan betaler jeg?", "¿Cómo pago?"),
"lp.faq.a6": (
  "By card, automatically every month. The first 30 days are free: billing starts when the page is published or after 30 days at the latest. You get the receipt by email.",
  "Med kort, automatisk hver måned. De første 30 dagene er gratis: trekket starter når siden publiseres, eller senest etter 30 dager. Du får kvittering på e-post.",
  "Con tarjeta, de forma automática cada mes. Los primeros 30 días son gratis: el cobro empieza cuando se publica la página o, como máximo, a los 30 días. Recibes el recibo por e-mail."),
"lp.faq.q7": ("Can I get a bigger website later?", "Kan jeg få en større nettside senere?", "¿Puedo tener un sitio más grande después?"),
"lp.faq.a7": (
  "Yes. The landing page can grow into a full website or an online shop. You get a separate quote before we start.",
  "Ja. Landingssiden kan bygges ut til en full nettside eller nettbutikk. Du får et eget tilbud før vi starter.",
  "Sí. La landing page puede crecer hasta un sitio completo o una tienda online. Recibes un presupuesto aparte antes de empezar."),

# Chamada final
"lp.cta.titulo": ("Ready to get online?", "Klar for å komme på nett?", "¿Listo para estar en internet?"),
"lp.cta.lead": ('Get started in a few minutes. You get a confirmation by email right away.', 'Kom i gang på noen minutter. Du får bekreftelse på e-post med en gang.', 'Empieza en pocos minutos. Recibes la confirmación por correo al instante.'),
"lp.cta.duvidas": ("Questions?", "Spørsmål?", "¿Dudas?"),

# Rodapé
"lp.rodape.marca": ("Digital Løsninger · since 2010", "Digital Løsninger · siden 2010", "Digital Løsninger · desde 2010"),
"lp.rodape.empresa": ("About Digital Solutions", "Om Digital Solutions", "Sobre Digital Solutions"),
"lp.rodape.conta": ("Manage subscription", "Administrer abonnement", "Gestionar suscripción"),
"lp.nav.minside": (
  "Min side",
  "Min side",
  "Min side"),
"lp.faq.q8": (
  "Do I need to be good with technology?",
  "Må jeg kunne noe om teknologi?",
  "¿Necesito saber de tecnología?"),
"lp.faq.a8": (
  "No. You just fill in fields and pick from ready-made options, like a form. We take care of hosting, security and the address.",
  "Nei. Du fyller bare inn felt og velger blant ferdige alternativer, som i et skjema. Vi tar oss av webhotell, sikkerhet og adresse.",
  "No. Solo rellenas campos y eliges entre opciones listas, como en un formulario. Nosotros nos encargamos del alojamiento, la seguridad y la dirección."),
"lp.takk.minside": (
  "Go to Min side",
  "Gå til Min side",
  "Ir a Min side"),
"lp.rodape.minside": (
  "Min side (edit page)",
  "Min side (rediger siden)",
  "Min side (editar página)"),
"lp.rodape.vilkar": ("Terms and conditions", "Vilkår", "Términos y condiciones"),

# Página de pedido
"lp.best.eyebrow": ('30 days free', '30 dager gratis', '30 días gratis'),
"lp.best.titulo": ('Create your landing page', 'Lag landingssiden din', 'Crea tu landing page'),
"lp.best.lead": (
  "It takes about 5 minutes. At the end of the form you register your card. The first 30 days are free.",
  "Det tar ca. 5 minutter. Til slutt registrerer du kortet. De første 30 dagene er gratis.",
  "Tarda unos 5 minutos. Al final del formulario registras la tarjeta. Los primeros 30 días son gratis."),
"lp.best.resumo": ("Summary of terms", "Kort om vilkårene", "Resumen de condiciones"),
"lp.best.c1": ("<strong>Price:</strong> 399 kr/month, total price", "<strong>Pris:</strong> 399 kr/mnd, totalpris", "<strong>Precio:</strong> 399 kr/mes, precio final"),
# Formulário de pedido
"lp.form.modelo": ("Choose the model *", "Velg modell *", "Elige el modelo *"),
"lp.form.mod.m1.ex": ("E.g. carpenter, electrician, lawyer, accountant, gardener, firewood cutter", "F.eks. snekker, elektriker, advokat, regnskapsfører, gartner, vedhogger", "P. ej. carpintero, electricista, abogado, gestor, jardinero, leñador"),
"lp.form.mod.m2.ex": ("E.g. café, pizzeria, bakery, farm shop, firewood sales", "F.eks. kafé, pizzeria, bakeri, gårdsbutikk, vedsalg", "P. ej. cafetería, pizzería, panadería, tienda de granja, venta de leña"),
"lp.form.mod.m3.ex": ("E.g. hairdresser, nails, physiotherapist, personal trainer, dog groomer", "F.eks. frisør, negler, fysioterapeut, PT, hundefrisør", "P. ej. peluquería, uñas, fisioterapeuta, entrenador personal, peluquería canina"),
"lp.form.mod.dica": ("Can't find your sector? Pick the closest one. You can change the headings yourself later in Min side.", "Finner du ikke bransjen din? Velg den som ligner mest. Overskriftene kan du endre selv etterpå på Min side.", "¿No encuentras tu sector? Elige el más parecido. Los títulos los cambias tú después en Min side."),
"lp.form.kilde": ("How did you hear about us?", "Hvor hørte du om oss?", "¿Cómo nos conociste?"),
"lp.form.kilde.velg": ("Choose (optional)", "Velg (valgfritt)", "Elige (opcional)"),
"lp.form.kilde.flyer": ("Flyer", "Brosjyre i postkassen", "Folleto"),
"lp.form.kilde.anbefaling": ("Recommended by someone", "Anbefalt av noen", "Me lo recomendaron"),
"lp.form.kilde.annet": ("Other", "Annet", "Otro"),
"lp.form.empresa": ("Business name *", "Bedriftsnavn *", "Nombre de la empresa *"),
"lp.form.orgnr": ("Organisation number (9 digits) *", "Org.nr. (9 siffer) *", "Número de organización (9 dígitos) *"),
"lp.form.land": ("Country of the business *", "Bedriftens land *", "País de la empresa *"),
"lp.form.land.no": ("Norway", "Norge", "Noruega"),
"lp.form.land.xx": ("Other country", "Annet land", "Otro país"),
"lp.form.regnr": ("Company registration number *", "Bedriftens registreringsnummer *", "Número de registro de la empresa *"),
"lp.form.contato": ("Contact person *", "Kontaktperson *", "Persona de contacto *"),
"lp.form.email": ("Email *", "E-post *", "Correo electrónico *"),
"lp.form.telefone": ("Phone *", "Telefon *", "Teléfono *"),
"lp.form.subdominio": ("Preferred address", "Ønsket adresse", "Dirección deseada"),
"lp.form.descricao": ("Tell us briefly about the business *", "Fortell kort om bedriften *", "Cuéntanos brevemente sobre la empresa *"),
"lp.form.horario": ("Opening hours or service area", "Åpningstider eller område du dekker", "Horario o zona de servicio"),
"lp.form.arquivos": (
  "Logo and photos (JPG, PNG or WebP, up to 6 files of 8 MB)",
  "Logo og bilder (JPG, PNG eller WebP, inntil 6 filer à 8 MB)",
  "Logo y fotos (JPG, PNG o WebP, hasta 6 archivos de 8 MB)"),
"lp.form.termos": (
  "I accept the <a href=\"/vilkar.html\" target=\"_blank\">subscription terms</a> and order on behalf of a business. *",
  "Jeg godtar <a href=\"/vilkar.html\" target=\"_blank\">abonnementsvilkårene</a> og bestiller på vegne av en bedrift. *",
  "Acepto las <a href=\"/vilkar.html\" target=\"_blank\">condiciones de la suscripción</a> y hago el pedido en nombre de una empresa. *"),
"lp.form.enviar": ("Send and go to payment", "Send og gå til betaling", "Enviar e ir al pago"),
"lp.form.msg.enviando": ("Sending…", "Sender …", "Enviando…"),
"lp.form.msg.invalido": ("Please check the marked fields.", "Sjekk feltene som er markert.", "Revisa los campos marcados."),
"lp.form.msg.erro": (
  "We could not send it right now. Try again or write to info@dsnorge.com.",
  "Vi fikk ikke sendt bestillingen nå. Prøv igjen, eller skriv til info@dsnorge.com.",
  "No se ha podido enviar ahora. Inténtalo de nuevo o escribe a info@dsnorge.com."),
"lp.form.msg.inativo": (
  "Online ordering is not active yet. Please write to info@dsnorge.com.",
  "Bestilling på nett er ikke aktivert ennå. Skriv til info@dsnorge.com.",
  "El pedido online aún no está activo. Escribe a info@dsnorge.com."),
"lp.best.privacidade": (
  "Your details are stored on our own server. Card payment is processed by Stripe.",
  "Opplysningene dine lagres på vår egen server. Kortbetalingen håndteres av Stripe.",
  "Tus datos se guardan en nuestro propio servidor. El pago con tarjeta lo procesa Stripe."),

# Página de agradecimento
"lp.takk.eyebrow": ("Order received", "Bestilling mottatt", "Pedido recibido"),
"lp.takk.titulo": ("Thank you for your order!", "Takk for bestillingen!", "¡Gracias por tu pedido!"),
"lp.takk.lead": (
  "You'll receive a confirmation by email. Now just log in to Min side with the same email and build your page.",
  "Du får en bekreftelse på e-post. Nå er det bare å logge inn på Min side med samme e-postadresse og lage siden din.",
  "Recibirás una confirmación por e-mail. Ahora solo tienes que entrar en Min side con el mismo e-mail y montar tu página."),
"lp.takk.cobranca": (
  "The first 30 days are free. Billing of 399 kr starts when the page is published or after 30 days at the latest.",
  "De første 30 dagene er gratis. Trekket på 399 kr starter når siden publiseres, eller senest etter 30 dager.",
  "Los primeros 30 días son gratis. El cobro de 399 kr empieza cuando se publica la página o, como máximo, a los 30 días."),
"lp.takk.voltar": ("Back to the home page", "Tilbake til forsiden", "Volver a la página de inicio"),
}
