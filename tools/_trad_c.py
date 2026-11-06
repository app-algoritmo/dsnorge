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
"lp.nav.bestill": ("Order now", "Bestill nå", "Pedir ahora"),

# Abertura e oferta
"lp.hero.eyebrow": (
  "Websites for businesses in Hvarnes and the surrounding area",
  "Nettsider for bedrifter i Hvarnes og omegn",
  "Sitios web para empresas de Hvarnes y alrededores"),
"lp.hero.titulo": (
  "Is your business not online yet?",
  "Er bedriften din ikke på nett ennå?",
  "¿Tu empresa todavía no está en internet?"),
"lp.hero.lead": (
  "Most customers search online before they get in touch. With our editor you build a simple, good-looking page in just a few clicks, no coding needed.",
  "De fleste kunder sjekker nettet før de tar kontakt. Med vår editor lager du en enkel og pen side med noen få klikk, uten å kunne koding.",
  "La mayoría de los clientes busca en internet antes de contactar. Con nuestro editor montas una página sencilla y bonita en pocos clics, sin saber programar."),
"lp.hero.cta2": ("See the models", "Se modellene", "Ver los modelos"),
"lp.cta.pedir": ("Order your landing page", "Bestill landingsside", "Pide tu landing page"),
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
  "No setup fee. 30 days free. 12-month commitment. Own domain not included.",
  "Ingen oppstartskostnad. 30 dager gratis. 12 måneders bindingstid. Eget domene er ikke inkludert.",
  "Sin coste inicial. 30 días gratis. Permanencia de 12 meses. Dominio propio no incluido."),

# Modelos
"lp.mod.titulo": ("Choose the model for your business", "Velg modellen som passer bedriften din", "Elige el modelo para tu empresa"),
"lp.mod.lead": (
  "Three ready-made models, all at the same price. You choose the layout and colours and add your own text and photos.",
  "Tre ferdige modeller, alle til samme pris. Du velger oppsett og farger og legger inn egne tekster og bilder.",
  "Tres modelos listos, todos al mismo precio. Tú eliges el diseño y los colores y pones tus textos y fotos."),
"lp.mod.m1.t": ("Trades and services", "Håndverk og service", "Oficios y servicios"),
"lp.mod.m1.d": (
  "For carpenters, plumbers, electricians and other services: what you do, where you work and how to ask for a quote.",
  "For snekker, rørlegger, elektriker og andre tjenester: hva du gjør, hvor du jobber og hvordan kunden ber om tilbud.",
  "Para carpinteros, fontaneros, electricistas y otros servicios: qué haces, dónde trabajas y cómo pedir presupuesto."),
"lp.mod.m2.t": ("Food and shop", "Mat og butikk", "Comida y tienda"),
"lp.mod.m2.d": (
  "For cafés, pizzerias and farm shops: menu or products, opening hours and map.",
  "For kafé, pizzeria og gårdsbutikk: meny eller varer, åpningstider og kart.",
  "Para cafeterías, pizzerías y tiendas de granja: carta o productos, horario y mapa."),
"lp.mod.m3.t": ("Wellness and booking", "Velvære og timer", "Bienestar y citas"),
"lp.mod.m3.d": (
  "For hairdressers, nail studios and foot care: treatments, prices and a booking link.",
  "For frisør, negler og fotterapi: behandlinger, priser og lenke til timebestilling.",
  "Para peluquerías, manicura y podología: tratamientos, precios y enlace para reservar cita."),
"lp.mod.preco": ("399 kr/month", "399 kr/mnd", "399 kr/mes"),

# Incluído
"lp.inc.titulo": (
  "Everything you need to get online",
  "Alt du trenger for å komme på nett",
  "Todo lo que necesitas para estar en internet"),
"lp.inc.lead": (
  "All of this is included in the monthly price. No hidden costs.",
  "Alt dette er inkludert i månedsprisen. Ingen skjulte kostnader.",
  "Todo esto está incluido en la cuota mensual. Sin costes ocultos."),
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
  "Free address: side.dsnorge.com/yourbusiness",
  "Gratis adresse: side.dsnorge.com/dinbedrift",
  "Dirección gratis: side.dsnorge.com/tuempresa"),

# Plano
"lp.plano.rot": ("Landing page", "Landingsside", "Landing page"),
"lp.preco.r1": ("<strong>Setup fee:</strong> 0 kr", "<strong>Oppstart:</strong> 0 kr", "<strong>Coste de creación:</strong> 0 kr"),
"lp.preco.r2": ("<strong>Commitment:</strong> 12 months", "<strong>Bindingstid:</strong> 12 måneder", "<strong>Permanencia:</strong> 12 meses"),
"lp.preco.r3": (
  "<strong>After that:</strong> month to month, one month’s notice",
  "<strong>Deretter:</strong> løpende, med én måneds oppsigelse",
  "<strong>Después:</strong> mes a mes, con un mes de preaviso"),
"lp.preco.r4": (
  "<strong>Own domain:</strong> not included (free address on dsnorge.com)",
  "<strong>Eget domene:</strong> ikke inkludert (gratis adresse på dsnorge.com)",
  "<strong>Dominio propio:</strong> no incluido (dirección gratis en dsnorge.com)"),
"lp.preco.r5": (
  "<strong>Free period:</strong> 30 days",
  "<strong>Gratisperiode:</strong> 30 dager",
  "<strong>Periodo gratuito:</strong> 30 días"),
"lp.preco.r6": (
  "<strong>Help from our team:</strong> 450 kr per task",
  "<strong>Hjelp fra oss:</strong> 450 kr per oppgave",
  "<strong>Ayuda de nuestro equipo:</strong> 450 kr por tarea"),

# Como trabalhamos
"lp.como.titulo": (
  "How it works",
  "Slik fungerer det",
  "Cómo funciona"),
"lp.como.p1.t": ("Order online", "Bestill på nett", "Haz el pedido online"),
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
"lp.faq.q1": ("What happens after 12 months?", "Hva skjer etter 12 måneder?", "¿Qué pasa después de 12 meses?"),
"lp.faq.a1": (
  "The subscription continues month to month. You can cancel with one month's notice.",
  "Abonnementet fortsetter måned for måned. Du kan si opp med én måneds varsel.",
  "La suscripción continúa mes a mes. Puedes cancelar con un mes de preaviso."),
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
  "Log in at minside.dsnorge.com with your email. There you change text, prices, opening hours, photos and colours and publish instantly. If you'd rather we do it for you, it costs 450 kr per task.",
  "Logg inn på minside.dsnorge.com med e-postadressen din. Der endrer du tekst, priser, åpningstider, bilder og farger og publiserer med en gang. Vil du heller at vi gjør det for deg, koster det 450 kr per oppgave.",
  "Entra en minside.dsnorge.com con tu e-mail. Allí cambias textos, precios, horarios, fotos y colores y publicas al instante. Si prefieres que lo hagamos nosotros, cuesta 450 kr por tarea."),
"lp.faq.q5": ("What about the domain?", "Hva med domene?", "¿Y el dominio?"),
"lp.faq.a5": (
  "The page gets a free address, like side.dsnorge.com/yourbusiness. If you want your own domain, like yourbusiness.no, you register it in your name and we connect it. Your own domain is not included in the price.",
  "Siden får en gratis adresse, som side.dsnorge.com/dinbedrift. Vil du ha eget domene, som dinbedrift.no, registrerer du det i ditt navn, og vi kobler det til. Eget domene er ikke inkludert i prisen.",
  "La página recibe una dirección gratis, como side.dsnorge.com/tuempresa. Si quieres un dominio propio, como tuempresa.no, lo registras a tu nombre y lo conectamos. El dominio propio no está incluido en el precio."),
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
"lp.cta.lead": (
  "Order online in a few minutes. You get the confirmation by email right away.",
  "Bestill på nett på noen minutter. Du får bekreftelse på e-post med en gang.",
  "Haz el pedido online en pocos minutos. Recibes la confirmación por correo al instante."),
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
"lp.best.eyebrow": ("Online order", "Bestilling på nett", "Pedido online"),
"lp.best.titulo": ("Order your landing page", "Bestill landingssiden din", "Pide tu landing page"),
"lp.best.lead": (
  "It takes about 5 minutes. At the end of the form you register your card. The first 30 days are free.",
  "Det tar ca. 5 minutter. Til slutt registrerer du kortet. De første 30 dagene er gratis.",
  "Tarda unos 5 minutos. Al final del formulario registras la tarjeta. Los primeros 30 días son gratis."),
"lp.best.resumo": ("Summary of terms", "Kort om vilkårene", "Resumen de condiciones"),
"lp.best.c1": ("<strong>Price:</strong> 399 kr/month, total price", "<strong>Pris:</strong> 399 kr/mnd, totalpris", "<strong>Precio:</strong> 399 kr/mes, precio final"),
# Formulário de pedido
"lp.form.modelo": ("Choose the model *", "Velg modell *", "Elige el modelo *"),
"lp.form.empresa": ("Business name *", "Bedriftsnavn *", "Nombre de la empresa *"),
"lp.form.orgnr": ("Organisation number (9 digits) *", "Org.nr. (9 siffer) *", "Número de organización (9 dígitos) *"),
"lp.form.land": ("Country of the business *", "Bedriftens land *", "País de la empresa *"),
"lp.form.land.no": ("Norway", "Norge", "Noruega"),
"lp.form.land.br": ("Brazil", "Brasil", "Brasil"),
"lp.form.land.xx": ("Other country", "Annet land", "Otro país"),
"lp.form.cnpj": ("CNPJ (14 characters) *", "CNPJ (14 tegn) *", "CNPJ (14 caracteres) *"),
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
