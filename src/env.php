<?php
declare(strict_types=1);

/**
 * Minimale .env loader (geen externe dependencies).
 * Leest KEY=VALUE regels en zet ze in getenv()/$_ENV/$_SERVER.
 * Bestaande omgevingsvariabelen worden NIET overschreven, zodat
 * echte server-env (bv. op productie) altijd voorrang heeft.
 */
function env_load(string $path): void
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
    foreach ($lines as $line) {
        $line = trim($line);

        // Comments en lege regels overslaan
        if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);
        $name  = trim($name);
        $value = trim($value);

        if ($name === '') {
            continue;
        }

        // Omringende quotes verwijderen
        $len = strlen($value);
        if ($len >= 2) {
            $first = $value[0];
            $last  = $value[$len - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        // Echte env heeft voorrang
        if (getenv($name) !== false || array_key_exists($name, $_ENV)) {
            continue;
        }

        putenv("{$name}={$value}");
        $_ENV[$name]    = $value;
        $_SERVER[$name] = $value;
    }
}

/**
 * Lees een config-waarde met fallback.
 */
function env(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    if ($value === false) {
        return array_key_exists($key, $_ENV) ? (string) $_ENV[$key] : $default;
    }
    return $value;
}
