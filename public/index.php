<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/i18n.php';
?>
<!doctype html>
<html lang="<?= e(lang_current()) ?>" data-theme="dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= t('meta.title.home') ?></title>
  <link rel="stylesheet" href="assets/css/site.css" />
</head>
<body>

  <!-- Header / Navigatie -->
  <header class="site-header">
    <div class="container header-inner">
      <a href="#home" class="brand" aria-label="<?= e(t('brand.aria')) ?>">
        <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2l7 4v12l-7 4-7-4V6l7-4zm0 2.3L7 6.8v10.4l5 2.5 5-2.5V6.8l-5-2.5z"/></svg>
        <span>Lucas Askamp</span>
      </a>

      <nav class="nav" aria-label="<?= e(t('nav.aria')) ?>">
        <a href="#home" class="nav__link is-active"><?= t('nav.home') ?></a>
        <a href="pages/about.php" class="nav__link"><?= t('nav.about') ?></a>
        <a href="pages/project.php" class="nav__link"><?= t('nav.projects') ?></a>
        <a href="pages/contact.php" class="nav__link"><?= t('nav.contact') ?></a>
        <a href="pages/login.php" class="nav__link"><?= t('nav.login') ?></a>
        <span class="nav__indicator" aria-hidden="true"></span>
      </nav>

      <div class="lang-switch" role="group" aria-label="<?= e(t('lang.switch_aria')) ?>">
        <a href="<?= e(lang_switch_url('nl')) ?>" hreflang="nl" class="<?= lang_current() === 'nl' ? 'is-active' : '' ?>">NL</a>
        <a href="<?= e(lang_switch_url('en')) ?>" hreflang="en" class="<?= lang_current() === 'en' ? 'is-active' : '' ?>">EN</a>
      </div>
    </div>
  </header>

 <!-- Hero -->
  <section id="home" class="hero">
  <!-- Achtergrond-animatie: nu full-width -->
  <div class="bg-fx" id="bgFx" aria-hidden="true">
    <canvas id="fxCanvas"></canvas>
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
  </div>

  <!-- Content blijft in de container -->
  <div class="container hero-inner">
    <div class="hero-copy">
      <h1><?= t('home.hero.title') ?></h1>
      <p><?= t('home.hero.tagline') ?></p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="pages/project.php"><?= t('home.hero.view_projects') ?></a>
        <a class="btn" href="pages/contact.php"><?= t('home.hero.contact') ?></a>
      </div>
    </div>
  </div>
</section>

  <!-- Korte intro -->
  <section class="section">
    <div class="container grid two">
      <article class="card">
        <h3><?= t('home.intro.who.title') ?></h3>
        <p>
          <?= t('home.intro.who.body') ?>
        </p>
        <div class="actions" style="margin-top:10px;">
          <a class="btn btn-primary" href="Cv-Lucas_Askamp(2026).pdf" target="_blank" rel="noopener"><?= t('home.intro.download_cv') ?></a>
          <a class="btn" href="pages/contact.php"><?= t('home.intro.plan_meeting') ?></a>
        </div>
      </article>

      <article class="card">
        <h3><?= t('home.intro.what.title') ?></h3>
        <p>
          <?= t('home.intro.what.body') ?>
        </p>
      </article>
    </div>
  </section>

  <!-- Highlights -->
  <section class="section">
    <div class="container grid three">
      <article class="card">
        <h3><?= t('home.highlights.frontend.title') ?></h3>
        <p><?= t('home.highlights.frontend.body') ?></p>
      </article>
      <article class="card">
        <h3><?= t('home.highlights.performance.title') ?></h3>
        <p><?= t('home.highlights.performance.body') ?></p>
      </article>
      <article class="card">
        <h3><?= t('home.highlights.manage.title') ?></h3>
        <p><?= t('home.highlights.manage.body') ?></p>
      </article>
    </div>
  </section>

  <!-- Skills -->
  <section class="section">
    <div class="container grid two">
      <article class="card">
        <h3><?= t('home.skills.langs.title') ?></h3>
        <ul class="chip-list">
          <li class="chip">HTML</li>
          <li class="chip">CSS</li>
          <li class="chip">JavaScript</li>
          <li class="chip">PHP</li>
          <li class="chip"><?= t('home.skills.csharp_basic') ?></li>
          <li class="chip"><?= t('home.skills.database') ?></li>
        </ul>
      </article>
      <article class="card">
        <h3><?= t('home.skills.tools.title') ?></h3>
        <ul class="chip-list">
          <li class="chip">PHPStorm</li>
          <li class="chip">phpMyAdmin</li>
          <li class="chip">Adobe Creative Cloud</li>
          <li class="chip">Unity</li>
          <li class="chip">Unreal Engine</li>
        </ul>
      </article>
    </div>
  </section>

  <!-- Ervaring -->
  <section class="section">
    <div class="container grid two">
      <article class="card">
        <h3><?= t('home.exp.mcd.title') ?></h3>
        <p class="muted"><?= t('home.exp.mcd.period') ?></p>
        <p><?= t('home.exp.mcd.body') ?></p>
      </article>
      <article class="card">
        <h3><?= t('home.exp.ah.title') ?></h3>
        <p class="muted"><?= t('home.exp.ah.period') ?></p>
        <p><?= t('home.exp.ah.body') ?></p>
      </article>
    </div>
  </section>

  <!-- Opleiding & Talen -->
  <section class="section">
    <div class="container grid two">
      <article class="card">
        <h3><?= t('home.edu.title') ?></h3>
        <p><?= t('home.edu.body') ?></p>
      </article>
      <article class="card">
        <h3><?= t('home.langs.title') ?></h3>
        <ul class="chip-list">
          <li class="chip"><?= t('home.langs.dutch') ?></li>
          <li class="chip"><?= t('home.langs.english') ?></li>
        </ul>
      </article>
    </div>
  </section>

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
        <li><a href="pages/contact.php"><?= t('nav.contact') ?></a></li>
        <li><a href="pages/privacy.php"><?= t('footer.privacy') ?></a></li>
      </ul>
    </div>
  </footer>

  <script src="assets/js/analytics.js" defer></script>
  <script src="assets/js/site.js"></script>
</body>
</html>
