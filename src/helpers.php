<?php
declare(strict_types=1);

/**
 * Algemene view-/string-helpers.
 * Beide zijn function_exists-guarded omdat enkele admin-pagina's
 * historisch een eigen e()/slugify() definiëren.
 */

if (!function_exists('e')) {
    function e(?string $s): string
    {
        return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('slugify')) {
    function slugify(string $t): string
    {
        $t = strtolower(trim($t));
        $t = preg_replace('~[^\pL\d]+~u', '-', $t);
        $t = preg_replace('~^-+|-+$~', '', $t);
        return $t !== '' ? $t : uniqid('p-', true);
    }
}
