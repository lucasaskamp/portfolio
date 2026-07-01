<?php
declare(strict_types=1);
require_once __DIR__ . '/../../src/session.php';
require_once __DIR__ . '/../../src/csrf.php';
require_once __DIR__ . '/../../src/bootstrap.php'; // bevat $pdo, e() en i18n (t())

$token   = csrf_token();
$ok      = isset($_GET['sent']) && $_GET['sent'] === '1';
$qErr    = $_GET['err'] ?? '';
$old     = $_SESSION['contact_old'] ?? [];
$errKey  = $_SESSION['contact_err'] ?? '';
$errFld  = $_SESSION['contact_err_field'] ?? '';
unset($_SESSION['contact_old'], $_SESSION['contact_err'], $_SESSION['contact_err_field']);

function field_error(string $name, string $errFld, string $errKey): ?string {
    $allowed = ['input_name','input_email','input_subject','input_message','csrf','rate','input'];
    if (!in_array($errKey, $allowed, true)) return null;
    if ($errFld === $name) return t('contact.err.' . $errKey);
    if ($name === 'global' && $errKey !== '') return t('contact.err.' . $errKey);
    return null;
}
?>
<!doctype html>
<html lang="<?= e(lang_current()) ?>" data-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= t('meta.title.contact') ?></title>
    <link rel="stylesheet" href="../assets/css/site.css" />
    <style>
        /* kleine, geïsoleerde overlay laag – tast je bestaande stijl niet aan */
        .modal-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.5);display:none;align-items:center;justify-content:center;z-index:1000}
        .modal-backdrop.is-open{display:flex}
        .modal{max-width:520px;width:90vw}
    </style>
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
            <a href="#" class="nav__link is-active"><?= t('nav.contact') ?></a>
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
            <h1><?= t('contact.hero.title') ?></h1>
            <p><?= t('contact.hero.tagline') ?></p>
        </div>
    </div>
</section>

<!-- Inhoud -->
<main class="section">
    <div class="container contact-grid">
        <!-- Formulier -->
        <article class="card">
            <header class="card__header">
                <h2><?= t('contact.form.heading') ?></h2>
            </header>
            <div class="card__body">
                <form action="../api/send_mail.php" method="post" class="contact-form" novalidate>
                    <input type="hidden" name="csrf" value="<?= e($token) ?>">
                    <input type="hidden" name="lang" value="<?= e(lang_current()) ?>">

                    <!-- Globale foutmelding -->
                    <?php if (!$ok && ($g = field_error('global', $errFld, $errKey))): ?>
                        <p class="alert alert--error" role="status"><?= e($g) ?></p>
                    <?php elseif ($ok): ?>
                        <p class="alert alert--ok" role="status"><?= t('contact.ok') ?></p>
                    <?php endif; ?>

                    <!-- Honeypot -->
                    <div class="hp" aria-hidden="true">
                        <label for="website"><?= t('contact.hp.label') ?></label>
                        <input type="text" id="website" name="website" autocomplete="off" tabindex="-1" />
                    </div>

                    <div class="form-grid">
                        <div class="field">
                            <label class="label" for="name"><?= t('contact.form.name') ?></label>
                            <input class="input" type="text" id="name" name="name"
                                   value="<?= e($old['name'] ?? '') ?>" placeholder="<?= e(t('contact.form.name_ph')) ?>" required />
                            <?php if ($m = field_error('name', $errFld, $errKey)): ?>
                                <small class="hint" style="color:#e66"><?= e($m) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="field">
                            <label class="label" for="email"><?= t('contact.form.email') ?></label>
                            <input class="input" type="email" id="email" name="email"
                                   value="<?= e($old['email'] ?? '') ?>" placeholder="<?= e(t('contact.form.email_ph')) ?>" required />
                            <?php if ($m = field_error('email', $errFld, $errKey)): ?>
                                <small class="hint" style="color:#e66"><?= e($m) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="subject"><?= t('contact.form.subject') ?></label>
                        <input class="input" type="text" id="subject" name="subject"
                               value="<?= e($old['subject'] ?? '') ?>" placeholder="<?= e(t('contact.form.subject_ph')) ?>" required />
                        <?php if ($m = field_error('subject', $errFld, $errKey)): ?>
                            <small class="hint" style="color:#e66"><?= e($m) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="field">
                        <label class="label" for="message"><?= t('contact.form.message') ?></label>
                        <textarea class="textarea" id="message" name="message" rows="6"
                                  placeholder="<?= e(t('contact.form.message_ph')) ?>" required><?= e($old['message'] ?? '') ?></textarea>
                        <p class="hint"><?= t('contact.form.message_hint') ?></p>
                        <?php if ($m = field_error('message', $errFld, $errKey)): ?>
                            <small class="hint" style="color:#e66"><?= e($m) ?></small>
                        <?php endif; ?>
                    </div>

                    <p class="hint">
                        <?= t('contact.form.privacy_notice') ?>
                    </p>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary"><?= t('contact.form.send') ?></button>
                        <button type="reset" class="btn"><?= t('contact.form.clear') ?></button>
                    </div>
                </form>
            </div>
        </article>

        <!-- Contactinfo -->
        <aside class="card">
            <header class="card__header">
                <h2><?= t('contact.direct.heading') ?></h2>
            </header>
            <div class="card__body">
                <ul class="inline-list">
                    <li>
                        <div class="kicker"><?= t('contact.direct.email') ?></div>
                        <a href="mailto:contact@lucasaskamp.nl">contact@lucasaskamp.nl</a>
                    </li>
                    <li>
                        <div class="kicker">LinkedIn</div>
                        <a href="https://www.linkedin.com/in/lucas-askamp-87031a2b7/" target="_blank" rel="noopener"><?= t('contact.direct.linkedin_text') ?></a>
                    </li>
                    <li>
                        <div class="kicker">GitHub</div>
                        <a href="https://github.com/100536" target="_blank" rel="noopener"><?= t('contact.direct.github_text') ?></a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</main>

<!-- SUCCES-MODAL -->
<div class="modal-backdrop" id="contactSuccessModal" aria-hidden="true">
    <div class="card modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-describedby="modalDesc" tabindex="-1">
        <header class="card__header">
            <h3 id="modalTitle"><?= t('contact.modal.title') ?></h3>
        </header>
        <div class="card__body" id="modalDesc">
            <p><?= t('contact.modal.body') ?></p>
        </div>
        <footer class="card__footer actions">
            <button class="btn btn-primary" type="button" data-close-modal><?= t('contact.modal.ok') ?></button>
        </footer>
    </div>
</div>

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
<script src="../assets/js/contact.js" defer></script>
</body>
</html>
