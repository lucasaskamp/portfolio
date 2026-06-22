<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/guard.php';
require_once __DIR__ . '/../../src/bootstrap.php';
require_once __DIR__ . '/../../src/csrf.php';
require_once __DIR__ . '/../../src/activity.php';

try {
    csrf_require($_POST['csrf'] ?? '');
    $id = (int)($_POST['id'] ?? 0);
    if ($id <= 0) { http_response_code(400); exit('bad id'); }

    $pdo->beginTransaction();

    // Titel ophalen voor het logboek
    $sel = $pdo->prepare("SELECT title FROM projects WHERE id=:id LIMIT 1");
    $sel->execute([':id' => $id]);
    $title = (string)($sel->fetchColumn() ?: ('#' . $id));

    // Eerst de gekoppelde afbeelding (werkt ook zonder FK-cascade), dan het project
    $pdo->prepare("DELETE FROM project_images WHERE project_id=:id")->execute([':id' => $id]);
    $pdo->prepare("DELETE FROM projects WHERE id=:id")->execute([':id' => $id]);

    log_event($pdo, $_SESSION['user_id'] ?? null, $_SESSION['username'] ?? null, 'delete', 'project', $id, ['title' => $title]);

    $pdo->commit();
    header('Location: ./admin.php?deleted=1');
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    error_log('project-delete failed: ' . $e->getMessage());
    header('Location: ./admin.php?err=delete');
}
