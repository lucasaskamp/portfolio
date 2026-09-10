<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../src/guard.php';
require_once __DIR__ . '/../../../src/bootstrap.php';
require_once __DIR__ . '/../../../src/csrf.php';
require_once __DIR__ . '/../../../src/activity.php';

/** Terug naar het bord met een melding. */
function back(string $key, string $value): never {
    header('Location: ./game-backlog.php?' . $key . '=' . $value);
    exit;
}

csrf_require($_POST['csrf'] ?? '');

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) back('err', 'badid');

try {
    // Titel ophalen voor het logboek; bestaat hij niet, dan nette melding
    $sel = $pdo->prepare("SELECT title FROM games WHERE id=:id LIMIT 1");
    $sel->execute([':id' => $id]);
    $title = $sel->fetchColumn();
    if ($title === false) back('err', 'notfound');

    $pdo->prepare("DELETE FROM games WHERE id=:id LIMIT 1")->execute([':id' => $id]);

    log_event($pdo, $_SESSION['user_id'] ?? null, $_SESSION['username'] ?? null, 'delete', 'game', $id, [
        'title' => (string)$title,
    ]);

    back('ok', 'delete');
} catch (Throwable $e) {
    error_log('game-delete failed: ' . $e->getMessage());
    back('err', 'delete');
}
