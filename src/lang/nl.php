<?php
declare(strict_types=1);

/**
 * Nederlandse teksten voor de publieke site.
 * Waarden worden rauw in de HTML geëchood (<?= t('...') ?>), dus HTML-markup
 * in een waarde is bewust. Placeholders zoals :name worden via $vars vervangen.
 */

return [
    // ── Taalschakelaar ──────────────────────────────────────
    'lang.switch_aria' => 'Taal',

    // ── Navigatie / merk ───────────────────────────────────
    'brand.aria'   => 'Ga naar home',
    'nav.aria'     => 'Hoofd',
    'nav.home'     => 'Home',
    'nav.about'    => 'Over mij',
    'nav.projects' => 'Projecten',
    'nav.contact'  => 'Contact',
    'nav.login'    => 'Login',

    // ── Footer ─────────────────────────────────────────────
    'footer.rights'  => 'Alle rechten voorbehouden',
    'footer.privacy' => 'Privacy',

    // ── Home (index.php) ───────────────────────────────────
    'meta.title.home'          => 'Portfolio — Lucas Askamp',
    'home.hero.title'          => 'Portfolio van Lucas Askamp',
    'home.hero.tagline'        => 'Webdeveloper. Focus op websites met strakke code en een duidelijke UX.',
    'home.hero.view_projects'  => 'Bekijk projecten',
    'home.hero.contact'        => 'Neem contact op',

    'home.intro.who.title'     => 'Wie ik ben',
    'home.intro.who.body'      => 'Tweedejaars student Software Development aan het Grafisch Lyceum Rotterdam (MBO-4). Ik ben al vroeg met tech en code bezig en zoek een stageplek om mijn skills verder te laten groeien.',
    'home.intro.download_cv'   => 'Download CV (PDF)',
    'home.intro.plan_meeting'  => 'Plan een kennismaking',
    'home.intro.what.title'    => 'Wat ik doe',
    'home.intro.what.body'     => 'Ik bouw dynamische, responsieve websites met HTML, CSS, JavaScript en PHP. Daarnaast verdiep ik me in C# en game-development (Unity/Unreal).',

    'home.highlights.frontend.title'    => 'Frontend',
    'home.highlights.frontend.body'     => 'Schone mark-up, moderne CSS en duidelijke interacties.',
    'home.highlights.performance.title' => 'Performance',
    'home.highlights.performance.body'  => 'Lichte pagina’s, snelle laadtijden en heldere code.',
    'home.highlights.manage.title'      => 'Beheer',
    'home.highlights.manage.body'       => 'Admin hub in dezelfde stijl voor eenvoudig onderhoud.',

    'home.skills.langs.title'  => 'Codeertalen',
    'home.skills.csharp_basic' => 'C# (basis)',
    'home.skills.database'     => 'Database',
    'home.skills.tools.title'  => 'Software & tools',

    'home.exp.mcd.title'  => 'McDonald’s — Host/Supervisor',
    'home.exp.mcd.period' => 'Feb 2024 – heden',
    'home.exp.mcd.body'   => 'Binnen acht maanden “Crew van de Maand”, daarna doorgegroeid naar supervisor. Verantwoordelijk voor de eetruimte en aansturing van het team.',
    'home.exp.ah.title'   => 'Albert Heijn — Vakkenvuller',
    'home.exp.ah.period'  => 'Aug 2022 – Feb 2023',
    'home.exp.ah.body'    => 'Vakken vullen en winkelondersteuning in de avonduren, meerdere dagen per week.',

    'home.edu.title' => 'Opleiding',
    'home.edu.body'  => '<strong>Grafisch Lyceum Rotterdam</strong> — ICT & Media, MBO-4 (3-jarig).',
    'home.langs.title' => 'Talen',
    'home.langs.dutch'   => 'Nederlands',
    'home.langs.english' => 'Engels',

    // ── Over mij (about.php) ───────────────────────────────
    'meta.title.about' => 'Over mij — Lucas Askamp',
    'about.hero.title'   => 'Over mij',
    'about.hero.tagline' => 'Ik maak webprojecten die snel laden, netjes zijn opgebouwd en makkelijk uit te breiden.',

    'about.who.title' => 'Wie ben ik',
    'about.who.p1'    => 'Ik ben <strong>Lucas</strong> (19), student <em>Software Development</em> aan het Grafisch Lyceum Rotterdam. Ik hou van duidelijke interfaces, schone code en kleine details die het afmaken.',
    'about.who.p2'    => 'Ik werk vooral met <strong>HTML/CSS/JS</strong> en <strong>PHP</strong>, en ik leer <strong>C#</strong>, <strong>Unity</strong> en <strong>Node.js</strong> erbij.',
    'about.tech.aria'    => 'Technologieën',
    'about.csharp_basic' => 'C# (basis)',
    'about.unity_basic'  => 'Unity (basis)',
    'about.actions.view_projects' => 'Bekijk mijn projecten',
    'about.actions.send_message'  => 'Stuur een bericht',

    'about.info.education.label' => 'Opleiding',
    'about.info.education.value' => 'GLR — Software Development',
    'about.info.location.label'  => 'Locatie',
    'about.info.location.value'  => 'Rozenburg, Rotterdam',
    'about.info.available.label' => 'Beschikbaar',
    'about.info.available.value' => 'Stage en freelance',

    'about.toolbox.title' => 'Toolbox',
    'about.toolbox.aria'  => 'Tools',
    'about.tool.html'  => 'Semantisch, toegankelijk',
    'about.tool.css'   => 'Layout, animaties',
    'about.tool.js'    => 'DOM, fetch, modules',
    'about.tool.php'   => 'PDO, routing, security',
    'about.tool.mysql' => 'schema’s, queries',
    'about.tool.git'   => 'branching, PR’s',

    'about.route.title'   => 'Route',
    'about.route.y_now'   => '2025 — nu',
    'about.route.now'     => 'Stage zoeken',
    'about.route.y_2024'  => '2024',
    'about.route.2024'    => 'Meer leren en mijn code skills verbeteren',
    'about.route.y_2023'  => '2023',
    'about.route.2023'    => 'Start opleiding Software Development (GLR)',
    'about.route.y_dash'  => '—',
    'about.route.dash'    => 'Leren coderen en test',

    // ── Projecten (project.php) ────────────────────────────
    'meta.title.projects' => 'Projecten — Lucas Askamp',
    'project.hero.title'   => 'Projecten',
    'project.hero.tagline' => 'Een selectie van recente werken en experimenten.',
    'project.empty'        => 'Nog geen projecten gepubliceerd.',
    'project.untitled'     => 'Zonder titel',
    'project.view_live'    => 'Bekijk live',

    // ── Contact (contact.php) ──────────────────────────────
    'meta.title.contact' => 'Contact — Lucas Askamp',
    'contact.hero.title'   => 'Contact',
    'contact.hero.tagline' => 'Vertel kort wat je zoekt. Ik reageer meestal dezelfde dag.',
    'contact.form.heading' => 'Stuur een bericht',
    'contact.ok'           => 'Bedankt, je bericht is verstuurd.',
    'contact.hp.label'     => 'Laat leeg',
    'contact.form.name'         => 'Naam',
    'contact.form.name_ph'      => 'Je naam',
    'contact.form.email'        => 'E-mail',
    'contact.form.email_ph'     => 'jij@voorbeeld.nl',
    'contact.form.subject'      => 'Onderwerp',
    'contact.form.subject_ph'   => 'Waar gaat het over?',
    'contact.form.message'      => 'Bericht',
    'contact.form.message_ph'   => 'Schrijf hier je bericht...',
    'contact.form.message_hint' => 'Ik laat snel iets weten.',
    'contact.form.privacy_notice' => 'Door dit formulier te versturen ga je akkoord met de verwerking van je gegevens zoals beschreven in de <a href="privacy.php">privacyverklaring</a>.',
    'contact.form.send'  => 'Verstuur',
    'contact.form.clear' => 'Leegmaken',

    'contact.direct.heading'       => 'Direct contact',
    'contact.direct.email'         => 'E-mail',
    'contact.direct.linkedin_text' => 'Mijn LinkedIn profiel',
    'contact.direct.github_text'   => 'Mijn Github',

    'contact.modal.title' => 'Bericht verstuurd',
    'contact.modal.body'  => 'Bedankt. Je bericht is ontvangen. Ik neem snel contact op.',
    'contact.modal.ok'    => 'Oké',

    'contact.err.input_name'    => 'Vul een geldige naam in (minimaal 2 tekens).',
    'contact.err.input_email'   => 'Vul een geldig e-mailadres in.',
    'contact.err.input_subject' => 'Onderwerp is te kort.',
    'contact.err.input_message' => 'Bericht is te kort (minimaal 10 tekens).',
    'contact.err.csrf'          => 'Beveiligingsfout. Probeer opnieuw.',
    'contact.err.rate'          => 'Je hebt kort geleden al een bericht gestuurd. Probeer later nog eens.',
    'contact.err.input'         => 'Controleer je invoer.',

    // ── Login (login.php) ──────────────────────────────────
    'meta.title.login' => 'Login — Lucas Askamp',
    'login.hero.title'    => 'Inloggen',
    'login.hero.tagline'  => 'Hier is de admin omgeving van deze portfolio.',
    'login.card.subtitle' => 'Meld je aan met je gebruikersnaam en wachtwoord.',
    'login.username'      => 'Gebruikersnaam',
    'login.password'      => 'Wachtwoord',
    'login.submit'        => 'Inloggen',
    'login.clear'         => 'Leegmaken',
    'login.error'         => 'Onjuiste inloggegevens.',

    // ── Privacyverklaring (privacy.php) ────────────────────
    'meta.title.privacy' => 'Privacyverklaring — Lucas Askamp',
    'privacy.hero.title'   => 'Privacyverklaring',
    'privacy.hero.tagline' => 'Hoe ik omga met jouw persoonsgegevens op deze website.',
    'privacy.updated'      => '<strong>Laatst bijgewerkt:</strong> 22 juni 2026',

    'privacy.s1.title' => '1. Wie is verantwoordelijk?',
    'privacy.s1.body'  => 'Deze website is een persoonlijk portfolio van <strong>Lucas Askamp</strong>. Ik ben verantwoordelijk voor de verwerking van persoonsgegevens zoals beschreven in deze verklaring. Vragen over privacy? Mail naar <a href="mailto:contact@lucasaskamp.nl">contact@lucasaskamp.nl</a>.',

    'privacy.s2.title'         => '2. Welke gegevens verzamel ik?',
    'privacy.s2.contact.title' => 'Contactformulier',
    'privacy.s2.contact.body'  => 'Als je het contactformulier gebruikt, verwerk ik:',
    'privacy.s2.contact.li_name'    => 'je <strong>naam</strong>;',
    'privacy.s2.contact.li_email'   => 'je <strong>e-mailadres</strong>;',
    'privacy.s2.contact.li_subject' => 'het <strong>onderwerp</strong> en je <strong>bericht</strong>;',
    'privacy.s2.contact.li_ip'      => 'je <strong>IP-adres</strong> en <strong>browsergegevens</strong> (user-agent);',
    'privacy.s2.contact.li_time'    => 'het <strong>tijdstip</strong> van verzending.',
    'privacy.s2.stats.title' => 'Bezoekstatistieken',
    'privacy.s2.stats.body'  => 'Om te zien hoe de site gebruikt wordt, houd ik beperkte statistieken bij:',
    'privacy.s2.stats.li_page' => 'de <strong>bezochte pagina</strong> en eventuele <strong>verwijzende pagina</strong> (referrer);',
    'privacy.s2.stats.li_sid'  => 'een <strong>willekeurig sessie-ID</strong> (cookie <code>pv_sid</code>) om unieke bezoeken te tellen;',
    'privacy.s2.stats.li_time' => 'het <strong>tijdstip</strong> van het bezoek.',
    'privacy.s2.stats.note'  => 'Deze statistieken gebruik ik niet om jou persoonlijk te identificeren.',
    'privacy.s2.login.title' => 'Inloggen (beheer)',
    'privacy.s2.login.body'  => 'De website heeft een afgeschermd beheergedeelte. Daarvoor gebruik ik een functionele sessie-cookie en log ik beheeracties (zoals in- en uitloggen). Dit is alleen voor mijzelf en niet voor bezoekers.',

    'privacy.s3.title'       => '3. Waarom verwerk ik deze gegevens?',
    'privacy.s3.li_contact'  => '<strong>Contactformulier:</strong> om je vraag of bericht te kunnen beantwoorden (gerechtvaardigd belang — jij neemt zelf contact op).',
    'privacy.s3.li_stats'    => '<strong>Statistieken:</strong> om de website te verbeteren en inzicht te krijgen in het gebruik (gerechtvaardigd belang).',
    'privacy.s3.li_security' => '<strong>Beveiliging:</strong> IP-adres en browsergegevens helpen tegen misbruik en spam.',

    'privacy.s4.title'         => '4. Cookies',
    'privacy.s4.th_cookie'     => 'Cookie',
    'privacy.s4.th_purpose'    => 'Doel',
    'privacy.s4.th_retention'  => 'Bewaartermijn',
    'privacy.s4.pv_sid_purpose'   => 'Statistiek (unieke bezoeken tellen)',
    'privacy.s4.pv_sid_retention' => '180 dagen',
    'privacy.s4.sess_purpose'     => 'Functioneel (inloggen beheer)',
    'privacy.s4.sess_retention'   => 'Sessie (tot je de browser sluit)',
    'privacy.s4.note' => 'Je kunt cookies altijd verwijderen of blokkeren via je browserinstellingen.',

    'privacy.s5.title'      => '5. Hoe lang bewaar ik gegevens?',
    'privacy.s5.li_contact' => '<strong>Contactberichten:</strong> zolang nodig om je vraag af te handelen, daarna verwijder ik ze (uiterlijk binnen 12 maanden).',
    'privacy.s5.li_stats'   => '<strong>Bezoekstatistieken:</strong> in beperkte vorm; de bijbehorende cookie verloopt na 180 dagen.',
    'privacy.s5.li_log'     => '<strong>Beheer-activiteitenlog:</strong> wordt automatisch periodiek geleegd (ongeveer elke 15 dagen).',

    'privacy.s6.title'     => '6. Delen met derden',
    'privacy.s6.body'      => 'Ik verkoop je gegevens niet. Ik deel ze alleen met partijen die nodig zijn om de website te laten werken:',
    'privacy.s6.li_host'   => 'mijn <strong>hostingprovider</strong> (waar de website en database draaien), als verwerker;',
    'privacy.s6.li_google' => '<strong>Google (Gmail)</strong>, omdat berichten uit het contactformulier in mijn mailbox binnenkomen.',

    'privacy.s7.title' => '7. Beveiliging',
    'privacy.s7.body'  => 'Ik neem passende maatregelen om je gegevens te beschermen: wachtwoorden worden versleuteld opgeslagen (hashing), het verkeer loopt via HTTPS, formulieren zijn beveiligd tegen misbruik (CSRF) en de database wordt benaderd via veilige (prepared) queries.',

    'privacy.s8.title'     => '8. Jouw rechten',
    'privacy.s8.body'      => 'Je hebt het recht om:',
    'privacy.s8.li_access'   => 'je gegevens <strong>in te zien</strong>;',
    'privacy.s8.li_correct'  => 'gegevens te laten <strong>corrigeren</strong> of <strong>verwijderen</strong>;',
    'privacy.s8.li_object'   => '<strong>bezwaar</strong> te maken tegen de verwerking;',
    'privacy.s8.li_transfer' => 'je gegevens te laten <strong>overdragen</strong>.',
    'privacy.s8.contact'   => 'Stuur hiervoor een mail naar <a href="mailto:contact@lucasaskamp.nl">contact@lucasaskamp.nl</a>. Ik reageer binnen 30 dagen.',

    'privacy.s9.title' => '9. Klacht indienen',
    'privacy.s9.body'  => 'Ben je het niet eens met hoe ik met je gegevens omga? Dan kun je een klacht indienen bij de <strong>Autoriteit Persoonsgegevens</strong> via <a href="https://www.autoriteitpersoonsgegevens.nl" target="_blank" rel="noopener">autoriteitpersoonsgegevens.nl</a>.',

    'privacy.s10.title' => '10. Wijzigingen',
    'privacy.s10.body'  => 'Deze privacyverklaring kan worden aangepast. De meest recente versie staat altijd op deze pagina, met de datum bovenaan.',

    // ── Bevestigingsmail naar bezoeker (send_mail.php) ─────
    'email.reply.subject' => 'Bedankt voor je bericht - Lucas Askamp',
    'email.reply.body'    => "Hoi :name,\n\nBedankt voor je bericht! Ik neem zo snel mogelijk contact met je op.\n\nBekijk in de tussentijd gerust mijn werk:\n- Portfolio: :siteUrl\n- CV: zie de bijlage (of download: :cvUrl)\n\nMet vriendelijke groet,\nLucas Askamp\ncontact@lucasaskamp.nl\n",
];
