<?php
declare(strict_types=1);

/**
 * Lichte i18n-laag (geen dependencies) in dezelfde stijl als de overige src/-helpers.
 *
 * Talen: 'nl' en 'en'. Regel: "is het niet Nederlands, dan altijd Engels",
 * dus 'en' is de standaard/fallback. Nederlands wordt alleen gekozen als de
 * bezoeker dat expliciet kiest (?lang=nl of cookie) of een NL-browser heeft.
 */

require_once __DIR__ . '/helpers.php'; // e()

if (!defined('LANG_SUPPORTED')) {
    define('LANG_SUPPORTED', ['nl', 'en']);
}

if (!function_exists('lang_current')) {
    /** Bepaalt de actieve taal, één keer per request. */
    function lang_current(): string
    {
        static $lang = null;
        if ($lang !== null) {
            return $lang;
        }

        // 1) Expliciete keuze via querystring -> onthouden in cookie (1 jaar).
        if (isset($_GET['lang']) && in_array($_GET['lang'], LANG_SUPPORTED, true)) {
            $lang = $_GET['lang'];
            if (!headers_sent()) {
                setcookie('lang', $lang, [
                    'expires'  => time() + 31536000,
                    'path'     => '/',
                    'samesite' => 'Lax',
                ]);
            }
            $_COOKIE['lang'] = $lang;
            return $lang;
        }

        // 2) Eerder gemaakte keuze uit cookie.
        if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], LANG_SUPPORTED, true)) {
            return $lang = $_COOKIE['lang'];
        }

        // 3) Browservoorkeur: alleen de hoogst geprefereerde tag telt.
        $accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
        $first  = strtolower(trim(explode(',', $accept)[0] ?? ''));
        $first  = trim(explode(';', $first)[0]); // eventuele ;q=... eraf
        if ($first === 'nl' || strncmp($first, 'nl-', 3) === 0) {
            return $lang = 'nl';
        }

        // 4) Fallback: Engels.
        return $lang = 'en';
    }
}

if (!function_exists('lang_load')) {
    /** Laadt (en cachet) de vertaalarray voor een taal. */
    function lang_load(string $lang): array
    {
        static $cache = [];
        if (isset($cache[$lang])) {
            return $cache[$lang];
        }
        $file = __DIR__ . '/lang/' . $lang . '.php';
        $cache[$lang] = is_file($file) ? (array) require $file : [];
        return $cache[$lang];
    }
}

if (!function_exists('t_lang')) {
    /**
     * Vertaalt een sleutel in een expliciete taal.
     * Ontbreekt de sleutel, val terug op Engels; ontbreekt die ook, geef de sleutel terug.
     * Placeholders als :name worden vervangen via $vars (['name' => '...']).
     */
    function t_lang(string $lang, string $key, array $vars = []): string
    {
        $lang = in_array($lang, LANG_SUPPORTED, true) ? $lang : 'en';

        $val = lang_load($lang)[$key] ?? null;
        if ($val === null && $lang !== 'en') {
            $val = lang_load('en')[$key] ?? null;
        }
        if ($val === null) {
            $val = $key;
        }

        if ($vars) {
            $repl = [];
            foreach ($vars as $k => $v) {
                $repl[':' . $k] = (string) $v;
            }
            $val = strtr($val, $repl);
        }

        return $val;
    }
}

if (!function_exists('t')) {
    /** Vertaalt een sleutel in de actieve taal (zie lang_current()). */
    function t(string $key, array $vars = []): string
    {
        return t_lang(lang_current(), $key, $vars);
    }
}

if (!function_exists('lang_switch_url')) {
    /** Huidige URL met lang=... gezet, voor de taalschakelaar. */
    function lang_switch_url(string $lang): string
    {
        $lang = in_array($lang, LANG_SUPPORTED, true) ? $lang : 'en';

        $uri  = $_SERVER['REQUEST_URI'] ?? '/';
        [$path, $fragment] = array_pad(explode('#', $uri, 2), 2, '');
        [$base, $query]    = array_pad(explode('?', $path, 2), 2, '');

        parse_str($query, $params);
        $params['lang'] = $lang;
        $qs = http_build_query($params);

        return $base . ($qs !== '' ? '?' . $qs : '') . ($fragment !== '' ? '#' . $fragment : '');
    }
}

// Warm de taalbepaling zodra dit bestand geladen wordt, zodat een eventuele
// ?lang-cookie gezet wordt voordat er HTML-output is.
lang_current();
