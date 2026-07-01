<?php
declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once __DIR__ . '/../../src/bootstrap.php';     // $pdo
require_once __DIR__ . '/../../src/activity.php';   // log_event()

function redirect(string $to): void { header('Location: '.$to); exit; }

$backOk  = '../pages/contact.php?sent=1';
$backBad = '../pages/contact.php?err=input';
$backSrv = '../pages/contact.php?err=server';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    // Honeypot
    if (!empty($_POST['website'] ?? '')) {
        redirect($backOk);
    }

    // Input
    $name    = trim((string)($_POST['name'] ?? ''));
    $email   = trim((string)($_POST['email'] ?? ''));
    $subject = trim((string)($_POST['subject'] ?? ''));
    $message = trim((string)($_POST['message'] ?? ''));
    $lang    = (($_POST['lang'] ?? '') === 'nl') ? 'nl' : 'en'; // taal van de bezoeker (fallback en)

    // Validatie volgens jouw kolomnamen/lengtes
    if ($name === '' || mb_strlen($name) > 120)        redirect($backBad);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))     redirect($backBad);
    if (mb_strlen($email) > 190)                        redirect($backBad);
    if ($subject === '' || mb_strlen($subject) > 150)   redirect($backBad);
    if ($message === '' || mb_strlen($message) > 5000)  redirect($backBad);

    // Client info
    $ua = substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255);
    $ipRaw = null;
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $packed = @inet_pton($_SERVER['REMOTE_ADDR']);
        if ($packed !== false) $ipRaw = $packed; // binair voor VARBINARY(16)
    }

    // INSERT (let op: géén updated_at)
    $sql = "INSERT INTO contact_messages
              (name, email, subject, message, status, created_at, ip, user_agent)
            VALUES
              (:n, :e, :s, :m, 'open', NOW(), :ip, :ua)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':n',  $name);
    $stmt->bindValue(':e',  $email);
    $stmt->bindValue(':s',  $subject);
    $stmt->bindValue(':m',  $message);
    if ($ipRaw === null) {
        $stmt->bindValue(':ip', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':ip', $ipRaw, PDO::PARAM_LOB);
    }
    $stmt->bindValue(':ua', $ua);
    $stmt->execute();

    $id = (int)$pdo->lastInsertId();

    // Log create
    log_event(
        $pdo,
        $_SESSION['user_id']  ?? null,
        $_SESSION['username'] ?? null,
        'create',
        'contact',
        $id,
        ['name'=>$name,'email'=>$email,'subject'=>$subject]
    );

    // Site- en CV-links dynamisch opbouwen (werkt ongeacht waar de site draait)
    $scheme  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host    = $_SERVER['HTTP_HOST'] ?? 'lucasaskamp.nl';
    $baseUrl = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/'); // public-root, bv. "" of "/portfolio/public"
    $siteUrl = $scheme . '://' . $host . $baseUrl . '/';
    $cvUrl   = $siteUrl . rawurlencode('Cv-Lucas_Askamp(2026).pdf');

    // CV-bijlage voorbereiden (ligt in public/, één map boven dit script)
    $cvPath = __DIR__ . '/../Cv-Lucas_Askamp(2026).pdf';
    $cvName = 'CV-Lucas-Askamp.pdf';

    if (function_exists('mail')) {
        // 1) Notificatie naar mezelf: er wacht iemand op contact
        $adminHdrs = "From: Portfolio <no-reply@{$host}>\r\n".
            "Reply-To: {$name} <{$email}>\r\n".
            "Content-Type: text/plain; charset=UTF-8\r\n".
            "MIME-Version: 1.0\r\n";
        $adminBody =
            "Er wacht iemand op contact via je portfolio.\n\n".
            "Naam: {$name}\n".
            "E-mail: {$email}\n".
            "Onderwerp: {$subject}\n\n".
            "Bericht:\n{$message}\n\n".
            "Neem zo snel mogelijk contact op via {$email}.\n";
        @mail('contact@lucasaskamp.nl', 'Nieuwe contactaanvraag - iemand wacht op je reactie', $adminBody, $adminHdrs);

        // 2) Bevestiging naar de afzender, met portfolio-link en CV als bijlage
        $boundary  = '=_' . bin2hex(random_bytes(16));
        $replyHdrs = "From: Lucas Askamp <contact@lucasaskamp.nl>\r\n".
            "Reply-To: contact@lucasaskamp.nl\r\n".
            "MIME-Version: 1.0\r\n".
            "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

        // Bevestiging in de taal die de bezoeker op de site koos (nl/en).
        $replySubject = t_lang($lang, 'email.reply.subject');
        $replyText    = t_lang($lang, 'email.reply.body', [
            'name'    => $name,
            'siteUrl' => $siteUrl,
            'cvUrl'   => $cvUrl,
        ]);

        // Tekstdeel
        $replyBody  = "--{$boundary}\r\n";
        $replyBody .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $replyBody .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $replyBody .= $replyText . "\r\n";

        // CV-bijlage (alleen als het bestand er is)
        if (is_file($cvPath) && ($pdf = @file_get_contents($cvPath)) !== false) {
            $replyBody .= "--{$boundary}\r\n";
            $replyBody .= "Content-Type: application/pdf; name=\"{$cvName}\"\r\n";
            $replyBody .= "Content-Transfer-Encoding: base64\r\n";
            $replyBody .= "Content-Disposition: attachment; filename=\"{$cvName}\"\r\n\r\n";
            $replyBody .= chunk_split(base64_encode($pdf)) . "\r\n";
        }
        $replyBody .= "--{$boundary}--\r\n";

        @mail($email, $replySubject, $replyBody, $replyHdrs);
    }

    redirect($backOk);

} catch (Throwable $e) {
    error_log('send_mail.php error: '.$e->getMessage());
    redirect($backSrv);
}
