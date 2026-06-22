<?php
declare(strict_types=1);

/**
 * Centrale bootstrap: laadt .env, helpers en database.
 * Includes verwachten een globale $pdo (zoals het oude config.php),
 * dus die exposen we hier voor backwards-compatibiliteit.
 */

require_once __DIR__ . '/env.php';
env_load(dirname(__DIR__) . '/.env');

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/database.php';

$pdo = db();
