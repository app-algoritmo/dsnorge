# -*- coding: utf-8 -*-
"""Tabela de tradução — parte B. Ver tools/traduzir.py."""

T = {
"qual.aviso.corpo": (
  "Digital Solutions is <strong>not a certified company</strong>. None of the standards cited on this page has been the object of a certification audit by an accredited body. What exists is declared adherence: the processes were designed along the structure of the standards, the evidence is generated and kept, and the site repository is public so that any technical claim made here can be verified.",
  "Digital Solutions er <strong>ikke et sertifisert selskap</strong>. Ingen av standardene som nevnes på denne siden har vært gjenstand for sertifiseringsrevisjon av et akkreditert organ. Det som finnes er erklært etterlevelse: prosessene er utformet etter standardenes struktur, dokumentasjonen genereres og bevares, og nettstedets kodelager er offentlig slik at enhver teknisk påstand her kan etterprøves.",
  "Digital Solutions <strong>no es una empresa certificada</strong>. Ninguna de las normas citadas en esta página ha sido objeto de auditoría de certificación por organismo acreditado. Lo que existe es adherencia declarada: los procesos fueron diseñados según la estructura de las normas, las evidencias se generan y se conservan, y el repositorio del sitio es público para que cualquier afirmación técnica aquí hecha pueda verificarse."),
"qual.aviso.corpo2": (
  "Where compliance is verifiable with a public tool — accessibility, security headers, absence of third-party requests — the result can be reproduced by anyone who wants to check.",
  "Der samsvar kan etterprøves med et offentlig verktøy — tilgjengelighet, sikkerhetshoder, fravær av tredjepartsforespørsler — kan resultatet gjenskapes av den som ønsker å kontrollere det.",
  "Donde la conformidad es verificable con herramienta pública — accesibilidad, cabeceras de seguridad, ausencia de peticiones a terceros — el resultado puede reproducirlo quien quiera comprobarlo."),
"qual.aviso.titulo": ("Scope statement", "Erklæring om omfang", "Declaración de alcance"),
"qual.eyebrow": ("Compliance", "Samsvar", "Conformidad"),
"qual.g1": (
  "Quality management. Clause 7.5 — documented information — is met in practice: header, footer, metadata and document code exist in a single place, the published pages are generated from it, and publication is automatically rejected if the root diverges from the source. Version control replaces individual discipline.",
  "Kvalitetsstyring. Punkt 7.5 — dokumentert informasjon — er oppfylt i praksis: topptekst, bunntekst, metadata og dokumentkode finnes ett sted, de publiserte sidene genereres derfra, og publisering avvises automatisk dersom roten avviker fra kilden. Versjonskontroll erstatter individuell disiplin.",
  "Gestión de la calidad. La cláusula 7.5 — información documentada — se cumple en la práctica: encabezado, pie, metadatos y código de documento existen en un único lugar, las páginas publicadas se generan a partir de él, y la publicación se rechaza automáticamente si la raíz diverge de la fuente. El control de versiones sustituye a la disciplina individual."),
"qual.g2": (
  "Information security. The applicable controls cover access management, change logging, segregation between staging and production, backups at a frequency declared in the contract, and incident response with a notification deadline.",
  "Informasjonssikkerhet. Kontrollene omfatter tilgangsstyring, endringslogg, atskillelse mellom testmiljø og produksjon, sikkerhetskopiering med frekvens oppgitt i kontrakten, og hendelseshåndtering med varslingsfrist.",
  "Seguridad de la información. Se aplican los controles de gestión de acceso, registro de cambios, segregación entre entorno de homologación y producción, copia de seguridad con periodicidad declarada en contrato y respuesta a incidentes con plazo de notificación."),
"qual.g3": (
  "Privacy information management, as an extension of 27001. It guides the record of processing operations, the legal basis of each one and the retention periods declared in the Privacy Policy.",
  "Styring av personverninformasjon, som en utvidelse av 27001. Den styrer protokollen over behandlingsaktiviteter, det rettslige grunnlaget for hver av dem og lagringstidene som er oppgitt i personvernerklæringen.",
  "Gestión de la privacidad de la información, como extensión de la 27001. Orienta el registro de las operaciones de tratamiento, la base legal de cada una y los plazos de conservación declarados en la Política de Privacidad."),
"qual.g4": (
  "Software life cycle processes. It defines the phases of each bespoke project: requirements, architecture, construction, verification, transition and maintenance — each with a named deliverable and acceptance criterion.",
  "Prosesser i programvarens livsløp. Den definerer fasene i hvert skreddersydd prosjekt: kravfangst, arkitektur, utvikling, verifisering, overgang og vedlikehold — hver med navngitt leveranse og akseptkriterium.",
  "Procesos del ciclo de vida del software. Define las fases de cada proyecto a medida: levantamiento de requisitos, arquitectura, construcción, verificación, transición y mantenimiento — cada una con entregable y criterio de aceptación nombrados."),
"qual.g5": (
  "Software product quality model. It is the list of characteristics used in the acceptance criteria: functional suitability, performance, compatibility, usability, reliability, security, maintainability and portability.",
  "Kvalitetsmodell for programvareprodukt. Den utgjør listen over egenskaper som brukes i akseptkriteriene: funksjonell dekning, ytelse, kompatibilitet, brukervennlighet, pålitelighet, sikkerhet, vedlikeholdbarhet og portabilitet.",
  "Modelo de calidad de producto de software. Es la lista de características usada en los criterios de aceptación: adecuación funcional, rendimiento, compatibilidad, usabilidad, fiabilidad, seguridad, mantenibilidad y portabilidad."),
"qual.g6": (
  "Risk management. Every project has a risk register with likelihood, impact, treatment and a named owner, reviewed at the contractual milestones.",
  "Risikostyring. Hvert prosjekt har et risikoregister med sannsynlighet, konsekvens, tiltak og navngitt ansvarlig, gjennomgått ved de kontraktsfestede milepælene.",
  "Gestión de riesgos. Cada proyecto tiene registro de riesgos con probabilidad, impacto, tratamiento y responsable nominal, revisado en los hitos contractuales."),
"qual.gestao.eyebrow": ("Management system", "Styringssystem", "Sistema de gestión"),
"qual.gestao.titulo": (
  "Management and process standards",
  "Standarder for styring og prosess",
  "Normas de gestión y de proceso"),
"qual.i1": (
  "Within 2 business days from receipt of the message through the form or by email.",
  "Innen 2 virkedager fra meldingen er mottatt via skjemaet eller på e-post.",
  "Hasta 2 días hábiles desde la recepción del mensaje por el formulario o por correo."),
"qual.i1.t": ("First response time", "Frist for første svar", "Plazo de la primera respuesta"),
"qual.i2": (
  "Target of 90% of contractual milestones delivered on the agreed date. A foreseen deviation is reported before the date, not after.",
  "Mål om at 90 % av de kontraktsfestede milepælene leveres på avtalt dato. Et forutsett avvik meldes før datoen, ikke etter.",
  "Objetivo del 90% de los hitos contractuales entregados en la fecha acordada. La desviación prevista se comunica antes de la fecha, no después."),
"qual.i2.t": ("On-milestone deliveries", "Leveranser innen milepæl", "Entregas dentro del hito"),
"qual.i3": (
  "A defect that prevents use of the platform in production: diagnosis within 4 business hours and a fix or workaround within 1 business day.",
  "En feil som hindrer bruk av plattformen i produksjon: diagnose innen 4 arbeidstimer og retting eller omgåelse innen 1 virkedag.",
  "Defecto que impide el uso de la plataforma en producción: diagnóstico en hasta 4 horas hábiles y corrección o solución alternativa en hasta 1 día hábil."),
"qual.i3.t": ("Critical defect fix", "Retting av kritisk feil", "Corrección de defecto crítico"),
"qual.i4": (
  "100% logged, answered in writing and closed with the cause identified and the corrective action stated.",
  "100 % registrert, besvart skriftlig og avsluttet med årsaken identifisert og det korrigerende tiltaket oppgitt.",
  "100% registradas, respondidas por escrito y cerradas con la causa identificada y la acción correctiva declarada."),
"qual.i4.t": ("Complaints handled", "Behandlede klager", "Reclamaciones tratadas"),
"qual.ind.eyebrow": ("Indicators", "Indikatorer", "Indicadores"),
"qual.ind.lead": (
  "Indicators without a declared target are decoration. These are the four Digital Solutions tracks, with the target assumed for each.",
  "Indikatorer uten oppgitt mål er pynt. Dette er de fire Digital Solutions følger, med målet som er satt for hver av dem.",
  "Los indicadores sin meta declarada son decoración. Estos son los cuatro que Digital Solutions sigue, con el objetivo asumido en cada uno."),
"qual.ind.titulo": ("What we measure", "Hva vi måler", "Lo que medimos"),
"qual.l1": (
  "Regulation (EU) 2016/679 — GDPR. Prior and granular consent, rights of access, rectification, erasure, portability and objection, and breach notification within the regulatory deadline.",
  "Forordning (EU) 2016/679 — GDPR. Forhåndssamtykke på detaljert nivå, rett til innsyn, retting, sletting, dataportabilitet og innsigelse, samt avviksvarsling innen fristen.",
  "Reglamento (UE) 2016/679 — GDPR. Consentimiento previo y granular, derechos de acceso, rectificación, supresión, portabilidad y oposición, y notificación de violación en el plazo reglamentario."),
"qual.l1.t": ("European Union and EEA", "EU og EØS", "Unión Europea y EEE"),
"qual.l2": (
  "Personopplysningsloven, which incorporates the GDPR into Norwegian law, with Datatilsynet as the supervisory authority.",
  "Personopplysningsloven, som gjennomfører GDPR i norsk rett, med Datatilsynet som tilsynsmyndighet.",
  "Personopplysningsloven, que incorpora el GDPR al derecho noruego, con Datatilsynet como autoridad de control."),
"qual.l2.t": ("Norway", "Norge", "Noruega"),
"qual.l3": (
  "Law 13.709/2018 — LGPD. It applies to Brazilian contracts and to data subjects located in Brazil, with ANPD as the authority.",
  "Lov 13.709/2018 — LGPD. Gjelder brasilianske kontrakter og registrerte som befinner seg i Brasil, med ANPD som myndighet.",
  "Ley 13.709/2018 — LGPD. Se aplica a los contratos brasileños y a los titulares situados en Brasil, con la ANPD como autoridad."),
"qual.l3.t": ("Brazil", "Brasil", "Brasil"),
"qual.l4": (
  "When data crosses a border between projects, the basis is the applicable adequacy decision or standard contractual clauses, stated in the data processing agreement signed with each client.",
  "Når data krysser en landegrense mellom prosjekter, er grunnlaget den gjeldende tilstrekkelighetsbeslutningen eller standard personvernbestemmelser, angitt i databehandleravtalen med hver kunde.",
  "Cuando los datos cruzan fronteras entre proyectos, la base es la decisión de adecuación aplicable o las cláusulas contractuales tipo, indicadas en el contrato de tratamiento firmado con cada cliente."),
"qual.l4.t": ("International transfer", "Overføring til utlandet", "Transferencia internacional"),
"qual.lead": (
  "This page declares the international standards that guide the development, operation and documentation of Digital Solutions. It also declares what is not yet audited by a third party — because a compliance statement is only worth something when it says both things.",
  "Denne siden erklærer de internasjonale standardene som styrer utvikling, drift og dokumentasjon i Digital Solutions. Den erklærer også hva som ennå ikke er revidert av tredjepart — for en samsvarserklæring er bare verdt noe når den sier begge deler.",
  "Esta página declara las normas internacionales que orientan el desarrollo, la operación y la documentación de Digital Solutions. También declara lo que aún no está auditado por un tercero — porque una declaración de conformidad solo vale cuando dice las dos cosas."),
"qual.leg.cta": ("Read the Privacy Policy", "Les personvernerklæringen", "Leer la Política de Privacidad"),
"qual.leg.eyebrow": ("Legal basis", "Rettslig grunnlag", "Base legal"),
"qual.leg.lead": (
  "Digital Solutions operates from Norway and serves clients in the European Union and in Brazil. The three regimes apply simultaneously, and the most restrictive prevails in each situation.",
  "Digital Solutions opererer fra Norge og betjener kunder i EU og i Brasil. De tre regelverkene gjelder samtidig, og det strengeste går foran i hver enkelt situasjon.",
  "Digital Solutions opera desde Noruega y atiende a clientes en la Unión Europea y en Brasil. Los tres regímenes se aplican simultáneamente, y el más restrictivo prevalece en cada situación."),
"qual.leg.titulo": ("Applicable data legislation", "Gjeldende personvernlovgivning", "Legislación de datos aplicable"),
"qual.rec.1": (
  "Every complaint receives a reference number and an entry date, both communicated to the complainant.",
  "Hver klage får et referansenummer og en mottaksdato, som begge meddeles klageren.",
  "Toda reclamación recibe número de referencia y fecha de entrada, comunicados a quien reclama."),
"qual.rec.1.t": ("Logging", "Registrering", "Registro"),
"qual.rec.2": (
  "Identification of the cause, not only of the symptom. If the cause is ours, that is stated in writing.",
  "Identifisering av årsaken, ikke bare symptomet. Er årsaken vår, sies det skriftlig.",
  "Identificación de la causa, no solo del síntoma. Si la causa es nuestra, se dice por escrito."),
"qual.rec.2.t": ("Analysis", "Analyse", "Análisis"),
"qual.rec.3": (
  "Corrective action with a named owner and a deadline, plus verification that the action worked.",
  "Korrigerende tiltak med navngitt ansvarlig og frist, samt verifisering av at tiltaket virket.",
  "Acción correctiva con responsable nominal y plazo, y la verificación de que la acción funcionó."),
"qual.rec.3.t": ("Action", "Tiltak", "Acción"),
"qual.rec.4": (
  "A written answer to the complainant. The record is kept for the period declared in the Privacy Policy.",
  "Skriftlig svar til klageren. Registreringen oppbevares i perioden som er oppgitt i personvernerklæringen.",
  "Respuesta escrita al reclamante. El registro se conserva durante el plazo declarado en la Política de Privacidad."),
"qual.rec.4.t": ("Closing", "Avslutning", "Cierre"),
"qual.rec.cta": ("Open the form", "Åpne skjemaet", "Abrir el formulario"),
"qual.rec.eyebrow": ("Complaints", "Klager", "Reclamaciones"),
"qual.rec.lead": (
  "Complaints about ongoing or completed work come through the contact form or by email, with the word «complaint» at the start of the message.",
  "Klager på pågående eller fullført arbeid sendes via kontaktskjemaet eller på e-post, med ordet «klage» først i meldingen.",
  "Las reclamaciones sobre trabajos en curso o concluidos entran por el formulario de contacto o por correo, con la palabra «reclamación» al inicio del mensaje."),
"qual.rec.titulo": (
  "How to complain, and what happens next",
  "Slik klager du, og hva som skjer etterpå",
  "Cómo reclamar, y qué ocurre después"),
"qual.t1": (
  "WCAG 2.2 level AA, equivalent to ISO/IEC 40500, and EN 301 549 for the European market. Minimum contrast of 4.5:1 verified including on the coloured labels of the disc, full keyboard navigation, always-visible focus, semantic structure with navigation landmarks, a skip link and respect for <span class=\"mono\">prefers-reduced-motion</span>. ISO 9241-171 guides the interactive components.",
  "WCAG 2.2 nivå AA, tilsvarende ISO/IEC 40500, og EN 301 549 for det europeiske markedet. Minimumskontrast på 4,5:1 er kontrollert også på de fargede etikettene i skiven, full tastaturnavigasjon, alltid synlig fokus, semantisk struktur med navigasjonslandemerker, hopplenke og støtte for <span class=\"mono\">prefers-reduced-motion</span>. ISO 9241-171 styrer de interaktive komponentene.",
  "WCAG 2.2 nivel AA, equivalente a la ISO/IEC 40500, y EN 301 549 para el mercado europeo. Contraste mínimo de 4.5:1 verificado incluso en las etiquetas de color del disco, navegación completa por teclado, foco siempre visible, estructura semántica con puntos de referencia, enlace de salto y respeto a <span class=\"mono\">prefers-reduced-motion</span>. La ISO 9241-171 orienta los componentes interactivos."),
"qual.t1.t": ("Accessibility", "Tilgjengelighet", "Accesibilidad"),
"qual.t2": (
  "Language codes per ISO 639-1 and tags per BCP 47 (pt-BR, en, nb-NO, es), declared in <span class=\"mono\">hreflang</span> and in the document's <span class=\"mono\">lang</span> attribute. Portuguese is the master language; a key missing from a translation falls back to English and never breaks the page.",
  "Språkkoder etter ISO 639-1 og etiketter etter BCP 47 (pt-BR, en, nb-NO, es), oppgitt i <span class=\"mono\">hreflang</span> og i dokumentets <span class=\"mono\">lang</span>-attributt. Portugisisk er kildespråket; en nøkkel som mangler i en oversettelse faller tilbake til engelsk og bryter aldri siden.",
  "Códigos de idioma según ISO 639-1 y etiquetas según BCP 47 (pt-BR, en, nb-NO, es), declaradas en <span class=\"mono\">hreflang</span> y en el atributo <span class=\"mono\">lang</span> del documento. El portugués es el idioma maestro; una clave ausente en una traducción recurre al inglés y nunca rompe la página."),
"qual.t2.t": ("Languages", "Språk", "Idiomas"),
"qual.t3": (
  "UTF-8 per ISO/IEC 10646, dates in ISO 8601, countries in ISO 3166-1 alpha-2 and currencies in ISO 4217 (EUR, NOK, BRL) across the site, the contracts and the platform exports.",
  "UTF-8 etter ISO/IEC 10646, datoer i ISO 8601, land i ISO 3166-1 alfa-2 og valuta i ISO 4217 (EUR, NOK, BRL) på hele nettstedet, i kontraktene og i eksportene fra plattformene.",
  "UTF-8 según ISO/IEC 10646, fechas en ISO 8601, países en ISO 3166-1 alfa-2 y monedas en ISO 4217 (EUR, NOK, BRL) en todo el sitio, en los contratos y en las exportaciones de las plataformas."),
"qual.t3.t": ("Encoding and formats", "Tegnsett og formater", "Codificación y formatos"),
"qual.t4": (
  "Fonts, styles and scripts are served by our own domain. No request leaves the page when it loads — no CDN, no remote font, no tracker loaded by default. It is the only way for the cookie notice to be true.",
  "Skrifter, stilark og skript leveres fra vårt eget domene. Ingen forespørsel går ut når siden lastes — ingen CDN, ingen ekstern skrift, ingen sporer lastet som standard. Det er den eneste måten informasjonskapselvarselet kan være sant på.",
  "Fuentes, estilos y scripts se sirven desde el propio dominio. Ninguna petición sale al cargar la página — no hay CDN, no hay fuente remota, no hay rastreador cargado por defecto. Es la única forma de que el aviso de cookies sea verdadero."),
"qual.t4.t": ("Zero third parties at runtime", "Null tredjeparter i drift", "Cero terceros en ejecución"),
"qual.t5": (
  "Channel declared at <span class=\"mono\">/.well-known/security.txt</span> per RFC 9116. Good-faith reports about security flaws are answered and never met with retaliation.",
  "Kanal oppgitt i <span class=\"mono\">/.well-known/security.txt</span> etter RFC 9116. Meldinger i god tro om sikkerhetshull besvares og møtes aldri med represalier.",
  "Canal declarado en <span class=\"mono\">/.well-known/security.txt</span> conforme a la RFC 9116. Las comunicaciones de buena fe sobre fallas de seguridad se responden y no generan represalia."),
"qual.t5.t": ("Vulnerability disclosure", "Varsling om sårbarhet", "Divulgación de vulnerabilidad"),
"qual.t6": (
  "Applied inside the product, not to the site: it is the human vibration exposure standard behind the risk index calculation of SALA · Safe-Load Analytics, alongside Arbeidsmiljøloven § 4-4.",
  "Anvendt i produktet, ikke på nettstedet: det er standarden for menneskelig vibrasjonseksponering som ligger bak beregningen av risikoindeksen i SALA · Safe-Load Analytics, sammen med arbeidsmiljøloven § 4-4.",
  "Aplicada dentro del producto, no al sitio: es la norma de exposición humana a vibración que sustenta el cálculo del índice de riesgo de SALA · Safe-Load Analytics, junto al Arbeidsmiljøloven § 4-4."),
"qual.tec.eyebrow": ("Product", "Produkt", "Producto"),
"qual.tec.titulo": (
  "Technical standards applied to what is published",
  "Tekniske standarder anvendt på det som publiseres",
  "Normas técnicas aplicadas a lo que se publica"),
"qual.titulo": (
  "What we follow, and how far.",
  "Hva vi følger, og hvor langt.",
  "Lo que seguimos, y hasta dónde."),
"serv.contrat.eyebrow": ("Contracting", "Avtaleform", "Contratación"),
"serv.contrat.titulo": ("Available formats", "Tilgjengelige former", "Formatos disponibles"),
"serv.cta": ("Request a proposal", "Be om tilbud", "Pedir propuesta"),
"serv.eyebrow": (
  "Catalogue · 5 fronts · 26 items",
  "Katalog · 5 arbeidsområder · 26 punkter",
  "Catálogo · 5 frentes · 26 ítems"),
"serv.f1.d": (
  "Scope, deliverables and price defined before the start. Payment against delivery milestones.",
  "Omfang, leveranser og pris fastsatt før oppstart. Betaling mot leveransemilepæler.",
  "Alcance, entregables y precio definidos antes del inicio. Pago por hitos de entrega."),
"serv.f1.t": ("Fixed-scope project", "Fastpris-prosjekt", "Proyecto cerrado"),
"serv.f2.d": (
  "Platforms and dashboards with hosting, evolutionary maintenance and support included.",
  "Plattformer og dashbord med drift, videreutvikling og støtte inkludert.",
  "Plataformas y paneles con alojamiento, mantenimiento evolutivo y soporte incluidos."),
"serv.f2.t": ("Monthly subscription", "Månedlig abonnement", "Suscripción mensual"),
"serv.f3.d": (
  "MIMBAI and CRM. The number of active licences is reviewed monthly, up or down.",
  "MIMBAI og CRM. Antall aktive lisenser gjennomgås månedlig, opp eller ned.",
  "MIMBAI y CRM. El número de licencias activas se revisa mensualmente, al alza o a la baja."),
"serv.f3.t": ("Per-user subscription", "Abonnement per bruker", "Suscripción por usuario"),
"serv.f4.d": (
  "Oslo Meet. Starter, Business and Partner plans, priced with MVA already included.",
  "Oslo Meet. Planene Starter, Business og Partner, med MVA allerede inkludert i prisen.",
  "Oslo Meet. Planes Starter, Business y Partner, con precio que ya incluye MVA."),
"serv.f4.t": ("Annual subscription", "Årlig abonnement", "Suscripción anual"),
"serv.f5.d": (
  "An entry project to configure and migrate data, followed by the recurring operation.",
  "Et oppstartsprosjekt for oppsett og datamigrering, etterfulgt av løpende drift.",
  "Un proyecto de entrada para configurar y migrar datos, seguido de la recurrencia de operación."),
"serv.f5.t": ("Onboarding + subscription", "Etablering + abonnement", "Implantación + suscripción"),
"serv.f6.d": (
  "EUR or NOK for European contracts, BRL for Brazilian ones. Reference rate fixed at signature (ISO 4217).",
  "EUR eller NOK for europeiske kontrakter, BRL for brasilianske. Referansekurs låses ved signering (ISO 4217).",
  "EUR o NOK para contratos europeos, BRL para contratos brasileños. Tasa de referencia fijada en la firma (ISO 4217)."),
"serv.f6.t": ("Currency", "Valuta", "Moneda"),
"serv.lead": (
  "The disc organises everything Digital Solutions delivers. Each slice is a line of work; the outer ring shows whether the item is a licensed product or built per project. Click to open the list and, in each item, see what is included and how it is contracted.",
  "Skiven organiserer alt Digital Solutions leverer. Hver sektor er et arbeidsområde; den ytre ringen viser om punktet er et lisensiert produkt eller bygget per prosjekt. Klikk for å åpne listen og se, for hvert punkt, hva som inngår og hvordan det avtales.",
  "El disco organiza todo lo que entrega Digital Solutions. Cada porción es un frente de trabajo; el aro externo indica si el ítem es producto licenciado o construido por proyecto. Haga clic para abrir la lista y, en cada ítem, ver qué incluye y en qué formato se contrata."),
"serv.titulo": ("Platforms and services", "Plattformer og tjenester", "Plataformas y servicios"),
"sobre.como.eyebrow": ("Positioning", "Posisjonering", "Posicionamiento"),
"sobre.como.lead": (
  "The catalogue splits into two families because the commitment differs in each. It is worth knowing which one you are contracting.",
  "Katalogen deles i to familier fordi forpliktelsen er ulik i hver av dem. Det er verdt å vite hvilken du inngår avtale om.",
  "El catálogo se divide en dos familias porque el compromiso es distinto en cada una. Vale la pena saber cuál está contratando."),
"sobre.como.titulo": ("Two ways to contract", "To måter å inngå avtale på", "Dos maneras de contratar"),
"sobre.cta.b1": ("See the catalogue", "Se katalogen", "Ver el catálogo"),
"sobre.cta.b2": ("Talk to Digital Solutions", "Kontakt Digital Solutions", "Hablar con Digital Solutions"),
"sobre.cta.eyebrow": ("Next step", "Neste steg", "Próximo paso"),
"sobre.cta.lead": (
  "Each of the twenty-six items states what it includes and how it is contracted. If what you need is there, the conversation already starts with a scope. If it is not, describe the problem anyway.",
  "Hvert av de tjueseks punktene oppgir hva det omfatter og hvordan det avtales. Finner du det du trenger, starter samtalen allerede med et omfang. Gjør du ikke det, beskriv problemet likevel.",
  "Cada uno de los veintiséis ítems declara qué incluye y en qué formato se contrata. Si lo que necesita está ahí, el contacto ya empieza con alcance. Si no está, describa el problema igualmente."),
"sobre.cta.titulo": (
  "The catalogue answers before the meeting",
  "Katalogen svarer før møtet",
  "El catálogo responde antes de la reunión"),
"sobre.d1": ("Legal name", "Foretaksnavn", "Razón social"),
"sobre.d2": ("Registration", "Registrering", "Registro"),
"sobre.d2.v": (
  "org.nr 996 041 468 — Brønnøysundregistrene, Norway",
  "org.nr 996 041 468 — Brønnøysundregistrene, Norge",
  "org.nr 996 041 468 — Brønnøysundregistrene, Noruega"),
"sobre.d3": ("Domain", "Domene", "Dominio"),
"sobre.d7": ("Address", "Adresse", "Dirección"),
"sobre.d4": ("Contact", "Kontakt", "Contacto"),
"sobre.d5": ("Working languages", "Arbeidsspråk", "Idiomas de trabajo"),
"sobre.d6": ("Markets served", "Markeder", "Mercados atendidos"),
"sobre.d6.v": (
  "Norway, the Nordics, the European Union, Brazil and Latin America",
  "Norge, Norden, EU, Brasil og Latin-Amerika",
  "Noruega, Nórdicos, Unión Europea, Brasil y América Latina"),
"sobre.dados.eyebrow": ("Identification", "Identifikasjon", "Identificación"),
"sobre.dados.titulo": ("Company details", "Selskapsopplysninger", "Datos de la empresa"),
"sobre.eyebrow": ("About", "Om oss", "Sobre"),
"sobre.lead": (
  "Digital Solutions is a Norwegian technology company. It builds its own platforms, licensed by subscription, and bespoke systems for companies that already know which problem they want to solve and have not found the software that solves it.",
  "Digital Solutions er et norsk teknologiselskap. Vi bygger egne plattformer, lisensiert gjennom abonnement, og skreddersydde systemer for selskaper som allerede vet hvilket problem de vil løse og ikke har funnet programvaren som løser det.",
  "Digital Solutions es una empresa noruega de tecnología. Construye plataformas propias, licenciadas por suscripción, y sistemas a medida para empresas que ya saben qué problema quieren resolver y no han encontrado el software que lo resuelve."),
"sobre.m.corpo": (
  "CRM, extranet, automations, algorithms and data dashboards are built from your process. Ownership of what is developed specifically for the contract is defined in the contract itself, along with the documentation and the knowledge transfer.",
  "CRM, ekstranett, automatisering, algoritmer og datadashbord bygges ut fra din prosess. Eierskapet til det som utvikles spesifikt for kontrakten fastsettes i selve kontrakten, sammen med dokumentasjonen og kunnskapsoverføringen.",
  "CRM, extranet, automatizaciones, algoritmos y paneles de datos se construyen a partir de su proceso. La titularidad de lo desarrollado específicamente para el contrato se define en el propio contrato, junto con la documentación y la transferencia de conocimiento."),
"sobre.m.titulo": ("Built for one case", "Bygget for ett tilfelle", "Construido para un caso"),
"sobre.p.corpo": (
  "MIMBAI, Oslo Meet and SALA are our products. You subscribe, you receive the improvements that enter the roadmap and the support your plan provides. The code stays with Digital Solutions; your data stays yours, exportable in an open format at any time.",
  "MIMBAI, Oslo Meet og SALA er våre produkter. Du abonnerer, får forbedringene som kommer inn i veikartet og støtten planen gir. Koden forblir hos Digital Solutions; dine data forblir dine, eksporterbare i åpent format når som helst.",
  "MIMBAI, Oslo Meet y SALA son productos nuestros. Usted se suscribe, recibe las evoluciones que entran en el roadmap y el soporte previsto en el plan. El código permanece con Digital Solutions; sus datos siguen siendo suyos, exportables en formato abierto en cualquier momento."),
"sobre.p.titulo": ("Licensed product", "Lisensiert produkt", "Producto licenciado"),
"sobre.r1": (
  "Operations, governance and business intelligence. It defines the calculation rules of the financial dashboards; Digital Solutions builds them. <a href=\"https://barros.no\" target=\"_blank\" rel=\"noopener\">barros.no</a>",
  "Drift, styring og forretningsanalyse. De fastsetter beregningsreglene for de finansielle dashbordene; Digital Solutions bygger dem. <a href=\"https://barros.no\" target=\"_blank\" rel=\"noopener\">barros.no</a>",
  "Operaciones, gobernanza e inteligencia de negocios. Define las reglas de cálculo de los paneles financieros; Digital Solutions los construye. <a href=\"https://barros.no\" target=\"_blank\" rel=\"noopener\">barros.no</a>"),
"sobre.r2": (
  "Regulatory affairs and certification. It provides the technical curation of MIMBAI's RegTech module.",
  "Regulatoriske forhold og sertifisering. De står for den faglige kvalitetssikringen av RegTech-modulen i MIMBAI.",
  "Asuntos regulatorios y certificación. Realiza la curaduría técnica del módulo RegTech de MIMBAI."),
"sobre.r3": (
  "MIMBAI, Oslo Meet and SALA each have their own site and their own product cycle. The catalogue on this page is the commercial door to all three.",
  "MIMBAI, Oslo Meet og SALA har hvert sitt nettsted og sin egen produktsyklus. Katalogen på denne siden er den kommersielle inngangen til alle tre.",
  "MIMBAI, Oslo Meet y SALA tienen sitio propio y ciclo de producto propio. El catálogo de esta página es la puerta comercial de los tres."),
"sobre.r3.t": ("Platforms", "Plattformer", "Plataformas"),
"sobre.rede.eyebrow": ("Network", "Nettverk", "Red"),
"sobre.rede.lead": (
  "Some projects require a reading of the operation or a regulatory opinion, which are not the competence of a software house. In those cases execution is joint, and each catalogue item's record states who delivers what.",
  "Enkelte prosjekter krever forståelse av driften eller en regulatorisk vurdering, som ikke er et programvarehus' kompetanse. Da er gjennomføringen felles, og hvert punkt i katalogen oppgir hvem som leverer hva.",
  "Parte de los proyectos exige lectura de la operación o dictamen regulatorio, que no son competencia de una casa de software. En esos casos la ejecución es conjunta, y la ficha de cada ítem del catálogo indica quién entrega qué."),
"sobre.rede.titulo": ("Who we work with", "Hvem vi samarbeider med", "Con quién trabajamos"),
"sobre.titulo": (
  "A technology house, not an hours factory.",
  "Et teknologihus, ikke en timefabrikk.",
  "Una casa de tecnología, no una fábrica de horas."),
"term.eyebrow": ("Legal document", "Juridisk dokument", "Documento legal"),
"term.lead": (
  "These conditions apply to anyone visiting dsnorge.com. They do not replace the contract of each project or subscription, which prevails over this page in case of divergence.",
  "Disse vilkårene gjelder for alle som besøker dsnorge.com. De erstatter ikke kontrakten for det enkelte prosjekt eller abonnement, som går foran denne siden ved motstrid.",
  "Estas condiciones valen para quien accede a dsnorge.com. No sustituyen el contrato de cada proyecto o suscripción, que prevalece sobre esta página en caso de divergencia."),
"term.titulo": ("Terms of Use", "Bruksvilkår", "Términos de Uso"),
}
