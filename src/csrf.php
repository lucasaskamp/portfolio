<?php
declare(strict_types=1);

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_verify(?string $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $token);
}

/**
 * Stopt de request met 400 als de CSRF-token ontbreekt of onjuist is.
 */
function csrf_require(?string $token): void
{
    if (!csrf_verify($token)) {
        http_response_code(400);
        exit('Ongeldige of ontbrekende CSRF-token.');
    }
}
