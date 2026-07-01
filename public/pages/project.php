<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/bootstrap.php'; // bevat $pdo, helper e() en i18n (t())

// Bepaal je site-basispad dynamisch (bijv. "/portfolio")
$base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');

// Haal live projecten op en kijk of er een image-record bestaat
$stmt = $pdo->query("
  SELECT p.*, pi.id AS img_id
  FROM projects p
  LEFT JOIN project_images pi ON pi.project_id = p.id
  WHERE p.status = 'live'
  ORDER BY p.updated_at DESC
");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

/** Fallback helper als je ooit nog een pad in hero_image gebruikt */
function heroSrc(?string $path, string $base): ?string {
    if (!$path) return null;
    if (preg_match('~^https?://~i', $path) || $path[0] === '/') return $path;
    return $base . '/' . ltrim($path, '/'); // → /portfolio/uploads/projects/...
}

/** Chips van "HTML,CSS,JS" */
function chips(?string $csv): array {
    return array_values(array_filter(array_map('trim', explode(',', $csv ?? ''))));
}

/** Kies het veld in de actieve taal; val terug op de NL-versie als de EN leeg is. */
function project_field(array $p, string $field): string {
    if (lang_current() === 'en') {
        $en = trim((string)($p[$field . '_en'] ?? ''));
        if ($en !== '') return $en;
    }
    return (string)($p[$field] ?? '');
}
?>
<!doctype html>
<html lang="<?= e(lang_current()) ?>" data-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= t('meta.title.projects') ?></title>
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
            <a href="#" class="nav__link is-active"><?= t('nav.projects') ?></a>
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
            <h1><?= t('project.hero.title') ?></h1>
            <p><?= t('project.hero.tagline') ?></p>
        </div>
    </div>
</section>

<!-- Projecten -->
<main class="section">
    <div class="container">
        <div class="project-grid">
            <?php if (empty($projects)): ?>
                <p class="muted"><?= t('project.empty') ?></p>
            <?php else: ?>
                <?php foreach ($projects as $p): ?>
                    <?php
                    $techs = chips($p['tech'] ?? '');
                    $title = project_field($p, 'title');
                    if ($title === '') { $title = t('project.untitled'); }
                    $excerpt = project_field($p, 'excerpt');
                    // BLOB uit DB heeft voorrang; anders fallback naar hero_image pad
                    $imgUrl = !empty($p['img_id'])
                            ? ($base . '/image.php?id=' . (int)$p['id'])
                            : heroSrc($p['hero_image'] ?? null, $base);
                    ?>
                    <article class="card project">
                        <?php if ($imgUrl): ?>
                            <a class="project__thumb" href="<?= e($p['live_url'] ?? '#') ?>" target="_blank" rel="noopener">
                                <img src="<?= e($imgUrl) ?>" alt="<?= e($title) ?>" loading="lazy" />
                            </a>
                        <?php endif; ?>
                        <div class="project__body">
                            <h3 class="project__title"><?= e($title) ?></h3>
                            <p class="project__desc"><?= e($excerpt) ?></p>
                            <?php if ($techs): ?>
                                <div class="chip-list">
                                    <?php foreach ($techs as $t): ?>
                                        <span class="chip"><?= e($t) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($p['live_url'])): ?>
                                <div class="project__actions">
                                    <a class="btn btn-primary" href="<?= e($p['live_url']) ?>" target="_blank" rel="noopener"><?= t('project.view_live') ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
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
</body>
</html>
