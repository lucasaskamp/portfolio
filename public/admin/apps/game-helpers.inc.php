<?php
declare(strict_types=1);

/**
 * Gedeelde stukjes voor de Game Backlog-app.
 * Wordt ge-include door game-backlog.php, game-new.php en game-store.php.
 */

/** Kolommen van het bord: waarde in de database => tekst op het scherm. */
const GAME_STATUSES = [
    'wishlist'  => 'Wishlist',
    'backlog'   => 'Backlog',
    'playing'   => 'Playing',
    'completed' => 'Completed',
    'dropped'   => 'Dropped',
];

/** 3.5 → ★★★½☆ ; leeg → '' */
function game_stars(?string $rating): string
{
    if ($rating === null || $rating === '') return '';
    $r     = (float)$rating;
    $full  = (int)floor($r);
    $half  = ($r - $full) >= 0.5 ? 1 : 0;
    $empty = max(0, 5 - $full - $half);
    return str_repeat('★', $full) . ($half ? '½' : '') . str_repeat('☆', $empty);
}

/** Bestaande .pill-varianten per kolom. */
function game_pill_class(string $status): string
{
    return match ($status) {
        'playing'   => 'pill pill--warn',
        'completed' => 'pill pill--ok',
        default     => 'pill',
    };
}

/**
 * Leest het formulier en bewaakt de grenzen die de database niet bewaakt.
 * Geeft ['data' => [...]] terug, of ['error' => 'title'|'platform'|'rating'|'progress'|'hours'|'date'|'notes'].
 */
function game_read_form(array $post): array
{
    $data = [];

    $title = trim((string)($post['title'] ?? ''));
    if ($title === '' || mb_strlen($title) > 150) return ['error' => 'title'];
    $data['title'] = $title;

    $platform = trim((string)($post['platform'] ?? ''));
    if (mb_strlen($platform) > 60) return ['error' => 'platform'];
    $data['platform'] = $platform !== '' ? $platform : null;

    $status = (string)($post['status'] ?? 'backlog');
    $data['status'] = array_key_exists($status, GAME_STATUSES) ? $status : 'backlog';

    // Sterren: 0.5 t/m 5.0, alleen halve stappen. Komma mag ook.
    $v = str_replace(',', '.', trim((string)($post['rating'] ?? '')));
    if ($v === '') {
        $data['rating'] = null;
    } else {
        if (!is_numeric($v)) return ['error' => 'rating'];
        $r = (float)$v;
        if ($r < 0.5 || $r > 5 || abs($r * 2 - round($r * 2)) > 0.001) return ['error' => 'rating'];
        $data['rating'] = number_format($r, 1, '.', '');
    }

    // Voortgang: geheel getal 0 t/m 100
    $v = trim((string)($post['progress'] ?? ''));
    if ($v === '') {
        $data['progress'] = null;
    } else {
        if (!ctype_digit($v) || (int)$v > 100) return ['error' => 'progress'];
        $data['progress'] = (int)$v;
    }

    // Uren: 0 t/m 99999.9, één decimaal
    $v = str_replace(',', '.', trim((string)($post['hours_played'] ?? '')));
    if ($v === '') {
        $data['hours_played'] = null;
    } else {
        if (!is_numeric($v) || (float)$v < 0 || (float)$v > 99999.9) return ['error' => 'hours'];
        $data['hours_played'] = number_format((float)$v, 1, '.', '');
    }

    // Datums: leeg of geldig jjjj-mm-dd
    foreach (['started_at', 'finished_at', 'release_date'] as $field) {
        $v = trim((string)($post[$field] ?? ''));
        if ($v === '') { $data[$field] = null; continue; }
        $d = DateTime::createFromFormat('Y-m-d', $v);
        if (!$d || $d->format('Y-m-d') !== $v) return ['error' => 'date'];
        $data[$field] = $v;
    }

    $notes = trim((string)($post['notes'] ?? ''));
    if (mb_strlen($notes) > 5000) return ['error' => 'notes'];
    $data['notes'] = $notes !== '' ? $notes : null;

    return ['data' => $data];
}
