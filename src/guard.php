<?php
declare(strict_types=1);

// Authenticatie-guard: vereist een ingelogde gebruiker.
require_once __DIR__ . '/session.php';

// Zoveel seconden niets doen = sessie verlopen (30 minuten).
const SESSION_IDLE_SECONDS = 1800;

$base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');

// 1) Niet ingelogd → naar de loginpagina.
if (empty($_SESSION['user_id'])) {
    $next = $base . $_SERVER['REQUEST_URI'];
    header("Location: {$base}/pages/login.php?next=" . rawurlencode($next));
    exit;
}

// 2) Te lang inactief → sessie beëindigen (zelfde stappen als logout.php).
if (time() - (int)($_SESSION['last_activity'] ?? time()) > SESSION_IDLE_SECONDS) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();

    header("Location: {$base}/pages/login.php?err=timeout");
    exit;
}

// 3) Nog actief → de teller verversen.
$_SESSION['last_activity'] = time();

// Na succesvolle guard: DB + housekeeping laden en stil opruimen.
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/housekeeping.php';
try {
    hk_maybe($pdo);
} catch (Throwable $e) {
    /* stil */
}
