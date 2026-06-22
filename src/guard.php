<?php
declare(strict_types=1);

// Authenticatie-guard: vereist een ingelogde gebruiker.
require_once __DIR__ . '/session.php';

if (empty($_SESSION['user_id'])) {
    $base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
    $next = $base . $_SERVER['REQUEST_URI'];
    header("Location: {$base}/pages/login.php?next=" . rawurlencode($next));
    exit;
}

// Na succesvolle guard: DB + housekeeping laden en stil opruimen.
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/housekeeping.php';
try {
    hk_maybe($pdo);
} catch (Throwable $e) {
    /* stil */
}
