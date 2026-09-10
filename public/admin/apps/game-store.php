<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../src/guard.php';
require_once __DIR__ . '/../../../src/bootstrap.php';
require_once __DIR__ . '/../../../src/csrf.php';
require_once __DIR__ . '/../../../src/activity.php';
require_once __DIR__ . '/game-helpers.inc.php';

csrf_require($_POST['csrf'] ?? '');

$form = game_read_form($_POST);
if (isset($form['error'])) {
    header('Location: ./game-new.php?err=' . $form['error']);
    exit;
}
$g = $form['data'];

try {
    $ins = $pdo->prepare("
        INSERT INTO games
          (title, platform, status, rating, progress, hours_played, notes, started_at, finished_at, release_date)
        VALUES
          (:title, :platform, :status, :rating, :progress, :hours, :notes, :started, :finished, :release)
    ");
    $ins->execute([
        ':title'    => $g['title'],
        ':platform' => $g['platform'],
        ':status'   => $g['status'],
        ':rating'   => $g['rating'],
        ':progress' => $g['progress'],
        ':hours'    => $g['hours_played'],
        ':notes'    => $g['notes'],
        ':started'  => $g['started_at'],
        ':finished' => $g['finished_at'],
        ':release'  => $g['release_date'],
    ]);
    $id = (int)$pdo->lastInsertId();

    log_event($pdo, $_SESSION['user_id'] ?? null, $_SESSION['username'] ?? null, 'create', 'game', $id, [
        'title'  => $g['title'],
        'status' => $g['status'],
    ]);

    header('Location: ./game-backlog.php?ok=create');
} catch (Throwable $e) {
    error_log('game-store failed: ' . $e->getMessage());
    header('Location: ./game-new.php?err=server');
}
exit;
