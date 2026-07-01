<?php
declare(strict_types=1);

/**
 * English strings for the public site. This is also the fallback language:
 * any key missing in another language falls back to the value here.
 * Values are echoed raw into the HTML, so intentional markup is allowed.
 */

return [
    // ── Language switch ─────────────────────────────────────
    'lang.switch_aria' => 'Language',

    // ── Navigation / brand ─────────────────────────────────
    'brand.aria'   => 'Go to home',
    'nav.aria'     => 'Main',
    'nav.home'     => 'Home',
    'nav.about'    => 'About',
    'nav.projects' => 'Projects',
    'nav.contact'  => 'Contact',
    'nav.login'    => 'Login',

    // ── Footer ─────────────────────────────────────────────
    'footer.rights'  => 'All rights reserved',
    'footer.privacy' => 'Privacy',

    // ── Home (index.php) ───────────────────────────────────
    'meta.title.home'          => 'Portfolio — Lucas Askamp',
    'home.hero.title'          => 'Portfolio of Lucas Askamp',
    'home.hero.tagline'        => 'Web developer. Focused on websites with clean code and clear UX.',
    'home.hero.view_projects'  => 'View projects',
    'home.hero.contact'        => 'Get in touch',

    'home.intro.who.title'     => 'Who I am',
    'home.intro.who.body'      => 'Second-year Software Development student at Grafisch Lyceum Rotterdam (MBO-4). I got into tech and code early on and I am looking for an internship to grow my skills further.',
    'home.intro.download_cv'   => 'Download CV (PDF)',
    'home.intro.plan_meeting'  => 'Schedule an intro',
    'home.intro.what.title'    => 'What I do',
    'home.intro.what.body'     => 'I build dynamic, responsive websites with HTML, CSS, JavaScript and PHP. On top of that I am diving into C# and game development (Unity/Unreal).',

    'home.highlights.frontend.title'    => 'Frontend',
    'home.highlights.frontend.body'     => 'Clean mark-up, modern CSS and clear interactions.',
    'home.highlights.performance.title' => 'Performance',
    'home.highlights.performance.body'  => 'Lightweight pages, fast load times and readable code.',
    'home.highlights.manage.title'      => 'Management',
    'home.highlights.manage.body'       => 'An admin hub in the same style for easy maintenance.',

    'home.skills.langs.title'  => 'Programming languages',
    'home.skills.csharp_basic' => 'C# (basic)',
    'home.skills.database'     => 'Database',
    'home.skills.tools.title'  => 'Software & tools',

    'home.exp.mcd.title'  => 'McDonald’s — Host/Supervisor',
    'home.exp.mcd.period' => 'Feb 2024 – present',
    'home.exp.mcd.body'   => 'Named “Crew Member of the Month” within eight months, then promoted to supervisor. Responsible for the dining area and leading the team.',
    'home.exp.ah.title'   => 'Albert Heijn — Shelf stocker',
    'home.exp.ah.period'  => 'Aug 2022 – Feb 2023',
    'home.exp.ah.body'    => 'Stocking shelves and store support during evening hours, several days a week.',

    'home.edu.title' => 'Education',
    'home.edu.body'  => '<strong>Grafisch Lyceum Rotterdam</strong> — ICT & Media, MBO-4 (3-year program).',
    'home.langs.title' => 'Languages',
    'home.langs.dutch'   => 'Dutch',
    'home.langs.english' => 'English',

    // ── About (about.php) ──────────────────────────────────
    'meta.title.about' => 'About — Lucas Askamp',
    'about.hero.title'   => 'About me',
    'about.hero.tagline' => 'I build web projects that load fast, are cleanly structured and easy to extend.',

    'about.who.title' => 'Who am I',
    'about.who.p1'    => 'I am <strong>Lucas</strong> (19), a <em>Software Development</em> student at Grafisch Lyceum Rotterdam. I love clear interfaces, clean code and the small details that finish it off.',
    'about.who.p2'    => 'I mostly work with <strong>HTML/CSS/JS</strong> and <strong>PHP</strong>, and I am picking up <strong>C#</strong>, <strong>Unity</strong> and <strong>Node.js</strong> too.',
    'about.tech.aria'    => 'Technologies',
    'about.csharp_basic' => 'C# (basic)',
    'about.unity_basic'  => 'Unity (basic)',
    'about.actions.view_projects' => 'View my projects',
    'about.actions.send_message'  => 'Send a message',

    'about.info.education.label' => 'Education',
    'about.info.education.value' => 'GLR — Software Development',
    'about.info.location.label'  => 'Location',
    'about.info.location.value'  => 'Rozenburg, Rotterdam',
    'about.info.available.label' => 'Available',
    'about.info.available.value' => 'Internship and freelance',

    'about.toolbox.title' => 'Toolbox',
    'about.toolbox.aria'  => 'Tools',
    'about.tool.html'  => 'Semantic, accessible',
    'about.tool.css'   => 'Layout, animations',
    'about.tool.js'    => 'DOM, fetch, modules',
    'about.tool.php'   => 'PDO, routing, security',
    'about.tool.mysql' => 'schemas, queries',
    'about.tool.git'   => 'branching, PRs',

    'about.route.title'   => 'Journey',
    'about.route.y_now'   => '2025 — now',
    'about.route.now'     => 'Looking for an internship',
    'about.route.y_2024'  => '2024',
    'about.route.2024'    => 'Learning more and improving my coding skills',
    'about.route.y_2023'  => '2023',
    'about.route.2023'    => 'Started Software Development studies (GLR)',
    'about.route.y_dash'  => '—',
    'about.route.dash'    => 'Learning to code and testing',

    // ── Projects (project.php) ─────────────────────────────
    'meta.title.projects' => 'Projects — Lucas Askamp',
    'project.hero.title'   => 'Projects',
    'project.hero.tagline' => 'A selection of recent work and experiments.',
    'project.empty'        => 'No projects published yet.',
    'project.untitled'     => 'Untitled',
    'project.view_live'    => 'View live',

    // ── Contact (contact.php) ──────────────────────────────
    'meta.title.contact' => 'Contact — Lucas Askamp',
    'contact.hero.title'   => 'Contact',
    'contact.hero.tagline' => 'Tell me briefly what you are looking for. I usually reply the same day.',
    'contact.form.heading' => 'Send a message',
    'contact.ok'           => 'Thanks, your message has been sent.',
    'contact.hp.label'     => 'Leave empty',
    'contact.form.name'         => 'Name',
    'contact.form.name_ph'      => 'Your name',
    'contact.form.email'        => 'Email',
    'contact.form.email_ph'     => 'you@example.com',
    'contact.form.subject'      => 'Subject',
    'contact.form.subject_ph'   => 'What is it about?',
    'contact.form.message'      => 'Message',
    'contact.form.message_ph'   => 'Write your message here...',
    'contact.form.message_hint' => 'I will get back to you soon.',
    'contact.form.privacy_notice' => 'By submitting this form you agree to the processing of your data as described in the <a href="privacy.php">privacy statement</a>.',
    'contact.form.send'  => 'Send',
    'contact.form.clear' => 'Clear',

    'contact.direct.heading'       => 'Direct contact',
    'contact.direct.email'         => 'Email',
    'contact.direct.linkedin_text' => 'My LinkedIn profile',
    'contact.direct.github_text'   => 'My GitHub',

    'contact.modal.title' => 'Message sent',
    'contact.modal.body'  => 'Thanks. Your message has been received. I will be in touch soon.',
    'contact.modal.ok'    => 'OK',

    'contact.err.input_name'    => 'Please enter a valid name (at least 2 characters).',
    'contact.err.input_email'   => 'Please enter a valid email address.',
    'contact.err.input_subject' => 'Subject is too short.',
    'contact.err.input_message' => 'Message is too short (at least 10 characters).',
    'contact.err.csrf'          => 'Security error. Please try again.',
    'contact.err.rate'          => 'You recently sent a message. Please try again later.',
    'contact.err.input'         => 'Please check your input.',

    // ── Login (login.php) ──────────────────────────────────
    'meta.title.login' => 'Login — Lucas Askamp',
    'login.hero.title'    => 'Log in',
    'login.hero.tagline'  => 'This is the admin area of this portfolio.',
    'login.card.subtitle' => 'Sign in with your username and password.',
    'login.username'      => 'Username',
    'login.password'      => 'Password',
    'login.submit'        => 'Log in',
    'login.clear'         => 'Clear',
    'login.error'         => 'Incorrect login details.',

    // ── Privacy statement (privacy.php) ────────────────────
    'meta.title.privacy' => 'Privacy statement — Lucas Askamp',
    'privacy.hero.title'   => 'Privacy statement',
    'privacy.hero.tagline' => 'How I handle your personal data on this website.',
    'privacy.updated'      => '<strong>Last updated:</strong> 22 June 2026',

    'privacy.s1.title' => '1. Who is responsible?',
    'privacy.s1.body'  => 'This website is a personal portfolio of <strong>Lucas Askamp</strong>. I am responsible for the processing of personal data as described in this statement. Questions about privacy? Email <a href="mailto:contact@lucasaskamp.nl">contact@lucasaskamp.nl</a>.',

    'privacy.s2.title'         => '2. What data do I collect?',
    'privacy.s2.contact.title' => 'Contact form',
    'privacy.s2.contact.body'  => 'If you use the contact form, I process:',
    'privacy.s2.contact.li_name'    => 'your <strong>name</strong>;',
    'privacy.s2.contact.li_email'   => 'your <strong>email address</strong>;',
    'privacy.s2.contact.li_subject' => 'the <strong>subject</strong> and your <strong>message</strong>;',
    'privacy.s2.contact.li_ip'      => 'your <strong>IP address</strong> and <strong>browser data</strong> (user agent);',
    'privacy.s2.contact.li_time'    => 'the <strong>time</strong> of submission.',
    'privacy.s2.stats.title' => 'Visitor statistics',
    'privacy.s2.stats.body'  => 'To see how the site is used, I keep limited statistics:',
    'privacy.s2.stats.li_page' => 'the <strong>page visited</strong> and any <strong>referring page</strong> (referrer);',
    'privacy.s2.stats.li_sid'  => 'a <strong>random session ID</strong> (cookie <code>pv_sid</code>) to count unique visits;',
    'privacy.s2.stats.li_time' => 'the <strong>time</strong> of the visit.',
    'privacy.s2.stats.note'  => 'I do not use these statistics to identify you personally.',
    'privacy.s2.login.title' => 'Login (admin)',
    'privacy.s2.login.body'  => 'The website has a protected admin section. For it I use a functional session cookie and I log admin actions (such as logging in and out). This is for me only and not for visitors.',

    'privacy.s3.title'       => '3. Why do I process this data?',
    'privacy.s3.li_contact'  => '<strong>Contact form:</strong> to be able to answer your question or message (legitimate interest — you reach out yourself).',
    'privacy.s3.li_stats'    => '<strong>Statistics:</strong> to improve the website and understand how it is used (legitimate interest).',
    'privacy.s3.li_security' => '<strong>Security:</strong> IP address and browser data help against abuse and spam.',

    'privacy.s4.title'         => '4. Cookies',
    'privacy.s4.th_cookie'     => 'Cookie',
    'privacy.s4.th_purpose'    => 'Purpose',
    'privacy.s4.th_retention'  => 'Retention',
    'privacy.s4.pv_sid_purpose'   => 'Statistics (counting unique visits)',
    'privacy.s4.pv_sid_retention' => '180 days',
    'privacy.s4.sess_purpose'     => 'Functional (admin login)',
    'privacy.s4.sess_retention'   => 'Session (until you close the browser)',
    'privacy.s4.note' => 'You can always delete or block cookies via your browser settings.',

    'privacy.s5.title'      => '5. How long do I keep data?',
    'privacy.s5.li_contact' => '<strong>Contact messages:</strong> as long as needed to handle your question, after which I delete them (within 12 months at the latest).',
    'privacy.s5.li_stats'   => '<strong>Visitor statistics:</strong> in limited form; the associated cookie expires after 180 days.',
    'privacy.s5.li_log'     => '<strong>Admin activity log:</strong> is automatically cleared periodically (roughly every 15 days).',

    'privacy.s6.title'     => '6. Sharing with third parties',
    'privacy.s6.body'      => 'I do not sell your data. I only share it with parties needed to make the website work:',
    'privacy.s6.li_host'   => 'my <strong>hosting provider</strong> (where the website and database run), as a processor;',
    'privacy.s6.li_google' => '<strong>Google (Gmail)</strong>, because messages from the contact form arrive in my mailbox.',

    'privacy.s7.title' => '7. Security',
    'privacy.s7.body'  => 'I take appropriate measures to protect your data: passwords are stored encrypted (hashing), traffic runs over HTTPS, forms are protected against abuse (CSRF) and the database is accessed via secure (prepared) queries.',

    'privacy.s8.title'     => '8. Your rights',
    'privacy.s8.body'      => 'You have the right to:',
    'privacy.s8.li_access'   => '<strong>access</strong> your data;',
    'privacy.s8.li_correct'  => 'have data <strong>corrected</strong> or <strong>deleted</strong>;',
    'privacy.s8.li_object'   => '<strong>object</strong> to the processing;',
    'privacy.s8.li_transfer' => 'have your data <strong>transferred</strong>.',
    'privacy.s8.contact'   => 'To do so, send an email to <a href="mailto:contact@lucasaskamp.nl">contact@lucasaskamp.nl</a>. I respond within 30 days.',

    'privacy.s9.title' => '9. Filing a complaint',
    'privacy.s9.body'  => 'Do you disagree with how I handle your data? Then you can file a complaint with the <strong>Dutch Data Protection Authority</strong> via <a href="https://www.autoriteitpersoonsgegevens.nl" target="_blank" rel="noopener">autoriteitpersoonsgegevens.nl</a>.',

    'privacy.s10.title' => '10. Changes',
    'privacy.s10.body'  => 'This privacy statement may be updated. The most recent version is always on this page, with the date at the top.',

    // ── Confirmation email to visitor (send_mail.php) ──────
    'email.reply.subject' => 'Thanks for your message - Lucas Askamp',
    'email.reply.body'    => "Hi :name,\n\nThanks for your message! I will get back to you as soon as possible.\n\nIn the meantime, feel free to take a look at my work:\n- Portfolio: :siteUrl\n- CV: see the attachment (or download: :cvUrl)\n\nKind regards,\nLucas Askamp\ncontact@lucasaskamp.nl\n",
];
