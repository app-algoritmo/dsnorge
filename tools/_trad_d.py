# -*- coding: utf-8 -*-
"""Traduções dos documentos legais (privacidade, termos de uso, cookies).
Mestre em português (src/pages/*.html). Tuplas: (en, no, es).
DOC-DS-TOOL-007 · v1.0.0
"""

T = {
# ─── Cabeçalhos alterados ───────────────────────────────────
"priv.lead": (
  "This policy describes which personal data we collect on dsnorge.com, in Min side and on customer pages, for what purpose, for how long and what you can demand.",
  "Denne erklæringen beskriver hvilke personopplysninger vi samler inn på dsnorge.com, i Min side og på kundenes sider, hvorfor, hvor lenge og hva du kan kreve.",
  "Esta política describe qué datos personales recogemos en dsnorge.com, en Min side y en las páginas de los clientes, para qué, durante cuánto tiempo y qué puedes exigir."),
"term.lead": (
  "These terms apply to everyone who visits dsnorge.com and its subdomains. They do not replace the contract for each project or subscription, which takes precedence over this page in case of conflict.",
  "Disse vilkårene gjelder for alle som besøker dsnorge.com og underdomenene. De erstatter ikke kontrakten for det enkelte prosjekt eller abonnement, som går foran denne siden ved motstrid.",
  "Estas condiciones se aplican a quien visita dsnorge.com y sus subdominios. No sustituyen el contrato de cada proyecto o suscripción, que prevalece sobre esta página en caso de discrepancia."),

# ─── Política de privacidade ────────────────────────────────
"priv.c01": ("1. Who is responsible", "1. Hvem er ansvarlig", "1. Quién es el responsable"),
"priv.c02": (
  "The controller (<em>behandlingsansvarlig</em>) for data collected on dsnorge.com, minside.dsnorge.com and side.dsnorge.com is <strong>Digital Solutions</strong>, a company registered in Norway with org. no. 996 041 468. Contact for any matter concerning personal data: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "Behandlingsansvarlig for opplysninger som samles inn på dsnorge.com, minside.dsnorge.com og side.dsnorge.com er <strong>Digital Solutions</strong>, registrert i Norge med org.nr. 996 041 468. Kontakt om alt som gjelder personopplysninger: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "El responsable del tratamiento (<em>behandlingsansvarlig</em>) de los datos recogidos en dsnorge.com, minside.dsnorge.com y side.dsnorge.com es <strong>Digital Solutions</strong>, empresa registrada en Noruega con org. n.º 996 041 468. Contacto para cualquier asunto sobre datos personales: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>."),
"priv.c03": ("2. Applicable law", "2. Hvilket regelverk gjelder", "2. Legislación aplicable"),
"priv.c04": (
  "Processing follows the EU General Data Protection Regulation (GDPR, Regulation 2016/679), incorporated into Norwegian law through the <em>personopplysningsloven</em>, and, when the data subject is in Brazil, the Brazilian General Data Protection Law (Law 13.709/2018).",
  "Behandlingen følger EUs personvernforordning (GDPR, forordning 2016/679), som er gjort til norsk lov gjennom <em>personopplysningsloven</em>, og, når den registrerte er i Brasil, den brasilianske personvernloven (lov 13.709/2018).",
  "El tratamiento cumple el Reglamento General de Protección de Datos de la UE (RGPD, Reglamento 2016/679), incorporado al derecho noruego mediante la <em>personopplysningsloven</em>, y, cuando el interesado esté en Brasil, la Ley General de Protección de Datos (Ley 13.709/2018)."),
"priv.c05": ("3. What data is collected", "3. Hvilke opplysninger samles inn", "3. Qué datos se recogen"),
"priv.c06": ("Data", "Opplysning", "Dato"),
"priv.c07": ("Source", "Kilde", "Origen"),
"priv.c08": ("Purpose", "Formål", "Finalidad"),
"priv.c09": ("Legal basis", "Rettslig grunnlag", "Base jurídica"),
"priv.c10": (
  "Company, org. no., contact person, email, phone, company description, opening hours, social media links, logo and photos",
  "Bedrift, org.nr., kontaktperson, e-post, telefon, beskrivelse av bedriften, åpningstider, lenker til sosiale medier, logo og bilder",
  "Empresa, org. n.º, persona de contacto, e-mail, teléfono, descripción de la empresa, horario, enlaces a redes sociales, logo y fotos"),
"priv.c11": ("Landing page order form", "Bestillingsskjema for landingsside", "Formulario de pedido de landing page"),
"priv.c12": (
  "Register the order, create the Min side account and fill in the first version of the page",
  "Registrere bestillingen, opprette kontoen i Min side og fylle ut første versjon av siden",
  "Registrar el pedido, crear la cuenta en Min side y rellenar la primera versión de la página"),
"priv.c13": ("Performance of a contract (GDPR 6.1.b)", "Oppfyllelse av avtale (GDPR 6.1.b)", "Ejecución de un contrato (RGPD 6.1.b)"),
"priv.c14": ("Login email, texts, photos and choice of layout and colours", "E-post for innlogging, tekster, bilder og valg av oppsett og farger", "E-mail de acceso, textos, fotos y elección de diseño y colores"),
"priv.c15": ("Min side (minside.dsnorge.com)", "Min side (minside.dsnorge.com)", "Min side (minside.dsnorge.com)"),
"priv.c16": ("Build, store and publish the customer's page", "Lage, lagre og publisere kundens side", "Montar, guardar y publicar la página del cliente"),
"priv.c17": ("Performance of a contract (GDPR 6.1.b)", "Oppfyllelse av avtale (GDPR 6.1.b)", "Ejecución de un contrato (RGPD 6.1.b)"),
"priv.c18": ("Name, email, phone, billing address and card details", "Navn, e-post, telefon, fakturaadresse og kortopplysninger", "Nombre, e-mail, teléfono, dirección de facturación y datos de la tarjeta"),
"priv.c19": ("Stripe payment page", "Betalingssiden til Stripe", "Página de pago de Stripe"),
"priv.c20": ("Charge the monthly subscription and issue receipts", "Trekke månedlig abonnement og sende kvitteringer", "Cobrar la suscripción mensual y emitir recibos"),
"priv.c21": (
  "Performance of a contract (6.1.b) and legal accounting obligation (6.1.c)",
  "Oppfyllelse av avtale (6.1.b) og rettslig plikt etter bokføringsreglene (6.1.c)",
  "Ejecución de un contrato (6.1.b) y obligación legal contable (6.1.c)"),
"priv.c22": ("Name, email, phone, company and message", "Navn, e-post, telefon, bedrift og melding", "Nombre, e-mail, teléfono, empresa y mensaje"),
"priv.c23": ("Contact form", "Kontaktskjema", "Formulario de contacto"),
"priv.c24": ("Reply to the request", "Svare på henvendelsen", "Responder a la solicitud"),
"priv.c25": ("Pre-contractual measures (6.1.b) and consent (6.1.a)", "Tiltak før avtaleinngåelse (6.1.b) og samtykke (6.1.a)", "Medidas precontractuales (6.1.b) y consentimiento (6.1.a)"),
"priv.c26": ("Language and cookie preferences, login session", "Valg av språk og informasjonskapsler, innloggingsøkt", "Preferencia de idioma y de cookies, sesión de acceso"),
"priv.c27": ("Browser", "Nettleser", "Navegador"),
"priv.c28": ("Keep your choices and your Min side login", "Huske valgene dine og innloggingen i Min side", "Mantener tus preferencias y el acceso a Min side"),
"priv.c29": ("Legitimate interest (6.1.f)", "Berettiget interesse (6.1.f)", "Interés legítimo (6.1.f)"),
"priv.c30": ("Technical logs and IP address in coded form (hash)", "Tekniske logger og IP-adresse i kodet form (hash)", "Registros técnicos y dirección IP en forma codificada (hash)"),
"priv.c31": ("Server", "Server", "Servidor"),
"priv.c32": ("Security, rate limiting and availability", "Sikkerhet, begrensning av forsøk og tilgjengelighet", "Seguridad, límite de intentos y disponibilidad"),
"priv.c33": ("Legitimate interest (6.1.f)", "Berettiget interesse (6.1.f)", "Interés legítimo (6.1.f)"),
"priv.c34": (
  "We do not collect sensitive data, do not profile you and make no automated decisions with legal effect on you. Card details are entered directly on Stripe's page: Digital Solutions never sees or stores the card number.",
  "Vi samler ikke inn sensitive opplysninger, driver ikke profilering og tar ingen automatiserte avgjørelser med rettsvirkning for deg. Kortopplysningene skrives inn direkte på Stripes side: Digital Solutions ser eller lagrer aldri kortnummeret.",
  "No recogemos datos sensibles, no elaboramos perfiles ni tomamos decisiones automatizadas con efectos jurídicos sobre ti. Los datos de la tarjeta se introducen directamente en la página de Stripe: Digital Solutions nunca ve ni guarda el número de la tarjeta."),
"priv.c35": ("4. Customer pages on side.dsnorge.com", "4. Kundenes sider på side.dsnorge.com", "4. Páginas de los clientes en side.dsnorge.com"),
"priv.c36": (
  "The content of each landing page is written and published by the customer, who is responsible for it. Customer pages use no cookies, have no forms and load no third-party resources; the server keeps only technical logs for security. Anyone who wants to exercise rights over data shown on a customer's page should contact that customer, whose details are on the page, or write to <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "Innholdet på hver landingsside skrives og publiseres av kunden selv, som er ansvarlig for det. Kundenes sider bruker ikke informasjonskapsler, har ingen skjemaer og laster ingen ressurser fra tredjeparter; serveren lagrer bare tekniske logger for sikkerhet. Vil du utøve rettigheter knyttet til opplysninger på en kundes side, kontakter du kunden, som har kontaktinformasjon på siden, eller skriver til <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "El contenido de cada landing page lo escribe y publica el propio cliente, que responde por él. Las páginas de los clientes no usan cookies, no tienen formularios ni cargan recursos de terceros; el servidor solo guarda registros técnicos por seguridad. Quien quiera ejercer derechos sobre datos que aparecen en la página de un cliente debe dirigirse a ese cliente, cuyo contacto figura en la página, o escribir a <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>."),
"priv.c37": (
  "When Digital Solutions operates a platform or builds a custom system for a customer, the data in those environments belongs to the customer, who is the controller. In those cases Digital Solutions acts as <em>processor</em>, under the data processing agreement signed with that customer.",
  "Når Digital Solutions drifter en plattform eller utvikler et skreddersydd system for en kunde, tilhører opplysningene i disse løsningene kunden, som er behandlingsansvarlig. Da er Digital Solutions <em>databehandler</em>, etter databehandleravtalen med kunden.",
  "Cuando Digital Solutions opera una plataforma o desarrolla un sistema a medida para un cliente, los datos de esos entornos pertenecen al cliente, que es el responsable. En esos casos Digital Solutions actúa como <em>encargado</em> del tratamiento, según el contrato de tratamiento de datos firmado con ese cliente."),
"priv.c38": ("5. Where the data is kept", "5. Hvor opplysningene lagres", "5. Dónde se guardan los datos"),
"priv.c39": (
  "The order form and Min side send the data over an encrypted connection (HTTPS) to our own server, hosted by Domeneshop in Norway. Database, photos and email are kept with the same provider. The contact form opens your own email program with the message ready, and no data passes through an intermediary server.",
  "Bestillingsskjemaet og Min side sender opplysningene over kryptert forbindelse (HTTPS) til vår egen server hos Domeneshop i Norge. Database, bilder og e-post ligger hos samme leverandør. Kontaktskjemaet åpner ditt eget e-postprogram med meldingen ferdig utfylt, og ingen opplysninger går via en mellomliggende server.",
  "El formulario de pedido y Min side envían los datos por conexión cifrada (HTTPS) a nuestro propio servidor, alojado en Domeneshop, en Noruega. Base de datos, fotos y correo están en el mismo proveedor. El formulario de contacto abre tu propio programa de correo con el mensaje listo, y ningún dato pasa por un servidor intermedio."),
"priv.c40": ("6. Who the data is shared with", "6. Hvem opplysningene deles med", "6. Con quién se comparten los datos"),
"priv.c41": (
  "<strong>Domeneshop AS</strong> (Norway): hosting, database and email, as processor.",
  "<strong>Domeneshop AS</strong> (Norge): webhotell, database og e-post, som databehandler.",
  "<strong>Domeneshop AS</strong> (Noruega): alojamiento, base de datos y correo, como encargado."),
"priv.c42": (
  "<strong>Stripe</strong> (Stripe Payments Europe Ltd., Ireland): card payments and receipts. Stripe acts as processor and, for fraud prevention and its own legal obligations, as an independent controller, under Stripe's privacy policy.",
  "<strong>Stripe</strong> (Stripe Payments Europe Ltd., Irland): kortbetaling og kvitteringer. Stripe er databehandler og, for forebygging av svindel og egne lovpålagte plikter, selvstendig behandlingsansvarlig etter Stripes personvernerklæring.",
  "<strong>Stripe</strong> (Stripe Payments Europe Ltd., Irlanda): pagos con tarjeta y recibos. Stripe actúa como encargado y, para la prevención del fraude y sus propias obligaciones legales, como responsable independiente, según la política de privacidad de Stripe."),
"priv.c43": (
  "When a project requires joint work with Barros Consultoria or Inteligência Sanitária, this is stated in the proposal before any sharing. We do not sell, rent or give away data for advertising.",
  "Når et prosjekt krever samarbeid med Barros Consultoria eller Inteligência Sanitária, står det i tilbudet før noe deles. Vi selger, leier ut eller gir ikke bort opplysninger til reklameformål.",
  "Cuando un proyecto requiere trabajo conjunto con Barros Consultoria o Inteligência Sanitária, se indica en la propuesta antes de compartir nada. No vendemos, alquilamos ni cedemos datos con fines publicitarios."),
"priv.c44": ("7. International transfers", "7. Overføring til utlandet", "7. Transferencias internacionales"),
"priv.c45": (
  "Data is kept in the European Economic Area. Stripe may process data outside the EEA, including in the United States; such transfers are covered by the EU–US Data Privacy Framework or the European Commission's standard contractual clauses.",
  "Opplysningene lagres i EØS. Stripe kan behandle opplysninger utenfor EØS, også i USA; slike overføringer er dekket av EU–US Data Privacy Framework eller EU-kommisjonens standard personvernbestemmelser.",
  "Los datos se guardan en el Espacio Económico Europeo. Stripe puede tratar datos fuera del EEE, incluso en Estados Unidos; esas transferencias están amparadas por el EU–US Data Privacy Framework o por las cláusulas contractuales tipo de la Comisión Europea."),
"priv.c46": ("8. How long we keep data", "8. Hvor lenge vi lagrer", "8. Cuánto tiempo guardamos los datos"),
"priv.c47": ("Order that does not become a subscription: up to 12 months after the order.", "Bestilling som ikke blir abonnement: inntil 12 måneder etter bestillingen.", "Pedido que no se convierte en suscripción: hasta 12 meses después del pedido."),
"priv.c48": (
  "Page content and photos: while the subscription is active and up to 3 months after it ends, so the material can be returned to the customer.",
  "Innhold og bilder på siden: så lenge abonnementet løper og inntil 3 måneder etter at det er avsluttet, slik at materialet kan leveres tilbake til kunden.",
  "Contenido de la página y fotos: mientras la suscripción esté activa y hasta 3 meses después de su fin, para poder devolver el material al cliente."),
"priv.c49": (
  "Billing data and receipts: 5 years, as required by Norwegian accounting law (<em>bokføringsloven</em>).",
  "Betalingsopplysninger og kvitteringer: 5 år, etter <em>bokføringsloven</em>.",
  "Datos de cobro y recibos: 5 años, según la legislación contable noruega (<em>bokføringsloven</em>)."),
"priv.c50": ("Min side login links: up to 30 days.", "Innloggingslenker til Min side: inntil 30 dager.", "Enlaces de acceso a Min side: hasta 30 días."),
"priv.c51": ("Contact request that does not become a contract: up to 12 months after the last contact.", "Henvendelse som ikke blir avtale: inntil 12 måneder etter siste kontakt.", "Solicitud de contacto que no se convierte en contrato: hasta 12 meses después del último contacto."),
"priv.c52": ("Technical server logs: up to 12 months.", "Tekniske serverlogger: inntil 12 måneder.", "Registros técnicos del servidor: hasta 12 meses."),
"priv.c53": ("Preferences stored in the browser: up to 12 months or until you delete them.", "Valg lagret i nettleseren: inntil 12 måneder eller til du sletter dem.", "Preferencias guardadas en el navegador: hasta 12 meses o hasta que las borres."),
"priv.c54": ("9. Your rights", "9. Dine rettigheter", "9. Tus derechos"),
"priv.c55": (
  "You may at any time and free of charge request: confirmation of processing and access to your data; correction of incomplete or outdated data; erasure; portability in an open format; restriction of processing; objection to processing based on legitimate interest; and withdrawal of consent, without retroactive effect. Write to <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>. You will get an answer within 30 days.",
  "Du kan når som helst og uten kostnad be om: bekreftelse på behandling og innsyn i opplysningene; retting av ufullstendige eller utdaterte opplysninger; sletting; dataportabilitet i åpent format; begrensning av behandlingen; protest mot behandling basert på berettiget interesse; og tilbaketrekking av samtykke, uten tilbakevirkende kraft. Skriv til <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>. Du får svar innen 30 dager.",
  "Puedes solicitar en cualquier momento y sin coste: confirmación del tratamiento y acceso a los datos; rectificación de datos incompletos o desactualizados; supresión; portabilidad en formato abierto; limitación del tratamiento; oposición al tratamiento basado en interés legítimo; y retirada del consentimiento, sin efecto retroactivo. Escribe a <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>. La respuesta llega en un plazo de 30 días."),
"priv.c56": (
  "If you are not satisfied with the answer, you can complain to the supervisory authority: <strong>Datatilsynet</strong> (Norway, datatilsynet.no) or <strong>ANPD</strong> (Brazil, gov.br/anpd).",
  "Er du ikke fornøyd med svaret, kan du klage til tilsynsmyndigheten: <strong>Datatilsynet</strong> (Norge, datatilsynet.no) eller <strong>ANPD</strong> (Brasil, gov.br/anpd).",
  "Si la respuesta no te satisface, puedes reclamar ante la autoridad de control: <strong>Datatilsynet</strong> (Noruega, datatilsynet.no) o <strong>ANPD</strong> (Brasil, gov.br/anpd)."),
"priv.c57": ("10. Security", "10. Sikkerhet", "10. Seguridad"),
"priv.c58": (
  "All addresses are served over HTTPS only. Login to Min side uses a single-use link sent by email, valid for 30 minutes, with no stored password. Database passwords are kept only on the server, outside the public code. IP addresses are stored only in coded form (hash). Security issues can be reported through the channel declared in <span class=\"mono\">/.well-known/security.txt</span>, under RFC 9116.",
  "Alle adresser leveres bare over HTTPS. Innlogging i Min side skjer med en engangslenke på e-post som virker i 30 minutter, uten lagret passord. Passord til databasen ligger bare på serveren, utenfor den offentlige koden. IP-adresser lagres bare i kodet form (hash). Sikkerhetsproblemer kan meldes via kanalen i <span class=\"mono\">/.well-known/security.txt</span>, etter RFC 9116.",
  "Todas las direcciones se sirven solo por HTTPS. El acceso a Min side se hace con un enlace de un solo uso enviado por e-mail, válido 30 minutos, sin contraseña guardada. Las contraseñas de la base de datos están solo en el servidor, fuera del código público. Las direcciones IP se guardan solo en forma codificada (hash). Los fallos de seguridad pueden comunicarse por el canal declarado en <span class=\"mono\">/.well-known/security.txt</span>, conforme a la RFC 9116."),
"priv.c59": ("11. Changes", "11. Endringer", "11. Cambios"),
"priv.c60": (
  "Material changes to this policy are published on this page with a new version and revision date. The version history is kept in the site's public repository.",
  "Vesentlige endringer i erklæringen publiseres på denne siden med ny versjon og revisjonsdato. Versjonshistorikken ligger i nettstedets offentlige kodelager.",
  "Los cambios materiales de esta política se publican en esta página con nueva versión y fecha de revisión. El historial de versiones queda en el repositorio público del sitio."),
"priv.c61": ("Document", "Dokument", "Documento"),
"priv.c62": ("Version", "Versjon", "Versión"),
"priv.c63": ("Master language", "Hovedspråk", "Idioma maestro"),
"priv.c64": ("Next review", "Neste revisjon", "Próxima revisión"),

# ─── Termos de uso ──────────────────────────────────────────
"term.c01": ("1. Who publishes this site", "1. Hvem publiserer nettstedet", "1. Quién publica este sitio"),
"term.c02": (
  "dsnorge.com is published by <strong>Digital Solutions</strong>, a company registered in Norway with org. no. 996 041 468. Contact: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "dsnorge.com publiseres av <strong>Digital Solutions</strong>, registrert i Norge med org.nr. 996 041 468. Kontakt: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "dsnorge.com lo publica <strong>Digital Solutions</strong>, empresa registrada en Noruega con org. n.º 996 041 468. Contacto: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>."),
"term.c03": ("2. Nature of the catalogue information", "2. Informasjonen i katalogen", "2. Naturaleza de la información del catálogo"),
"term.c04": (
  "The catalogue of platforms and services describes the typical scope of each item and the usual way it is contracted. It is informative material, not a binding commercial offer. Prices shown in subscription plans are subject to the conditions in force on the date of contract. Scope, deadline, price, service level and acceptance criteria for any work only exist once they are set out in a signed proposal or contract.",
  "Katalogen over plattformer og tjenester beskriver typisk omfang og vanlig avtaleform for hver tjeneste. Den er informasjon, ikke et bindende tilbud. Priser i abonnementsplaner gjelder etter vilkårene som gjelder på avtaletidspunktet. Omfang, frist, pris, servicenivå og akseptkriterier for et oppdrag gjelder først når de står i et signert tilbud eller en signert avtale.",
  "El catálogo de plataformas y servicios describe el alcance típico de cada elemento y la forma habitual de contratación. Es material informativo, no una oferta comercial vinculante. Los precios de los planes de suscripción están sujetos a las condiciones vigentes en la fecha de contratación. Alcance, plazo, precio, nivel de servicio y criterios de aceptación de cualquier trabajo solo existen cuando constan en una propuesta o contrato firmado."),
"term.c05": ("3. Ownership of site content", "3. Rettigheter til innholdet", "3. Titularidad del contenido del sitio"),
"term.c06": (
  "Texts, catalogue structure, visual identity, the service disc and other editorial elements belong to Digital Solutions. Reproduction, adaptation or commercial use requires written permission. Quoting with credit and a link to the original page is allowed.",
  "Tekster, katalogens oppbygging, visuell profil, tjenestehjulet og annet redaksjonelt innhold tilhører Digital Solutions. Gjengivelse, bearbeiding eller kommersiell bruk krever skriftlig tillatelse. Sitat med kildehenvisning og lenke til originalsiden er tillatt.",
  "Los textos, la estructura del catálogo, la identidad visual, el disco de servicios y demás elementos editoriales pertenecen a Digital Solutions. La reproducción, adaptación o uso comercial requieren autorización por escrito. Se permite citar indicando la fuente y enlazando la página original."),
"term.c07": ("4. Source code and third-party licences", "4. Kildekode og tredjepartslisenser", "4. Código fuente y licencias de terceros"),
"term.c08": (
  "The source code of this site is published in a public repository under the MIT licence, as stated in the <span class=\"mono\">LICENSE</span> file. The licence covers the code; it does not cover the editorial content, the commercial catalogue or the visual identity, dealt with in the previous clause. The IBM Plex typefaces are used under the SIL Open Font License 1.1.",
  "Kildekoden til nettstedet er publisert i et offentlig kodelager under MIT-lisens, se filen <span class=\"mono\">LICENSE</span>. Lisensen gjelder koden, ikke det redaksjonelle innholdet, katalogen eller den visuelle profilen, som omtales i punktet over. Skrifttypene IBM Plex brukes under SIL Open Font License 1.1.",
  "El código fuente de este sitio está publicado en un repositorio público con licencia MIT, según el archivo <span class=\"mono\">LICENSE</span>. La licencia cubre el código; no cubre el contenido editorial, el catálogo comercial ni la identidad visual, tratados en la cláusula anterior. Las tipografías IBM Plex se usan bajo la SIL Open Font License 1.1."),
"term.c09": ("5. Software developed or licensed", "5. Programvare som utvikles eller lisensieres", "5. Software desarrollado o licenciado"),
"term.c10": (
  "Our own platforms — MIMBAI, Oslo Meet and SALA · Safe-Load Analytics — are licensed by subscription. Digital Solutions keeps ownership of the code; data entered by the customer remains the customer's and can be exported in an open format at any time during the contract and within the exit periods set out in it.",
  "Våre egne plattformer — MIMBAI, Oslo Meet og SALA · Safe-Load Analytics — lisensieres som abonnement. Digital Solutions eier koden; opplysningene kunden legger inn tilhører kunden og kan eksporteres i åpent format når som helst i avtaleperioden og innenfor avviklingsfristene i avtalen.",
  "Nuestras plataformas propias — MIMBAI, Oslo Meet y SALA · Safe-Load Analytics — se licencian por suscripción. Digital Solutions conserva la titularidad del código; los datos introducidos por el cliente siguen siendo del cliente y pueden exportarse en formato abierto en cualquier momento durante la vigencia y en los plazos de salida previstos en el contrato."),
"term.c11": (
  "For custom-built systems, ownership of what is developed specifically for the contract is defined in the contract itself, together with the scope of documentation and knowledge transfer. Open-source components used in the solution remain under their original licences, listed in the delivery documentation.",
  "For skreddersydde systemer avtales rettighetene til det som utvikles for oppdraget i selve avtalen, sammen med omfanget av dokumentasjon og kunnskapsoverføring. Åpen kildekode som brukes i løsningen beholder sine opprinnelige lisenser, som står i leveransedokumentasjonen.",
  "En los sistemas a medida, la titularidad de lo desarrollado específicamente para el contrato se define en el propio contrato, junto con el alcance de la documentación y de la transferencia de conocimiento. Los componentes de código abierto usados en la solución mantienen sus licencias originales, indicadas en la documentación de entrega."),
"term.c12": ("6. Landing page subscription", "6. Abonnement på landingsside", "6. Suscripción de landing page"),
"term.c13": (
  "Anyone who orders a landing page is also bound by the <a href=\"/vilkar.html\">Abonnementsvilkår</a> (subscription terms), which take precedence over this page on that point. The content of customer pages on side.dsnorge.com is the responsibility of each customer. To report illegal content on one of these pages, write to <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "Den som bestiller landingsside, er også bundet av <a href=\"/vilkar.html\">Abonnementsvilkår</a>, som går foran denne siden på det punktet. Innholdet på kundenes sider på side.dsnorge.com er hver kundes ansvar. Melding om ulovlig innhold på en av disse sidene sendes til <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>.",
  "Quien contrata una landing page también está sujeto a los <a href=\"/vilkar.html\">Abonnementsvilkår</a> (condiciones de la suscripción), que prevalecen sobre esta página en ese punto. El contenido de las páginas de los clientes en side.dsnorge.com es responsabilidad de cada cliente. Para comunicar contenido ilegal en una de esas páginas, escribe a <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>."),
"term.c14": ("7. Acceptable use", "7. Akseptabel bruk", "7. Uso aceptable"),
"term.c15": (
  "It is not permitted to: attempt unauthorised access to this site or any related system; extract content automatically in volumes that degrade the service; use the contact form to send unsolicited bulk messages; or reproduce the site, in whole or in part, in a way that suggests an origin, authorship or affiliation that does not exist.",
  "Det er ikke tillatt å: forsøke å skaffe seg uautorisert tilgang til nettstedet eller tilknyttede systemer; hente ut innhold automatisk i et omfang som svekker tjenesten; bruke kontaktskjemaet til uønsket massekommunikasjon; eller kopiere nettstedet, helt eller delvis, på en måte som gir inntrykk av en opprinnelse, et opphav eller en tilknytning som ikke finnes.",
  "Queda prohibido: intentar acceder sin autorización a este sitio o a cualquier sistema asociado; extraer contenido de forma automatizada en un volumen que degrade el servicio; usar el formulario de contacto para enviar mensajes masivos no solicitados; y reproducir el sitio, total o parcialmente, de forma que sugiera un origen, autoría o vínculo que no existen."),
"term.c16": ("8. Availability", "8. Tilgjengelighet", "8. Disponibilidad"),
"term.c17": (
  "The site is provided as is. There is no guarantee of uninterrupted availability, and maintenance may take place without notice. Availability and service-level commitments only exist for contracted platforms, under the relevant subscription contract.",
  "Nettstedet leveres som det er. Det gis ingen garanti for at det alltid er tilgjengelig, og vedlikehold kan skje uten varsel. Forpliktelser om tilgjengelighet og servicenivå gjelder bare for plattformer det er inngått avtale om, etter den aktuelle abonnementsavtalen.",
  "El sitio se ofrece tal cual. No hay garantía de disponibilidad ininterrumpida, y puede haber mantenimiento sin aviso previo. Los compromisos de disponibilidad y nivel de servicio solo existen para las plataformas contratadas, según el contrato de suscripción correspondiente."),
"term.c18": ("9. External links", "9. Eksterne lenker", "9. Enlaces externos"),
"term.c19": (
  "This site links to third-party domains and to platforms with their own life cycle, including mimbai.com, oslomeet.org, barros.no and public repositories. Digital Solutions is not responsible for the content, availability or privacy practices of those destinations.",
  "Nettstedet lenker til tredjeparts domener og plattformer med egen livssyklus, blant annet mimbai.com, oslomeet.org, barros.no og offentlige kodelagre. Digital Solutions er ikke ansvarlig for innhold, tilgjengelighet eller personvernpraksis på disse stedene.",
  "Este sitio enlaza a dominios de terceros y a plataformas con ciclo propio, entre ellos mimbai.com, oslomeet.org, barros.no y repositorios públicos. Digital Solutions no responde del contenido, la disponibilidad ni las prácticas de privacidad de esos destinos."),
"term.c20": ("10. Limitation of liability", "10. Ansvarsbegrensning", "10. Limitación de responsabilidad"),
"term.c21": (
  "The information on this page is general and does not constitute technical, legal, accounting or regulatory advice for a specific case. Decisions based solely on the site's content are the responsibility of whoever makes them. Digital Solutions' liability for contracted work follows the limits set out in the relevant contract.",
  "Informasjonen på nettstedet er generell og er ikke teknisk, juridisk, regnskapsmessig eller regulatorisk rådgivning i en konkret sak. Beslutninger tatt bare på grunnlag av innholdet her er den enkeltes eget ansvar. Digital Solutions' ansvar for avtalt arbeid følger grensene i den aktuelle avtalen.",
  "La información de esta página es de carácter general y no constituye asesoramiento técnico, jurídico, contable ni regulatorio para un caso concreto. Las decisiones tomadas solo con base en el contenido del sitio son responsabilidad de quien las toma. La responsabilidad de Digital Solutions en trabajos contratados sigue los límites fijados en el contrato correspondiente."),
"term.c22": ("11. Data protection", "11. Personvern", "11. Protección de datos"),
"term.c23": (
  "The processing of personal data is described in the <a href=\"/politica-de-privacidade.html\">Privacy Policy</a>, and the use of browser storage in the <a href=\"/aviso-de-cookies.html\">Cookie Notice</a>.",
  "Behandlingen av personopplysninger er beskrevet i <a href=\"/politica-de-privacidade.html\">personvernerklæringen</a>, og bruken av lagring i nettleseren i <a href=\"/aviso-de-cookies.html\">erklæringen om informasjonskapsler</a>.",
  "El tratamiento de datos personales se describe en la <a href=\"/politica-de-privacidade.html\">Política de Privacidad</a>, y el uso del almacenamiento del navegador, en el <a href=\"/aviso-de-cookies.html\">Aviso de Cookies</a>."),
"term.c24": ("12. Governing law and jurisdiction", "12. Lovvalg og verneting", "12. Ley aplicable y jurisdicción"),
"term.c25": (
  "These terms are governed by Norwegian law. The competent court is that of Digital Solutions' domicile in Norway, without prejudice to any jurisdiction that consumer or data protection law grants the data subject in their country of residence.",
  "Vilkårene reguleres av norsk rett. Verneting er Digital Solutions' hjemting i Norge, med forbehold om verneting som forbruker- eller personvernlovgivning gir den registrerte i bostedslandet.",
  "Estas condiciones se rigen por la ley noruega. Son competentes los tribunales del domicilio de Digital Solutions en Noruega, sin perjuicio de las garantías de jurisdicción que la legislación de protección del consumidor o de datos conceda al interesado en su país de residencia."),
"term.c26": ("13. Changes", "13. Endringer", "13. Cambios"),
"term.c27": (
  "These terms may change. The version in force is always the one published on this page, with the revision date shown below, and the history is kept in the site's public repository.",
  "Vilkårene kan endres. Gjeldende versjon er alltid den som er publisert på denne siden, med revisjonsdato nedenfor, og historikken ligger i nettstedets offentlige kodelager.",
  "Estas condiciones pueden cambiar. La versión vigente es siempre la publicada en esta página, con la fecha de revisión indicada abajo, y el historial queda en el repositorio público del sitio."),
"term.c28": ("Document", "Dokument", "Documento"),
"term.c29": ("Version", "Versjon", "Versión"),
"term.c30": ("Master language", "Hovedspråk", "Idioma maestro"),
"term.c31": ("Next review", "Neste revisjon", "Próxima revisión"),

# ─── Aviso de cookies ───────────────────────────────────────
"cook.c01": ("1. Cookies and local storage", "1. Informasjonskapsler og lokal lagring", "1. Cookies y almacenamiento local"),
"cook.c02": (
  "A cookie is a small file a site saves in the browser. Local storage (<span class=\"mono\">localStorage</span>) does something similar, without being sent to the server with every request. dsnorge.com uses only local storage. The customer area, minside.dsnorge.com, uses a single session cookie, needed to keep you logged in. Customer pages on side.dsnorge.com use no cookies. There are no third-party cookies and no tracking pixels.",
  "En informasjonskapsel (cookie) er en liten fil et nettsted lagrer i nettleseren. Lokal lagring (<span class=\"mono\">localStorage</span>) gjør noe lignende, uten å sendes til serveren ved hver forespørsel. dsnorge.com bruker bare lokal lagring. Kundeområdet minside.dsnorge.com bruker én øktkapsel, som trengs for å holde deg innlogget. Kundenes sider på side.dsnorge.com bruker ingen informasjonskapsler. Det finnes ingen tredjepartskapsler eller sporingspiksler.",
  "Una cookie es un pequeño archivo que un sitio guarda en el navegador. El almacenamiento local (<span class=\"mono\">localStorage</span>) cumple una función parecida, sin enviarse al servidor en cada petición. dsnorge.com usa solo almacenamiento local. El área de clientes, minside.dsnorge.com, usa una única cookie de sesión, necesaria para mantener el acceso. Las páginas de los clientes en side.dsnorge.com no usan cookies. No hay cookies de terceros ni píxeles de seguimiento."),
"cook.c03": ("2. What is stored today", "2. Hva som lagres i dag", "2. Qué se guarda hoy"),
"cook.c04": ("Key", "Nøkkel", "Clave"),
"cook.c05": ("Category", "Kategori", "Categoría"),
"cook.c06": ("Purpose", "Formål", "Para qué"),
"cook.c07": ("Duration", "Varighet", "Plazo"),
"cook.c08": ("<span class=\"mono\">ds.idioma</span>", "<span class=\"mono\">ds.idioma</span>", "<span class=\"mono\">ds.idioma</span>"),
"cook.c09": ("Essential", "Nødvendig", "Esencial"),
"cook.c10": ("Keep the chosen language between visits", "Huske valgt språk mellom besøk", "Mantener el idioma elegido entre visitas"),
"cook.c11": ("Up to 12 months or until you clear it", "Inntil 12 måneder eller til du sletter", "Hasta 12 meses o hasta que lo borres"),
"cook.c12": ("<span class=\"mono\">ds.consentimento</span>", "<span class=\"mono\">ds.consentimento</span>", "<span class=\"mono\">ds.consentimento</span>"),
"cook.c13": ("Essential", "Nødvendig", "Esencial"),
"cook.c14": ("Record your cookie choice, with date and version", "Registrere valget ditt om informasjonskapsler, med dato og versjon", "Registrar tu elección de cookies, con fecha y versión"),
"cook.c15": ("Up to 12 months or until you clear it", "Inntil 12 måneder eller til du sletter", "Hasta 12 meses o hasta que lo borres"),
"cook.c16": (
  "<span class=\"mono\">ds_minside</span> (cookie, only on minside.dsnorge.com)",
  "<span class=\"mono\">ds_minside</span> (informasjonskapsel, bare på minside.dsnorge.com)",
  "<span class=\"mono\">ds_minside</span> (cookie, solo en minside.dsnorge.com)"),
"cook.c17": ("Essential", "Nødvendig", "Esencial"),
"cook.c18": ("Keep you logged in to Min side after login", "Holde deg innlogget i Min side", "Mantenerte conectado a Min side tras el acceso"),
"cook.c19": ("Until you close the browser or log out", "Til du lukker nettleseren eller logger ut", "Hasta que cierres el navegador o salgas"),
"cook.c20": (
  "These are the only items in use, and all are essential within the meaning of the GDPR: without them the language, the cookie choice and the login do not work.",
  "Dette er de eneste som brukes, og alle er nødvendige etter GDPR: uten dem virker ikke språkvalget, valget om informasjonskapsler eller innloggingen.",
  "Son los únicos elementos en uso, y todos son esenciales en el sentido del RGPD: sin ellos no funcionan el idioma, la elección de cookies ni el acceso."),
"cook.c21": ("3. Categories declared but not active", "3. Kategorier som er oppgitt, men ikke i bruk", "3. Categorías declaradas pero no activas"),
"cook.c22": (
  "The consent panel offers the categories <strong>analytics</strong> and <strong>marketing</strong>. Neither is active today — no audience measurement tool or advertising tag is installed on this site. The options exist because the choice must be recorded <em>before</em> any future activation, not after.",
  "Samtykkepanelet tilbyr kategoriene <strong>analyse</strong> og <strong>markedsføring</strong>. Ingen av dem er i bruk i dag — det er ikke installert noe verktøy for måling av trafikk eller reklame. Valgene finnes fordi samtykket må være registrert <em>før</em> en eventuell aktivering, ikke etterpå.",
  "El panel de consentimiento ofrece las categorías <strong>analítica</strong> y <strong>marketing</strong>. Ninguna está activa hoy: no hay herramienta de medición de audiencia ni etiqueta publicitaria instalada en este sitio. Las opciones existen porque la elección debe quedar registrada <em>antes</em> de cualquier activación futura, no después."),
"cook.c23": (
  "Meanwhile, the site runs no third-party resources: fonts, styles and scripts come from our own domain, and no request goes out when the page opens. You can check this in your browser's network panel.",
  "Nettstedet laster heller ingen ressurser fra tredjeparter: skrifter, stiler og skript kommer fra vårt eget domene, og ingen forespørsler går ut når siden åpnes. Du kan sjekke dette i nettverkspanelet i nettleseren.",
  "Mientras tanto, el sitio no carga ningún recurso de terceros: fuentes, estilos y scripts salen de nuestro propio dominio, y ninguna petición sale fuera al abrir la página. Puedes comprobarlo en el panel de red de tu navegador."),
"cook.c24": ("4. How to review or withdraw", "4. Slik endrer eller trekker du tilbake valget", "4. Cómo revisar o revocar"),
"cook.c25": (
  "You can clear this site's storage in your browser settings, in the privacy and browsing data section. Once cleared, the consent panel appears again on your next visit and you can decide again.",
  "Du kan slette lagringen for nettstedet i innstillingene i nettleseren, under personvern og nettleserdata. Etterpå vises samtykkepanelet igjen ved neste besøk, og du kan velge på nytt.",
  "Puedes borrar el almacenamiento de este sitio en la configuración de tu navegador, en la sección de privacidad y datos de navegación. Al borrarlo, el panel de consentimiento vuelve a aparecer en la próxima visita y puedes decidir de nuevo."),
"cook.c26": (
  "In the most common browsers the path is: Chrome and Edge, «Settings → Privacy and security → Cookies and other site data»; Firefox, «Settings → Privacy &amp; Security → Cookies and Site Data»; Safari, «Settings → Privacy → Manage Website Data».",
  "I de vanligste nettleserne finner du det her: Chrome og Edge, «Innstillinger → Personvern og sikkerhet → Informasjonskapsler og andre nettstedsdata»; Firefox, «Innstillinger → Personvern og sikkerhet → Informasjonskapsler og nettstedsdata»; Safari, «Innstillinger → Personvern → Administrer nettstedsdata».",
  "En los navegadores más usados, la ruta es: Chrome y Edge, «Configuración → Privacidad y seguridad → Cookies y otros datos de sitios»; Firefox, «Ajustes → Privacidad y seguridad → Cookies y datos del sitio»; Safari, «Ajustes → Privacidad → Gestionar datos de sitios web»."),
"cook.c27": ("5. Changes", "5. Endringer", "5. Cambios"),
"cook.c28": (
  "If new categories are activated, this table is updated before activation and the consent panel is shown again to all visitors, with a new record version.",
  "Hvis nye kategorier tas i bruk, oppdateres tabellen før aktiveringen, og samtykkepanelet vises igjen for alle besøkende, med ny registreringsversjon.",
  "Si se activan nuevas categorías, esta tabla se actualiza antes de la activación y el panel de consentimiento vuelve a mostrarse a todos los visitantes, con una nueva versión de registro."),
"cook.c29": ("6. Contact", "6. Kontakt", "6. Contacto"),
"cook.c30": (
  "Questions about this notice: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>. See also the <a href=\"/politica-de-privacidade.html\">Privacy Policy</a>.",
  "Spørsmål om denne erklæringen: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>. Se også <a href=\"/politica-de-privacidade.html\">personvernerklæringen</a>.",
  "Dudas sobre este aviso: <a href=\"mailto:info@dsnorge.com\">info@dsnorge.com</a>. Ver también la <a href=\"/politica-de-privacidade.html\">Política de Privacidad</a>."),
"cook.c31": ("Document", "Dokument", "Documento"),
"cook.c32": ("Version", "Versjon", "Versión"),
"cook.c33": ("Master language", "Hovedspråk", "Idioma maestro"),
"cook.c34": ("Next review", "Neste revisjon", "Próxima revisión"),
}
