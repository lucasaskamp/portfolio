<?php
declare(strict_types=1);
require_once __DIR__ . '/../../src/i18n.php';
?>
<!doctype html>
<html lang="<?= e(lang_current()) ?>" data-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= t('meta.title.privacy') ?></title>
    <meta name="robots" content="all" />
    <link rel="stylesheet" href="../assets/css/site.css" />
</head>
<body>

<!-- Header / Navigatie -->
<header class="site-header">
    <div class="container header-inner">
        <a href="../index.php" class="brand" aria-label="<?= e(t('brand.aria')) ?>">
            <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2l7 4v12l-7 4-7-4V6l7-4zm0 2.3L7 6.8v10.4l5 2.5 5-2.5V6.8l-5-2.5z"/></svg>
            <span>Lucas Askamp</span>
        </a>

        <nav class="nav" aria-label="<?= e(t('nav.aria')) ?>">
            <a href="../index.php#home" class="nav__link"><?= t('nav.home') ?></a>
            <a href="about.php" class="nav__link"><?= t('nav.about') ?></a>
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

<!-- Sub-hero -->
<section class="hero hero--sub">
    <div class="container hero-inner">
        <div class="hero-copy">
            <h1><?= t('privacy.hero.title') ?></h1>
            <p><?= t('privacy.hero.tagline') ?></p>
        </div>
    </div>
</section>

<!-- Inhoud -->
<main class="section">
    <div class="container" style="max-width:820px">
        <article class="card">
            <div class="card__body">
                <p class="muted"><?= t('privacy.updated') ?></p>

                <h2><?= t('privacy.s1.title') ?></h2>
                <p><?= t('privacy.s1.body') ?></p>

                <h2><?= t('privacy.s2.title') ?></h2>
                <h3><?= t('privacy.s2.contact.title') ?></h3>
                <p><?= t('privacy.s2.contact.body') ?></p>
                <ul>
                    <li><?= t('privacy.s2.contact.li_name') ?></li>
                    <li><?= t('privacy.s2.contact.li_email') ?></li>
                    <li><?= t('privacy.s2.contact.li_subject') ?></li>
                    <li><?= t('privacy.s2.contact.li_ip') ?></li>
                    <li><?= t('privacy.s2.contact.li_time') ?></li>
                </ul>

                <h3><?= t('privacy.s2.stats.title') ?></h3>
                <p><?= t('privacy.s2.stats.body') ?></p>
                <ul>
                    <li><?= t('privacy.s2.stats.li_page') ?></li>
                    <li><?= t('privacy.s2.stats.li_sid') ?></li>
                    <li><?= t('privacy.s2.stats.li_time') ?></li>
                </ul>
                <p><?= t('privacy.s2.stats.note') ?></p>

                <h3><?= t('privacy.s2.login.title') ?></h3>
                <p><?= t('privacy.s2.login.body') ?></p>

                <h2><?= t('privacy.s3.title') ?></h2>
                <ul>
                    <li><?= t('privacy.s3.li_contact') ?></li>
                    <li><?= t('privacy.s3.li_stats') ?></li>
                    <li><?= t('privacy.s3.li_security') ?></li>
                </ul>

                <h2><?= t('privacy.s4.title') ?></h2>
                <table class="table">
                    <thead><tr><th><?= t('privacy.s4.th_cookie') ?></th><th><?= t('privacy.s4.th_purpose') ?></th><th><?= t('privacy.s4.th_retention') ?></th></tr></thead>
                    <tbody>
                        <tr><td><code>pv_sid</code></td><td><?= t('privacy.s4.pv_sid_purpose') ?></td><td><?= t('privacy.s4.pv_sid_retention') ?></td></tr>
                        <tr><td><code>portfolio_sess</code></td><td><?= t('privacy.s4.sess_purpose') ?></td><td><?= t('privacy.s4.sess_retention') ?></td></tr>
                    </tbody>
                </table>
                <p><?= t('privacy.s4.note') ?></p>

                <h2><?= t('privacy.s5.title') ?></h2>
                <ul>
                    <li><?= t('privacy.s5.li_contact') ?></li>
                    <li><?= t('privacy.s5.li_stats') ?></li>
                    <li><?= t('privacy.s5.li_log') ?></li>
                </ul>

                <h2><?= t('privacy.s6.title') ?></h2>
                <p><?= t('privacy.s6.body') ?></p>
                <ul>
                    <li><?= t('privacy.s6.li_host') ?></li>
                    <li><?= t('privacy.s6.li_google') ?></li>
                </ul>

                <h2><?= t('privacy.s7.title') ?></h2>
                <p><?= t('privacy.s7.body') ?></p>

                <h2><?= t('privacy.s8.title') ?></h2>
                <p><?= t('privacy.s8.body') ?></p>
                <ul>
                    <li><?= t('privacy.s8.li_access') ?></li>
                    <li><?= t('privacy.s8.li_correct') ?></li>
                    <li><?= t('privacy.s8.li_object') ?></li>
                    <li><?= t('privacy.s8.li_transfer') ?></li>
                </ul>
                <p><?= t('privacy.s8.contact') ?></p>

                <h2><?= t('privacy.s9.title') ?></h2>
                <p><?= t('privacy.s9.body') ?></p>

                <h2><?= t('privacy.s10.title') ?></h2>
                <p><?= t('privacy.s10.body') ?></p>
            </div>
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
</body>
</html>
