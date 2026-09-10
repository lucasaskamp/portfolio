<?php
declare(strict_types=1);

// Login verplicht (let op: één map dieper dan de andere adminpagina's)
require_once __DIR__ . '/../../../src/guard.php';

// DB + helpers (e())
require_once __DIR__ . '/../../../src/bootstrap.php';

$currentUser = $_SESSION['username'] ?? 'Gebruiker';
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Game Backlog — Portfolio Admin</title>
    <link rel="stylesheet" href="../../assets/css/admin.css?v=<?= filemtime(__DIR__ . '/../../assets/css/admin.css') ?>" />
</head>
<body>

<!-- Zijbalk -->
<aside class="sidebar" aria-label="Zijbalk navigatie">
    <div class="sidebar__brand">
        <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="currentColor" d="M12 2l7 4v12l-7 4-7-4V6l7-4zm0 2.3L7 6.8v10.4l5 2.5 5-2.5V6.8l-5-2.5z"/>
        </svg>
        <span>Portfolio Admin</span>
    </div>

    <nav class="sidebar__nav">
        <a href="../dashboard.php" class="nav-link">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
            <span>Dashboard</span>
        </a>
        <a href="../admin.php" class="nav-link">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M4 6h16v2H4zm0 5h16v2H4zm0 5h10v2H4z"/></svg>
            <span>Projecten</span>
        </a>
        <a href="../contacts.php" class="nav-link">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M21 8v10a2 2 0 0 1-2 2H5l-4 4V6a2 2 0 0 1 2-2h12"/></svg>
            <span>Contact</span>
        </a>
        <a href="../apps.php" class="nav-link is-active">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/></svg>
            <span>Apps</span>
        </a>
        <a href="../../auth/logout.php" class="nav-link nav-link--danger">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M10 17l1.41-1.41L8.83 13H21v-2H8.83l2.58-2.59L10 7l-5 5 5 5zM4 19h6v2H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h6v2H4v14z"/></svg>
            <span>Uitloggen</span>
        </a>
    </nav>

    <div class="sidebar__footer">
        <small>© Lucas Askamp</small>
    </div>
</aside>

<!-- Bovenbalk -->
<header class="topbar">
    <button class="icon-btn" id="toggleSidebar" aria-label="Zijbalk openen/sluiten" aria-controls="sidebar">
        <span class="icon-bars"></span>
    </button>
    <h1 class="topbar__title">Game Backlog</h1>
    <div class="topbar__user">
        <div class="avatar" aria-hidden="true">LA</div>
        <span class="topbar__user-name"><?= e($currentUser) ?></span>
    </div>
</header>

<!-- Inhoud -->
<main class="main">
    <section class="section">
        <h2>Game Backlog</h2>

        <div class="card">
            <div class="card__body">
                <p style="margin:0 0 16px">Deze app wordt hier gebouwd.</p>
                <div class="actions">
                    <a class="btn btn-ghost" href="../apps.php">Terug naar Apps</a>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="../../assets/js/admin.js"></script>
</body>
</html>
