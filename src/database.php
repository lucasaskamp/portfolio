<?php
declare(strict_types=1);

/**
 * PDO-verbinding op basis van .env-configuratie.
 * Geeft altijd dezelfde verbinding terug (singleton).
 */
function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $host    = env('DB_HOST', 'localhost');
    $name    = env('DB_NAME', '');
    $user    = env('DB_USER', '');
    $pass    = env('DB_PASS', '');
    $charset = env('DB_CHARSET', 'utf8mb4');

    if ($user === '' || $name === '') {
        http_response_code(500);
        exit('Database-config ontbreekt. Maak een .env aan op basis van .env.example.');
    }

    $dsn = "mysql:host={$host};dbname={$name};charset={$charset}";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    return $pdo;
}
