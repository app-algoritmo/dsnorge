# -*- coding: utf-8 -*-
"""Tabela de tradução — parte C: landing page (src/pages/index.html).
Ordem de cada tupla: (en, no, es). Ver tools/traduzir.py."""

T = {
# Cabeçalho
"lp.nav.servicos": ("Services", "Tjenester", "Servicios"),
"lp.nav.preco": ("Price", "Pris", "Precio"),
"lp.nav.como": ("How we work", "Slik jobber vi", "Cómo trabajamos"),
"lp.nav.faq": ("Questions", "Spørsmål", "Preguntas"),
"lp.nav.sms": ("Send SMS", "Send SMS", "Enviar SMS"),

# Abertura
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
"lp.hero.cta1": ("Get your landing page", "Få din landingsside", "Quiero mi landing page"),
"lp.hero.cta2": ("See what is included", "Se hva som er inkludert", "Ver qué incluye"),

# Oferta
"lp.selo": ("Best choice", "Beste valg", "Mejor opción"),
"lp.oferta.titulo": (
  "We build your landing page for free",
  "Vi lager landingssiden din gratis",
  "Creamos tu landing page gratis"),
"lp.oferta.mes": ("/month incl. VAT", "/mnd inkl. mva.", "/mes con IVA"),
"lp.oferta.cond": (
  "No setup cost. 12-month commitment.",
  "Ingen oppstartskostnad. 12 måneders bindingstid.",
  "Sin coste inicial. Permanencia de 12 meses."),
"lp.oferta.cta": ("Send SMS to 90 66 71 30", "Send SMS til 90 66 71 30", "Enviar SMS al 90 66 71 30"),

# Serviços
"lp.serv.titulo": ("What we can build for you", "Dette kan vi lage for deg", "Lo que podemos crear para ti"),
"lp.serv.lead": (
  "Start simple with a landing page. As the business grows, you can build on it.",
  "Start enkelt med en landingsside. Når bedriften vokser, kan du bygge videre.",
  "Empieza con una landing page. Cuando la empresa crezca, puedes ampliarla."),
"lp.serv.s1.t": ("Website", "Nettside", "Sitio web"),
"lp.serv.s1.d": (
  "For the business that wants to be found and look professional, with pages about services, the company and contact.",
  "For bedriften som vil bli funnet og fremstå profesjonelt, med flere sider om tjenester, bedriften og kontakt.",
  "Para la empresa que quiere ser encontrada y transmitir una imagen profesional, con páginas sobre servicios, la empresa y contacto."),
"lp.serv.sob": ("Price on request", "Pris etter avtale", "Precio a consultar"),
"lp.serv.s2.t": ("Landing page", "Landingsside", "Landing page"),
"lp.serv.s2.d": (
  "One page that says who you are, what you offer and how customers reach you. Perfect for getting started quickly.",
  "Én side som forteller hvem du er, hva du tilbyr og hvordan kunden når deg. Perfekt for å komme raskt i gang.",
  "Una página que dice quién eres, qué ofreces y cómo te encuentra el cliente. Ideal para empezar rápido."),
"lp.serv.s2.p": ("Free setup · 399 kr/month", "Gratis oppstart · 399 kr/mnd", "Inicio gratis · 399 kr/mes"),
"lp.serv.s3.t": ("Online shop", "Nettbutikk", "Tienda online"),
"lp.serv.s3.d": (
  "Sell your products online, with simple payment and an overview of orders.",
  "Selg varene dine på nett, med enkel betaling og oversikt over bestillinger.",
  "Vende tus productos por internet, con pago sencillo y control de los pedidos."),

# Incluso
"lp.inc.titulo": (
  "Everything you need to get online",
  "Alt du trenger for å komme på nett",
  "Todo lo que necesitas para estar en internet"),
"lp.inc.lead": (
  "The landing page is included in the monthly price. No hidden costs.",
  "Landingssiden er inkludert i månedsprisen. Ingen skjulte kostnader.",
  "La landing page está incluida en la cuota mensual. Sin costes ocultos."),
"lp.inc.i1": ("Design and setup of the page", "Design og oppsett av siden", "Diseño y configuración de la página"),
"lp.inc.i2": ("Works on mobile and tablet", "Tilpasset mobil og nettbrett", "Adaptada a móvil y tableta"),
"lp.inc.i3": ("Hosting and SSL certificate", "Webhotell og SSL-sertifikat", "Alojamiento y certificado SSL"),
"lp.inc.i4": ("Buttons for phone, SMS and email", "Knapper for telefon, SMS og e-post", "Botones de teléfono, SMS y correo"),
"lp.inc.i5": ("Links to Facebook and Instagram", "Lenker til Facebook og Instagram", "Enlaces a Facebook e Instagram"),
"lp.inc.i6": ("Small changes, up to 30 min/month", "Små endringer, inntil 30 min/mnd", "Pequeños cambios, hasta 30 min/mes"),
"lp.inc.i7": ("Your own .no domain", "Eget .no-domene", "Dominio .no propio"),

# Plano
"lp.preco.r1": ("<strong>Setup:</strong> 0 kr", "<strong>Oppstart:</strong> 0 kr", "<strong>Inicio:</strong> 0 kr"),
"lp.preco.r2": ("<strong>Commitment:</strong> 12 months", "<strong>Bindingstid:</strong> 12 måneder", "<strong>Permanencia:</strong> 12 meses"),
"lp.preco.r3": (
  "<strong>After that:</strong> month to month, one month’s notice",
  "<strong>Deretter:</strong> løpende, med én måneds oppsigelse",
  "<strong>Después:</strong> mes a mes, con un mes de preaviso"),
"lp.preco.r4": ("<strong>Own .no domain:</strong> included", "<strong>Eget .no-domene:</strong> inkludert", "<strong>Dominio .no propio:</strong> incluido"),
"lp.preco.r5": (
  "<strong>Delivery:</strong> 5 business days after the draft is approved",
  "<strong>Levering:</strong> 5 virkedager etter godkjent utkast",
  "<strong>Entrega:</strong> 5 días hábiles tras aprobar el borrador"),
"lp.preco.cta": ("Order a landing page", "Bestill landingsside", "Pedir landing page"),

# Como trabalhamos
"lp.como.titulo": ("How we work", "Slik jobber vi", "Cómo trabajamos"),
"lp.como.p1.t": ("Send us an SMS", "Send oss en SMS", "Envíanos un SMS"),
"lp.como.p1.d": (
  "Tell us briefly what your business does. We reply by SMS and email.",
  "Fortell kort hva bedriften gjør. Vi svarer deg på SMS og e-post.",
  "Cuéntanos brevemente a qué se dedica tu empresa. Respondemos por SMS y correo."),
"lp.como.p2.t": ("We make a draft", "Vi lager et utkast", "Hacemos un borrador"),
"lp.como.p2.d": (
  "You review the draft and approve it. The page is ready within 5 business days of approval.",
  "Du får se utkastet og godkjenner det. Siden er klar innen 5 virkedager etter godkjenning.",
  "Revisas el borrador y lo apruebas. La página está lista en 5 días hábiles tras la aprobación."),
"lp.como.p3.t": ("The page goes live", "Siden går live", "La página se publica"),
"lp.como.p3.d": (
  "The monthly price only starts once the page is published.",
  "Månedsprisen starter først når siden er publisert.",
  "La cuota mensual empieza solo cuando la página está publicada."),

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
  "Your logo if you have one, a few photos and a short description of the business. We help you with the texts.",
  "Logo hvis du har en, noen bilder og en kort beskrivelse av bedriften. Vi hjelper deg med tekstene.",
  "Tu logo si tienes uno, algunas fotos y una breve descripción de la empresa. Te ayudamos con los textos."),
"lp.faq.q4": ("What counts as a small change?", "Hva regnes som små endringer?", "¿Qué se considera un pequeño cambio?"),
"lp.faq.a4": (
  "For example new opening hours, new photos, prices or contact details. Up to 30 minutes per month is included.",
  "For eksempel nye åpningstider, nye bilder, priser eller kontaktinfo. Inntil 30 minutter per måned er inkludert.",
  "Por ejemplo, nuevo horario, fotos nuevas, precios o datos de contacto. Hasta 30 minutos al mes están incluidos."),
"lp.faq.q5": ("Can I get a bigger website later?", "Kan jeg få en større nettside senere?", "¿Puedo tener un sitio más grande después?"),
"lp.faq.a5": (
  "Yes. The landing page can grow into a full website or an online shop. You get a separate quote before we start.",
  "Ja. Landingssiden kan bygges ut til en full nettside eller nettbutikk. Du får et eget tilbud før vi starter.",
  "Sí. La landing page puede crecer hasta un sitio completo o una tienda online. Recibes un presupuesto aparte antes de empezar."),

# Contato
"lp.cta.titulo": ("Ready to get online?", "Klar for å komme på nett?", "¿Listo para estar en internet?"),
"lp.cta.lead": (
  "Send an SMS with your business name, and we reply by SMS and email.",
  "Send en SMS med navnet på bedriften din, så svarer vi på SMS og e-post.",
  "Envía un SMS con el nombre de tu empresa y respondemos por SMS y correo."),

# Rodapé
"lp.rodape.marca": ("Digital Løsninger · since 2010", "Digital Løsninger · siden 2010", "Digital Løsninger · desde 2010"),
"lp.rodape.empresa": ("About Digital Solutions", "Om Digital Solutions", "Sobre Digital Solutions"),
}
