<?php
declare(strict_types=1);

require_once __DIR__ . '/../../src/guard.php';
require_once __DIR__ . '/../../src/bootstrap.php';
require_once __DIR__ . '/../../src/activity.php';

session_write_close();

function back(string $suffix=''): never {
    $to = $_SERVER['HTTP_REFERER'] ?? './contacts.php';
    if ($suffix !== '') $to .= (str_contains($to,'?')?'&':'?').$suffix;
    header('Location: '.$to);
    exit;
}

$postCsrf = (string)($_POST['csrf'] ?? '');
if (isset($_SESSION['csrf']) && !hash_equals((string)$_SESSION['csrf'], $postCsrf)) {
    error_log('contact-delete: CSRF mismatch');
    back('err=csrf');
}

$id = (int)($_POST['id'] ?? 0);
if ($id<=0) back('err=badid');

try{
    $pdo->beginTransaction();
    $del = $pdo->prepare("DELETE FROM contact_messages WHERE id=:id LIMIT 1");
    $del->execute([':id'=>$id]);

    log_event($pdo, $_SESSION['user_id']??null, $_SESSION['username']??null, 'delete', 'contact', $id, []);

    $pdo->commit();

    // Niet terug naar de referer: dat is vaak contact-view.php van het zojuist
    // verwijderde bericht, en die pagina kan niet meer bestaan.
    header('Location: ./contacts.php?ok=delete');
    exit;
} catch(Throwable $e){
    if ($pdo->inTransaction()) $pdo->rollBack();
    error_log('contact-delete failed: '.$e->getMessage());
    back('err=delete');
}
