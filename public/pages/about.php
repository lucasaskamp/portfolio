<?php
declare(strict_types=1);
require_once __DIR__ . '/../../src/i18n.php';
?>
<!doctype html>
<html lang="<?= e(lang_current()) ?>" data-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= t('meta.title.about') ?></title>
    <link rel="stylesheet" href="../assets/css/site.css" />
</head>
<body>

<!-- Header / Navigatie -->
<header class="site-header">
    <div class="container header-inner">
        <a href="../index.php" class="brand" aria-label="<?= e(t('brand.aria')) ?>">
            <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="currentColor" d="M12 2l7 4v12l-7 4-7-4V6l7-4z"/>
            </svg>
            <span>Lucas Askamp</span>
        </a>

        <nav class="nav" aria-label="<?= e(t('nav.aria')) ?>">
            <a href="../index.php" class="nav__link"><?= t('nav.home') ?></a>
            <a href="#" class="nav__link is-active"><?= t('nav.about') ?></a>
            <a href="project.php" class="nav__link"><?= t('nav.projects') ?></a>
            <a href="contact.php" class="nav__link"><?= t('nav.contact') ?></a>
            <a href="login.php" class="nav__link"><?= t('nav.login') ?></a>
            <span class="nav__indicator" aria-hidden="true"></span>
        </nav>

        <div class="lang-switch" role="group" aria-label="<?= e(t('lang.switch_aria')) ?>">
            <a href="<?= e(lang_switch_url('nl')) ?>" hreflang="nl" class="<?= lang_current() === 'nl' ? 'is-active' : '' ?>">NL</a>
            <a href="<?= e(lang_switch_url('en')) ?>" hreflang="en" class="<?= lang_current() === 'en' ? 'is-active' : '' ?>">EN</a>
        </div>
    </div>
</header>

<!-- Hero -->
<section class="hero hero--sub">
    <div class="container hero-inner">
        <div class="hero-copy">
            <h1 class="reveal"><?= t('about.hero.title') ?></h1>
            <p class="reveal" data-reveal-delay="80">
                <?= t('about.hero.tagline') ?>
            </p>
        </div>
    </div>
</section>

<!-- Inhoud -->
<main class="section">
    <div class="container about-wrap">

        <!-- Rij 1: codekaart + foto -->
        <div class="about-grid">
            <article class="codecard reveal" aria-label="Profiel als code">
                <div class="codecard__bar">
                    <span class="dot dot--r" aria-hidden="true"></span>
                    <span class="dot dot--y" aria-hidden="true"></span>
                    <span class="dot dot--g" aria-hidden="true"></span>
                </div>
                <pre class="code"><span class="c">// Kort wie, wat, waar — in code</span>
<span class="k">const</span> lucas <span class="p">=</span> <span class="p">{</span>
  name<span class="p">:</span> <span class="s">'Lucas Askamp'</span><span class="p">,</span>
  role<span class="p">:</span> <span class="s">'Junior Full-Stack Developer'</span><span class="p">,</span>
  location<span class="p">:</span> <span class="s">'Rozenburg (Rotterdam), NL'</span><span class="p">,</span>
  stack<span class="p">:</span> <span class="p">[</span><span class="s">'HTML'</span><span class="p">,</span> <span class="s">'CSS'</span><span class="p">,</span> <span class="s">'JavaScript'</span><span class="p">,</span> <span class="s">'PHP'</span><span class="p">]</span><span class="p">,</span>
  learning<span class="p">:</span> <span class="p">[</span><span class="s">'C#'</span><span class="p">,</span> <span class="s">'Unity'</span><span class="p">,</span> <span class="s">'Node.js'</span><span class="p">]</span><span class="p">,</span>
  focus<span class="p">:</span> <span class="s">'snelle, toegankelijke, onderhoudbare sites'</span><span class="p">,</span>
  values<span class="p">:</span> <span class="p">[</span><span class="s">'simpel'</span><span class="p">,</span> <span class="s">'duidelijk'</span><span class="p">,</span> <span class="s">'netjes'</span><span class="p">,</span> <span class="s">'snel'</span><span class="p">]</span><span class="p">,</span>
  contact<span class="p">:</span> <span class="p">{</span>
    email<span class="p">:</span> <span class="s">'contact@lucasaskamp.nl'</span><span class="p">,</span>
    github<span class="p">:</span> <span class="s">'github.com/100536'</span><span class="p">,</span>
    linkedin<span class="p">:</span> <span class="s">'linkedin.com/in/lucas-askamp-87031a2b7'</span>
  <span class="p">}</span><span class="p">,</span>
  toolbox<span class="p">:</span> <span class="p">{</span>
    frontend<span class="p">:</span> <span class="p">[</span><span class="s">'Accessibility'</span><span class="p">,</span> <span class="s">'Animations'</span><span class="p">,</span> <span class="s">'DOM'</span><span class="p">,</span> <span class="s">'Fetch'</span><span class="p">]</span><span class="p">,</span>
    backend<span class="p">:</span> <span class="p">[</span><span class="s">'PHP'</span><span class="p">,</span> <span class="s">'PDO'</span><span class="p">,</span> <span class="s">'MySQL'</span><span class="p">,</span> <span class="s">'Sessions'</span><span class="p">]</span><span class="p">,</span>
    tooling<span class="p">:</span> <span class="p">[</span><span class="s">'Git'</span><span class="p">,</span> <span class="s">'npm'</span><span class="p">,</span> <span class="s">'Vite'</span><span class="p">]</span>
  <span class="p">}</span><span class="p">,</span>
  now<span class="p">:</span> <span class="p">{</span>
    studying<span class="p">:</span> <span class="s">'GLR — Software Development (afgerond)'</span><span class="p">,</span>
    available<span class="p">:</span> <span class="p">[</span><span class="s">'baan'</span><span class="p">,</span> <span class="s">'freelance'</span><span class="p">]</span>
  <span class="p">}</span>
<span class="p">}</span><span class="p">;</span>

<span class="k">function</span> build<span class="p">(</span>project<span class="p">)</span> <span class="p">{</span>
  <span class="k">return</span> <span class="p">{</span>
    cleanCode<span class="p">:</span> <span class="k">true</span><span class="p">,</span>
    performance<span class="p">:</span> <span class="s">'fast'</span><span class="p">,</span>
    responsive<span class="p">:</span> <span class="k">true</span><span class="p">,</span>
    a11y<span class="p">:</span> <span class="s">'WCAG minded'</span>
  <span class="p">}</span><span class="p">;</span>
<span class="p">}</span>

<span class="k">const</span> goals2025 <span class="p">=</span> <span class="p">[</span>
  <span class="s">'meer eigen projecten'</span><span class="p">,</span>
  <span class="s">'betere animaties'</span><span class="p">,</span>
  <span class="s">'dieper in PHP/MySQL'</span><span class="p">,</span>
  <span class="s">'Unity prototype afronden'</span>
<span class="p">]</span><span class="p">;</span></pre>
            </article>

            <aside class="about-photo reveal" data-reveal-delay="120">
                <figure>
                    <img src="../assets/img/foto.jpeg" alt="Portret van Lucas Askamp" loading="lazy" />
                    <figcaption class="muted">Lucas Askamp</figcaption>
                </figure>
            </aside>
        </div>

        <!-- Rij 2: tekst + skills + info -->
        <article class="card reveal">
            <h3><?= t('about.who.title') ?></h3>
            <p>
                <?= t('about.who.p1') ?>
            </p>
            <p>
                <?= t('about.who.p2') ?>
            </p>

            <ul class="chip-list" aria-label="<?= e(t('about.tech.aria')) ?>">
                <li class="chip">HTML</li>
                <li class="chip">CSS</li>
                <li class="chip">JavaScript</li>
                <li class="chip">TypeScript</li>
                <li class="chip">PHP</li>
                <li class="chip">C#</li>
                <li class="chip">Blazor</li>
                <li class="chip">SQL Server</li>
            </ul>

            <div class="about-actions">
                <a class="btn btn-primary" href="project.php"><?= t('about.actions.view_projects') ?></a>
                <a class="btn" href="contact.php"><?= t('about.actions.send_message') ?></a>
            </div>

            <dl class="info-list">
                <div><dt><?= t('about.info.education.label') ?></dt><dd><?= t('about.info.education.value') ?></dd></div>
                <div><dt><?= t('about.info.location.label') ?></dt><dd><?= t('about.info.location.value') ?></dd></div>
                <div><dt><?= t('about.info.available.label') ?></dt><dd><?= t('about.info.available.value') ?></dd></div>
            </dl>
        </article>

        <!-- Rij 3: terminal + toolbox -->
        <div class="about-split">
            <!-- Langzamere typewriter terminal met extra regels -->
            <article class="terminal terminal--card reveal typewriter" aria-label="Mini-terminal">
                <div class="term-line" data-cmd="git status"></div>
                <div class="term-line" data-text="On branch main
Your branch is up to date with 'origin/main'.

nothing to commit, working tree clean"></div>

                <div class="term-line" data-cmd="npm ci"></div>
                <div class="term-line term-ok" data-text="added 0 packages, audited 0 packages"></div>

                <div class="term-line" data-cmd="npm run build"></div>
                <div class="term-line term-ok" data-text="✔ compiled successfully in 612ms"></div>

                <div class="term-line" data-cmd="php -S localhost:8000"></div>
                <div class="term-line" data-text="PHP 8.x Development Server (http://localhost:8000) started"></div>
            </article>

            <!-- Toolbox blijft hetzelfde -->
            <article class="card toolbox-card reveal" data-reveal-delay="80">
                <h3><?= t('about.toolbox.title') ?></h3>
                <div class="tool-grid" aria-label="<?= e(t('about.toolbox.aria')) ?>">
                    <div class="tool"><strong>HTML</strong><small><?= t('about.tool.html') ?></small></div>
                    <div class="tool"><strong>CSS</strong><small><?= t('about.tool.css') ?></small></div>
                    <div class="tool"><strong>JavaScript</strong><small><?= t('about.tool.js') ?></small></div>
                    <div class="tool"><strong>PHP</strong><small><?= t('about.tool.php') ?></small></div>
                    <div class="tool"><strong>MySQL</strong><small><?= t('about.tool.mysql') ?></small></div>
                    <div class="tool"><strong>Git</strong><small><?= t('about.tool.git') ?></small></div>
                </div>
            </article>
        </div>

        <!-- Rij 4: tijdlijn -->
        <article class="card reveal">
            <h3><?= t('about.route.title') ?></h3>
            <ul class="timeline">
                <li><time><?= t('about.route.y_now') ?></time><?= t('about.route.now') ?></li>
                <li><time><?= t('about.route.y_2024') ?></time><?= t('about.route.2024') ?></li>
                <li><time><?= t('about.route.y_2023') ?></time><?= t('about.route.2023') ?></li>
                <li><time><?= t('about.route.y_dash') ?></time><?= t('about.route.dash') ?></li>
            </ul>
        </article>
    </div>
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <span class="avatar">LA</span>
            <div>
                <strong>Lucas Askamp</strong>
                <div class="muted">© <span id="year"></span> <?= t('footer.rights') ?></div>
            </div>
        </div>

        <ul class="footer-menu">
            <li><a href="https://github.com/100536" target="_blank" rel="noopener">GitHub</a></li>
            <li><a href="https://www.linkedin.com/in/lucas-askamp-87031a2b7/" target="_blank" rel="noopener">LinkedIn</a></li>
            <li><a href="contact.php"><?= t('nav.contact') ?></a></li>
            <li><a href="privacy.php"><?= t('footer.privacy') ?></a></li>
        </ul>
    </div>
</footer>

<script src="../assets/js/analytics.js" defer></script>
<script src="../assets/js/site.js"></script>
<script src="../assets/js/about.js" defer></script>
</body>
</html>
