<?php
declare(strict_types=1);
require_once __DIR__ . '/../../src/session.php';
require_once __DIR__ . '/../../src/csrf.php';
require_once __DIR__ . '/../../src/i18n.php';
$token = csrf_token();

/** Eventuele fout via querystring (bv. ?err=1 of ?err=bad) */
$errKey = $_GET['err'] ?? ($_GET['error'] ?? '');
$errMsg = '';
if ($errKey) {
    // Toon 1 generieke boodschap; backend logt details
    $errMsg = t('login.error');
}
?>
<!doctype html>
<html lang="<?= e(lang_current()) ?>" data-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= t('meta.title.login') ?></title>
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
            <a href="../index.php" class="nav__link"><?= t('nav.home') ?></a>
            <a href="about.php" class="nav__link"><?= t('nav.about') ?></a>
            <a href="project.php" class="nav__link"><?= t('nav.projects') ?></a>
            <a href="contact.php" class="nav__link"><?= t('nav.contact') ?></a>
            <a href="#" class="nav__link is-active"><?= t('nav.login') ?></a>
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
            <h1><?= t('login.hero.title') ?></h1>
            <p><?= t('login.hero.tagline') ?></p>
        </div>
    </div>
</section>

<!-- Login kaart -->
<main class="section section--login">
    <!-- VOLLEDIGE ACHTERGROND, onder de hero / titel -->
    <div class="login-backdrop" aria-hidden="true">
        <canvas id="loginFx"></canvas>
        <span class="glow glow-1"></span>
        <span class="glow glow-2"></span>
    </div>

    <div class="container auth-wrap">
        <div class="login-stage"><!-- tilt-stage voor de kaart -->

            <!-- JE BESTAANDE CARD (functionaliteit ongewijzigd) -->
            <article
                    class="card auth-card<?= $errMsg ? ' is-shake' : '' ?>"
                    id="authCard"
                    <?= $errMsg ? 'data-error="1"' : '' ?>
            >
                <header class="card__header">
                    <h2 class="auth-title">Portfolio Admin</h2>
                    <p class="muted"><?= t('login.card.subtitle') ?></p>
                </header>

                <div class="card__body">
                    <form id="loginForm" class="auth-form" action="../auth/login.php" method="post" novalidate>
                        <input type="hidden" name="csrf" value="<?= e($token) ?>">

                        <div class="field">
                            <label class="label" for="user"><?= t('login.username') ?></label>
                            <input class="input" type="text" id="user" name="user"
                                   placeholder="<?= e(t('login.username')) ?>" required autocomplete="username">
                        </div>

                        <div class="field">
                            <label class="label" for="password"><?= t('login.password') ?></label>
                            <input class="input" type="password" id="password" name="password"
                                   placeholder="•••••••" required autocomplete="current-password">
                        </div>

                        <div class="actions">
                            <button id="loginBtn" type="submit" class="btn btn-primary"><?= t('login.submit') ?></button>
                            <button type="reset" class="btn"><?= t('login.clear') ?></button>
                        </div>

                        <p id="status" class="alert <?= $errMsg ? 'alert--error' : '' ?>" role="status">
                            <?= $errMsg ? e($errMsg) : '' ?>
                        </p>
                    </form>
                </div>
            </article>
        </div>
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
<script src="../assets/js/login.ui.js" defer></script>
<script src="../assets/js/login.bg.js" defer></script>
</body>
</html>
