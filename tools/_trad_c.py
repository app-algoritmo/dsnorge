# -*- coding: utf-8 -*-
"""Tabela de tradução — parte C: landing page e páginas de pedido
(src/pages/index.html, bestill.html, takk.html e os partials landing-*).
Ordem de cada tupla: (en, no, es). Ver tools/traduzir.py.
A página vilkar.html é só em norueguês e não usa chaves."""

T = {
# Cabeçalho
"lp.nav.modelos": ("Models", "Modeller", "Modelos"),
"lp.nav.preco": ("Price", "Pris", "Precio"),
"lp.nav.como": ("How we work", "Slik jobber vi", "Cómo trabajamos"),
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
  "Most customers look online before they get in touch. We build a simple, tidy page that makes it easy to find you, and easy to contact you.",
  "De fleste kunder sjekker nettet før de tar kontakt. Vi lager en enkel og ryddig side som gjør det lett å finne deg, og lett å ta kontakt.",
  "La mayoría de los clientes busca en internet antes de contactar. Creamos una página sencilla y ordenada que facilita encontrarte y ponerse en contacto."),
"lp.hero.cta2": ("See the models", "Se modellene", "Ver los modelos"),
"lp.cta.pedir": ("Order your landing page", "Bestill landingsside", "Pide tu landing page"),
"lp.selo": ("Free to get started", "Gratis å komme i gang", "Gratis para empezar"),
"lp.oferta.titulo": (
  "We build your landing page for free",
  "Vi lager landingssiden din gratis",
  "Creamos tu landing page gratis"),
"lp.oferta.mes": ("/month, total price", "/mnd, totalpris", "/mes, precio final"),
"lp.oferta.cond": (
  "No setup cost. 12-month commitment. Own domain not included.",
  "Ingen oppstartskostnad. 12 måneders bindingstid. Eget domene er ikke inkludert.",
  "Sin coste inicial. Permanencia de 12 meses. Dominio propio no incluido."),

# Modelos
"lp.mod.titulo": ("Choose the model for your business", "Velg modellen som passer bedriften din", "Elige el modelo para tu empresa"),
"lp.mod.lead": (
  "Three ready-made models, all at the same price. We adapt texts, photos and colours to your business.",
  "Tre ferdige modeller, alle til samme pris. Vi tilpasser tekst, bilder og farger til bedriften din.",
  "Tres modelos listos, todos al mismo precio. Adaptamos textos, fotos y colores a tu empresa."),
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
"lp.inc.i1": ("Design and setup of the page", "Design og oppsett av siden", "Diseño y configuración de la página"),
"lp.inc.i2": ("Works on mobile and tablet", "Tilpasset mobil og nettbrett", "Adaptada a móvil y tableta"),
"lp.inc.i3": ("Hosting and SSL certificate", "Webhotell og SSL-sertifikat", "Alojamiento y certificado SSL"),
"lp.inc.i4": (
  "Phone, SMS and email buttons for your customers",
  "Knapper for telefon, SMS og e-post for kundene dine",
  "Botones de teléfono, SMS y correo para tus clientes"),
"lp.inc.i5": ("Links to Facebook and Instagram", "Lenker til Facebook og Instagram", "Enlaces a Facebook e Instagram"),
"lp.inc.i6": (
  "You update texts, opening hours and photos yourself, whenever you like",
  "Du oppdaterer tekst, åpningstider og bilder selv, når du vil",
  "Tú actualizas textos, horarios y fotos cuando quieras"),
"lp.inc.i7": (
  "Free address: yourbusiness.dsnorge.com",
  "Gratis adresse: dinbedrift.dsnorge.com",
  "Dirección gratis: tuempresa.dsnorge.com"),

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
  "<strong>Delivery:</strong> 5 business days after the draft is approved",
  "<strong>Levering:</strong> 5 virkedager etter godkjent utkast",
  "<strong>Entrega:</strong> 5 días hábiles tras aprobar el borrador"),
"lp.preco.r6": (
  "<strong>Larger changes:</strong> 450 kr each",
  "<strong>Større endringer:</strong> 450 kr per endring",
  "<strong>Cambios mayores:</strong> 450 kr cada uno"),

# Como trabalhamos
"lp.como.titulo": ("How we work", "Slik jobber vi", "Cómo trabajamos"),
"lp.como.p1.t": ("Order online", "Bestill på nett", "Haz el pedido online"),
"lp.como.p1.d": (
  "Choose the model, tell us about your business and send your logo and photos. It takes a few minutes.",
  "Velg modell, fortell om bedriften og send logo og bilder. Det tar bare noen minutter.",
  "Elige el modelo, cuéntanos sobre tu empresa y envía logo y fotos. Lleva pocos minutos."),
"lp.como.p2.t": ("We make a draft", "Vi lager et utkast", "Hacemos un borrador"),
"lp.como.p2.d": (
  "You review the draft and approve it. The page is ready within 5 business days of approval.",
  "Du får se utkastet og godkjenner det. Siden er klar innen 5 virkedager etter godkjenning.",
  "Revisas el borrador y lo apruebas. La página está lista en 5 días hábiles tras la aprobación."),
"lp.como.p3.t": ("The page goes live", "Siden går live", "La página se publica"),
"lp.como.p3.d": (
  "The monthly price only starts once the page is published. After that, you update whatever you like yourself.",
  "Månedsprisen starter først når siden er publisert. Deretter oppdaterer du selv det du vil.",
  "La cuota mensual empieza solo cuando la página está publicada. Después, tú actualizas lo que quieras."),

# Perguntas
"lp.faq.titulo": ("Frequently asked questions", "Vanlige spørsmål", "Preguntas frecuentes"),
"lp.faq.q1": ("What happens after 12 months?", "Hva skjer etter 12 måneder?", "¿Qué pasa después de 12 meses?"),
"lp.faq.a1": (
  "The subscription continues month to month. You can cancel with one month's notice.",
  "Abonnementet fortsetter måned for måned. Du kan si opp med én måneds varsel.",
  "La suscripción continúa mes a mes. Puedes cancelar con un mes de preaviso."),
"lp.faq.q2": ("How long does it take?", "Hvor lang tid tar det?", "¿Cuánto tarda?"),
"lp.faq.a2": (
  "The page is ready within 5 business days after you approve the draft.",
  "Siden er klar innen 5 virkedager etter at du har godkjent utkastet.",
  "La página está lista en 5 días hábiles después de que apruebes el borrador."),
"lp.faq.q3": ("What do you need from me?", "Hva trenger dere fra meg?", "¿Qué necesitáis de mí?"),
"lp.faq.a3": (
  "Your logo if you have one, a few photos and a short description of the business. You send everything through the order form, and we help you with the texts.",
  "Logo hvis du har en, noen bilder og en kort beskrivelse av bedriften. Du sender alt i bestillingsskjemaet, og vi hjelper deg med tekstene.",
  "Tu logo si tienes uno, algunas fotos y una breve descripción de la empresa. Lo envías todo con el formulario de pedido y te ayudamos con los textos."),
"lp.faq.q4": ("How do I update the page?", "Hvordan oppdaterer jeg siden?", "¿Cómo actualizo la página?"),
"lp.faq.a4": (
  "You get a link to a simple form. There you change texts, opening hours, prices and photos, and the page updates by itself. Larger changes, like a new section, cost 450 kr each.",
  "Du får en lenke til et enkelt skjema. Der endrer du tekst, åpningstider, priser og bilder, og siden oppdateres av seg selv. Større endringer, som en ny seksjon, koster 450 kr per endring.",
  "Recibes un enlace a un formulario sencillo. Ahí cambias textos, horarios, precios y fotos, y la página se actualiza sola. Los cambios mayores, como una sección nueva, cuestan 450 kr cada uno."),
"lp.faq.q5": ("What about the domain?", "Hva med domene?", "¿Y el dominio?"),
"lp.faq.a5": (
  "The page gets a free address, like yourbusiness.dsnorge.com. If you want your own domain, like yourbusiness.no, you register it in your name and we connect it. Your own domain is not included in the price.",
  "Siden får en gratis adresse, som dinbedrift.dsnorge.com. Vil du ha eget domene, som dinbedrift.no, registrerer du det i ditt navn, og vi kobler det til. Eget domene er ikke inkludert i prisen.",
  "La página recibe una dirección gratis, como tuempresa.dsnorge.com. Si quieres un dominio propio, como tuempresa.no, lo registras a tu nombre y lo conectamos. El dominio propio no está incluido en el precio."),
"lp.faq.q6": ("How do I pay?", "Hvordan betaler jeg?", "¿Cómo pago?"),
"lp.faq.a6": (
  "By card, automatically every month. You get the receipt by email. The first charge only happens when the page is published.",
  "Med kort, automatisk hver måned. Du får kvittering på e-post. Første trekk skjer først når siden publiseres.",
  "Con tarjeta, de forma automática cada mes. Recibes el recibo por correo. El primer cobro solo se hace cuando la página se publica."),
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
"lp.rodape.vilkar": ("Subscription terms", "Abonnementsvilkår", "Condiciones de la suscripción"),

# Página de pedido
"lp.best.eyebrow": ("Online order", "Bestilling på nett", "Pedido online"),
"lp.best.titulo": ("Order your landing page", "Bestill landingssiden din", "Pide tu landing page"),
"lp.best.lead": (
  "It takes about 5 minutes. At the end of the form you add your card. The first charge only happens when the page is published.",
  "Det tar rundt 5 minutter. Til slutt i skjemaet legger du inn kortet. Første trekk skjer først når siden er publisert.",
  "Lleva unos 5 minutos. Al final del formulario registras tu tarjeta. El primer cobro solo se hace cuando la página está publicada."),
"lp.best.resumo": ("Summary of terms", "Kort om vilkårene", "Resumen de condiciones"),
"lp.best.c1": ("<strong>Price:</strong> 399 kr/month, total price", "<strong>Pris:</strong> 399 kr/mnd, totalpris", "<strong>Precio:</strong> 399 kr/mes, precio final"),
# Formulário de pedido
"lp.form.modelo": ("Choose the model *", "Velg modell *", "Elige el modelo *"),
"lp.form.empresa": ("Business name *", "Bedriftsnavn *", "Nombre de la empresa *"),
"lp.form.orgnr": ("Organisation number (9 digits) *", "Org.nr. (9 siffer) *", "Número de organización (9 dígitos) *"),
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
  "You will receive a confirmation by email. As soon as the draft is ready, we send you the link to review and approve it.",
  "Du får en bekreftelse på e-post. Så snart utkastet er klart, sender vi deg lenken slik at du kan se og godkjenne det.",
  "Recibirás una confirmación por correo. En cuanto el borrador esté listo, te enviamos el enlace para verlo y aprobarlo."),
"lp.takk.cobranca": (
  "The first charge of 399 kr only happens when the page is published.",
  "Første trekk på 399 kr skjer først når siden publiseres.",
  "El primer cobro de 399 kr solo se hace cuando la página se publica."),
"lp.takk.voltar": ("Back to the home page", "Tilbake til forsiden", "Volver a la página de inicio"),
}
