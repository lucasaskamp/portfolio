<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/guard.php';
require_once __DIR__ . '/../../src/bootstrap.php';
require_once __DIR__ . '/../../src/csrf.php';
require_once __DIR__ . '/../../src/activity.php';

/** Terug naar de projectlijst: filters blijven staan, een oude melding niet. */
function back_to_list(string $key, string $value): never {
    $ref   = $_SERVER['HTTP_REFERER'] ?? './admin.php';
    $parts = explode('?', $ref, 2);
    parse_str($parts[1] ?? '', $params);
    unset($params['ok'], $params['err'], $params['deleted']);
    $params[$key] = $value;

    header('Location: ' . $parts[0] . '?' . http_build_query($params));
    exit;
}

try {
    csrf_require($_POST['csrf'] ?? '');

    $id = (int)($_POST['id'] ?? 0);
    $to = (string)($_POST['to'] ?? 'concept');
    $allowed = ['concept', 'live'];
    if (!in_array($to, $allowed, true)) $to = 'concept';
    if ($id <= 0) back_to_list('err', 'badid');

    $cur = $pdo->prepare("SELECT title, status FROM projects WHERE id=:id LIMIT 1");
    $cur->execute([':id' => $id]);
    $row = $cur->fetch(PDO::FETCH_ASSOC);
    if (!$row) back_to_list('err', 'notfound');

    $upd = $pdo->prepare("UPDATE projects SET status=:to WHERE id=:id LIMIT 1");
    $upd->execute([':to' => $to, ':id' => $id]);

    log_event($pdo, $_SESSION['user_id'] ?? null, $_SESSION['username'] ?? null, 'toggle', 'project', $id, [
        'title' => (string)$row['title'],
        'from'  => (string)$row['status'],
        'to'    => $to,
    ]);

    back_to_list('ok', 'toggle');
} catch (Throwable $e) {
    error_log('project-toggle failed: ' . $e->getMessage());
    back_to_list('err', 'toggle');
}
