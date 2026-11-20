<?php
declare(strict_types=1);

/**
 * ============================================================================
 * PLAIN-ENGLISH OVERVIEW FOR NEW DEVELOPERS (READ-ALONG TEACHING HEADER)
 * ============================================================================
 * What is this file?
 *   This is `celeste/lyra.php`, a lightweight PHP 8.5 "router bridge" (also
 *   called a front-controller alias) for `https://nebulae.raggiesoft.com`.
 *
 * Why does it exist in the RaggieSoft ecosystem?
 *   Across RaggieSoft's PHP web properties, character-named router entrypoints
 *   are used as clean front controllers:
 *     - `raggiesoft.com` uses `amanda/elara.php`
 *     - `books.raggiesoft.com` uses `eleanor/isabel.php`
 *     - `nebulae.raggiesoft.com` provides `celeste/lyra.php` alongside `index.php`
 *   Keeping `celeste/lyra.php` here ensures that any historical or alternate
 *   server routing rule pointing at `/celeste/lyra.php` seamlessly executes the
 *   main "Escape Velocity (Ad Astra)" Planetary Survey application without
 *   duplicating a single line of application code.
 *
 * What inputs feed into it, and what output does it produce?
 *   It inherits the full incoming HTTP request (`$_SERVER['REQUEST_URI']`,
 *   query parameters, and headers) and hands execution directly to `../index.php`,
 *   producing the exact same HTML5 output and HTTP status codes (`200` or `404`).
 * ============================================================================
 */

// Step-by-step breakdown of the single statement below:
// 1. `__DIR__` is PHP's built-in magic constant for THIS file's directory:
//    `.../subdomains/nebulae/celeste`.
// 2. `dirname(__DIR__)` steps up one parent folder to `.../subdomains/nebulae`.
// 3. `. '/index.php'` concatenates `/index.php` onto that parent folder path
//    (in PHP, `.` joins strings together just like `+` in JavaScript).
// 4. `require` loads and runs `index.php` immediately (like Node's `require()`
//    or ES `import`), halting with a fatal error if `index.php` were ever missing.
require dirname(__DIR__) . '/index.php';
