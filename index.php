<?php
declare(strict_types=1);

/**
 * ============================================================================
 * PLAIN-ENGLISH OVERVIEW FOR NEW DEVELOPERS (READ-ALONG TEACHING HEADER)
 * ============================================================================
 * What is this file?
 *   This is `index.php`, the main server-side PHP 8.5 webpage script for
 *   `https://nebulae.raggiesoft.com` ("The RaggieSoft Nebulae"). Unlike client-
 *   side JavaScript (which runs inside the visitor's browser *after* a page
 *   downloads), PHP runs on the Linux web server *before* a single byte of HTML
 *   is sent over the internet. When a visitor requests `nebulae.raggiesoft.com`,
 *   Nginx hands the request to PHP, PHP reads JSON configuration and story files
 *   from disk, fills in all the text and links, and outputs finished HTML5.
 *
 * Why does it exist in the RaggieSoft ecosystem?
 *   It presents the interactive 1996 "Short Film in Space" director's treatment
 *   and Caelum-IV planetary survey for The Stardust Engine's 15-minute rock
 *   suite, "Escape Velocity (Ad Astra)". Visitors can click sensor pins on a
 *   16:9 starship cargo-hatch viewport, filter the 4-movement storyboard, and
 *   read planetary worldbuilding lore.
 *
 * What inputs feed into this file?
 *   1. `settings.json`: Global RaggieSoft settings providing the asset CDN base
 *      URL (`https://assets.raggiesoft.com`) and Google Analytics tracking ID.
 *   2. `ad-astra-lore.json`: A structured JSON file holding planetary telemetry,
 *      clickable sensor hotspot coordinates/descriptions, the 4-act storyboard,
 *      and worldbuilding lore pillars (zero SQL database required!).
 *   3. `$_SERVER['REQUEST_URI']`: The URL path requested by the visitor's
 *      browser, used to decide whether to serve the survey (`200 OK`) or a
 *      genuine `404 Not Found` error page.
 *
 * What visible output or server behavior does it produce?
 *   A complete, accessible HTML5 document (`WCAG 2.1 AA` / `Section 508`) with:
 *   - Search-engine metadata, OpenGraph social preview cards, and Schema.org
 *     JSON-LD structured data.
 *   - Semantic landmarks (`header`, `nav`, `main`, `section`, `aside`, `footer`),
 *     keyboard-accessible `<button>` sensor triggers, and screen-reader live
 *     announcements (`aria-live="polite"`).
 *   - Progressive enhancement: because PHP renders all sensor panels and
 *     storyboard cards directly into the HTML on the server, the page is 100%
 *     readable by search crawlers and assistive technologies before `nebulae.js`
 *     even runs.
 *
 * File: /raggiesoft-servers/raggiesoft.com/subdomains/nebulae/index.php
 * Production URL: https://nebulae.raggiesoft.com/
 * Stack: PHP 8.5 + Semantic HTML5 + WCAG 2.1 AA / Section 508 Adaptive CSS
 * Licenses: MIT License (Code) & CC BY-SA 4.0 (Creative Content)
 * ============================================================================
 */

// Note on Line 2 above: `declare(strict_types=1);` tells PHP 8.5 NOT to silently
// guess or coerce data types when calling functions (similar to TypeScript vs.
// loose JavaScript). It must appear at the very top of the PHP file, and `<?php`
// MUST stay on Line 1 with zero blank lines before it so PHP can still send HTTP
// status headers (like 404) before any HTML output starts.

// ----------------------------------------------------------------------------
// 1. RESOLVE GLOBAL SETTINGS (`settings.json`)
// ----------------------------------------------------------------------------
// In PHP, variables always start with a `$` sign, and `[ ... ]` creates an array
// (just like a JavaScript array). Because this code can run on a developer's Mac
// OR on the DigitalOcean Linux server, we list three possible file paths where
// `settings.json` might live, in priority order:
//   - `__DIR__` is a built-in PHP constant holding THIS file's folder path.
//   - `dirname(__DIR__, 2)` walks 2 folders up the directory tree (like `../..`).
//   - `.` (a single dot) is PHP's string concatenation operator! Where JavaScript
//     writes `folder + '/file.json'`, PHP writes `$folder . '/file.json'`.
$settingsCandidates = [
    dirname(__DIR__, 2) . '/www/data/settings.json',
    '/var/www/raggiesoft.com/data/settings.json',
    __DIR__ . '/data/settings.json',
];

// Start with an empty array (`[]`), then loop through each candidate path until
// we find one that exists (`is_file`) and has read permissions (`is_readable`).
$settings = [];
foreach ($settingsCandidates as $candidatePath) {
    if (is_file($candidatePath) && is_readable($candidatePath)) {
        // `file_get_contents()` reads the entire file into a string (like Node's
        // `fs.readFileSync`). `json_decode(..., true)` parses JSON into a PHP
        // associative array (key/value dictionary, like `JSON.parse()` in JS).
        $decoded = json_decode((string) file_get_contents($candidatePath), true);
        if (is_array($decoded)) {
            $settings = $decoded;
            // `break` exits the `foreach` loop immediately once valid JSON loads.
            break;
        }
    }
}

// Extract individual settings using `??` (the null-coalescing operator, identical
// to JavaScript's `??`: if the left side is missing or null, use the fallback on
// the right). `rtrim(..., '/')` strips any accidental trailing slash from the URL
// so we never build broken double-slash URLs like `https://assets...//nebulae`.
$cdnBaseUrl = rtrim((string) ($settings['cdnBaseUrl'] ?? 'https://assets.raggiesoft.com'), '/');
$analyticsEnabled = (bool) ($settings['analytics']['enabled'] ?? true);
$analyticsTrackingId = (string) ($settings['analytics']['trackingId'] ?? 'G-P9RG9JVYB6');

// Build full CDN URLs for stylesheets, scripts, JSON lore, and images.
// Adding `?v=20261118a` is called "cache busting": browsers cache CSS/JS files aggressively,
// so bumping this version string forces every visitor's browser to fetch fresh files after an update.
$assetVersion = '20261118a';
$nebulaeCssUrl = $cdnBaseUrl . '/nebulae/css/nebulae.css?v=' . $assetVersion;
$nebulaeJsUrl  = $cdnBaseUrl . '/nebulae/js/nebulae.js?v=' . $assetVersion;
$loreJsonUrl   = $cdnBaseUrl . '/nebulae/json/ad-astra-lore.json';
$heroImageUrl  = $cdnBaseUrl . '/nebulae/images/ad-astra-landing.jpg';
$ogImageUrl    = $cdnBaseUrl . '/nebulae/images/og-ad-astra-landing.jpg';
$networkCssUrl = $cdnBaseUrl . '/common/css/raggiesoft-network.css?v=' . $assetVersion;
$networkJsUrl  = $cdnBaseUrl . '/common/js/raggiesoft-network.js?v=' . $assetVersion;

// ----------------------------------------------------------------------------
// 2. LOAD STRUCTURED LORE DATA (`ad-astra-lore.json`)
// ----------------------------------------------------------------------------
// RaggieSoft uses a "Zero-Database Flat-File Architecture": instead of querying a
// MySQL database on every page load, all planetary telemetry, sensor pins, and
// storyboard acts live in a version-controlled JSON file (`ad-astra-lore.json`).
// First, check local NVMe disk paths (fastest, zero network latency):
$loreFileCandidates = [
    dirname(__DIR__, 3) . '/raggiesoft-assets/nebulae/json/ad-astra-lore.json',
    __DIR__ . '/data/ad-astra-lore.json',
];

$loreData = [];
foreach ($loreFileCandidates as $loreCandidate) {
    if (is_file($loreCandidate) && is_readable($loreCandidate)) {
        $parsedLore = json_decode((string) file_get_contents($loreCandidate), true);
        if (is_array($parsedLore)) {
            $loreData = $parsedLore;
            break;
        }
    }
}

// Fallback to fetching the JSON over HTTPS from the public CDN if neither local
// file path existed on disk. Note the `@` symbol before `file_get_contents`: in
// PHP, `@` suppresses noisy warning messages if the network request times out,
// letting us cleanly check `!== false` right on the next line instead.
if (empty($loreData)) {
    $remoteJson = @file_get_contents($loreJsonUrl);
    if ($remoteJson !== false) {
        $parsedRemote = json_decode($remoteJson, true);
        if (is_array($parsedRemote)) {
            $loreData = $parsedRemote;
        }
    }
}

/**
 * Security Helper: HTML-escape any dynamic text before printing it into HTML.
 *
 * Why do we need `e()`?
 *   If a JSON string contains characters like `<`, `>`, `&`, `"`, or `'`, printing
 *   it raw into HTML could break tags or allow Cross-Site Scripting (XSS) injection.
 *   `htmlspecialchars()` converts those special characters into safe HTML entities
 *   (e.g., `<` becomes `&lt;`, `"` becomes `&quot;`).
 *   - `mixed $value`: Accepts any PHP type (string, int, float, or null).
 *   - `: string`: Guarantees a safe UTF-8 string is always returned.
 */
function e(mixed $value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// ----------------------------------------------------------------------------
// 3. SEO, OPENGRAPH & SCHEMA.ORG METADATA (<= 60 CHAR TITLE, <= 155 CHAR DESC)
// ----------------------------------------------------------------------------
// Inspect the URL path the visitor requested (for example, `/` or `/unknown-page`),
// stripping off any `?utm_source=...` query parameters via `parse_url(..., PHP_URL_PATH)`.
$reqPath = (string) (parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?: '/');

// Because Nebulae is a single-page experience rooted at `/`, any path other than
// `/` or `/index.php` does not exist. Setting `http_response_code(404)` sends a
// genuine HTTP 404 status header to browsers and search crawlers (avoiding "soft-404"
// SEO penalties where a missing URL mistakenly returns `200 OK`).
$isNotFound = ($reqPath !== '/' && $reqPath !== '/index.php');
if ($isNotFound) {
    http_response_code(404);
}

// Choose the browser tab title based on whether this is a valid visit or a 404,
// keeping titles <= 60 characters and descriptions <= 155 characters so search
// engines and social media previews never truncate them mid-sentence.
$pageTitle = $isNotFound
    ? 'Page Not Found | RaggieSoft Nebulae'
    : 'Escape Velocity (Ad Astra) | RaggieSoft Nebulae';
$ogTitle   = 'Escape Velocity (Ad Astra) — Short Film & Survey';
$ogDesc    = 'Explore the 1996 Escape Velocity (Ad Astra) short film storyboard and Caelum-IV planetary survey aboard the U.S.S. Aethelgard.';
$canonicalUrl = 'https://nebulae.raggiesoft.com/';

// Unpack top-level sections of `$loreData` into convenient variables for the HTML
// template below, defaulting each to an empty array `[]` so `foreach` loops never crash
// even if `ad-astra-lore.json` were temporarily unavailable.
$meta = $loreData['meta'] ?? [];
$links = $meta['links'] ?? [];
$telemetryBar = $loreData['telemetryBar'] ?? [];
$sensorHotspots = $loreData['sensorHotspots'] ?? [];
$surveyPillars = $loreData['surveyPillars'] ?? [];
$storyboardActs = $loreData['storyboardActs'] ?? [];

// Build the Schema.org JSON-LD ("JSON for Linked Data") knowledge graph as a nested
// PHP associative array (`'key' => 'value'` in PHP is equivalent to `{ key: "value" }`
// in JavaScript). Further down in `<head>`, `json_encode($schemaData)` turns this
// structure into machine-readable JSON so search engines understand how RaggieSoft,
// The Stardust Engine, the 15:33 song recording, and the Ad Astra book series connect.
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => 'https://raggiesoft.com/#organization',
            'name' => 'RaggieSoft',
            'url' => 'https://raggiesoft.com',
            'founder' => [
                '@type' => 'Person',
                '@id' => 'https://michaelpragsdale.com/#michael-ragsdale',
                'name' => 'Michael P. Ragsdale',
                'url' => 'https://michaelpragsdale.com',
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => 'https://nebulae.raggiesoft.com/#website',
            'url' => 'https://nebulae.raggiesoft.com',
            'name' => 'RaggieSoft Nebulae — Caelum-IV Planetary Survey',
            'description' => $ogDesc,
            'inLanguage' => 'en-US',
            'publisher' => [
                '@id' => 'https://raggiesoft.com/#organization',
            ],
        ],
        [
            '@type' => 'WebPage',
            '@id' => 'https://nebulae.raggiesoft.com/#webpage',
            'url' => $canonicalUrl,
            'name' => $pageTitle,
            'description' => $ogDesc,
            'inLanguage' => 'en-US',
            'isPartOf' => [
                '@id' => 'https://nebulae.raggiesoft.com/#website',
            ],
            'primaryImageOfPage' => [
                '@type' => 'ImageObject',
                'url' => $ogImageUrl,
                'width' => 1200,
                'height' => 675,
            ],
            'mainEntity' => [
                '@id' => 'https://nebulae.raggiesoft.com/#short-film-experience',
            ],
        ],
        [
            '@type' => 'CreativeWork',
            '@id' => 'https://nebulae.raggiesoft.com/#short-film-experience',
            'name' => $meta['title'] ?? $pageTitle,
            'headline' => $ogTitle,
            'description' => $ogDesc,
            'url' => $canonicalUrl,
            'image' => [$heroImageUrl, $ogImageUrl],
            'license' => 'https://creativecommons.org/licenses/by-sa/4.0/',
            'inLanguage' => 'en-US',
            'author' => [
                '@type' => 'Person',
                '@id' => 'https://michaelpragsdale.com/#michael-ragsdale',
                'name' => 'Michael P. Ragsdale',
                'url' => 'https://michaelpragsdale.com',
            ],
            'publisher' => [
                '@id' => 'https://raggiesoft.com/#organization',
            ],
            'about' => [
                '@type' => 'MusicRecording',
                'name' => 'Escape Velocity (Ad Astra)',
                'isrcCode' => $meta['fullSuiteIsrc'] ?? 'QZTB62697616',
                'duration' => 'PT15M33S',
                'url' => $links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra',
                'byArtist' => [
                    '@type' => 'MusicGroup',
                    '@id' => 'https://stardust.raggiesoft.com/#musicgroup',
                    'name' => 'The Stardust Engine',
                    'url' => 'https://stardust.raggiesoft.com',
                ],
            ],
            'mentions' => [
                [
                    '@type' => 'BookSeries',
                    'name' => 'Escape Velocity: Ad Astra (Stardate 49601 Chronicles)',
                    'url' => 'https://books.raggiesoft.com/ad-astra',
                ],
                [
                    '@type' => 'Article',
                    '@id' => 'https://raggiesoft.com/in-memoriam#article',
                    'headline' => 'In Memoriam: Sir Patrick Stewart (1940–2026) — Second Star to the Right',
                    'url' => 'https://raggiesoft.com/in-memoriam',
                ],
            ],
        ],
    ],
];
// Notice the closing PHP tag right below: it exits pure-PHP mode and switches into
// HTML template mode! Everything outside PHP blocks is sent directly to the visitor's
// browser as HTML, while inline PHP `echo e(...)` expressions inject escaped values
// right into HTML attributes and text nodes.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php if ($analyticsEnabled && $analyticsTrackingId !== ''): ?>
  <!-- Google Analytics (Resolved dynamically from settings.json; async prevents blocking page render) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($analyticsTrackingId); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo e($analyticsTrackingId); ?>');
  </script>
  <?php endif; ?>

  <!-- Character encoding (UTF-8 supports symbols and smart punctuation) and mobile responsive viewport scaling -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Modern Web Guidance (dark-mode): Tell the browser's native scrollbars and form controls that both dark and light schemes are supported -->
  <meta name="color-scheme" content="dark light">

  <!-- Browser tab title and search-engine snippet description -->
  <title><?php echo e($pageTitle); ?></title>
  <meta name="description" content="<?php echo e($ogDesc); ?>">
  <!-- Search indexing control: tell crawlers not to index 404 error URLs, or declare the single authoritative URL on valid requests -->
  <?php if ($isNotFound): ?>
  <meta name="robots" content="noindex, follow">
  <?php else: ?>
  <link rel="canonical" href="<?php echo e($canonicalUrl); ?>">
  <?php endif; ?>

  <!-- OpenGraph and Twitter Card Metadata: controls the rich 1200x675 preview card when this link is shared on chat apps or social media -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="RaggieSoft Nebulae">
  <meta property="og:locale" content="en_US">
  <meta property="og:title" content="<?php echo e($ogTitle); ?>">
  <meta property="og:description" content="<?php echo e($ogDesc); ?>">
  <meta property="og:url" content="<?php echo e($canonicalUrl); ?>">
  <meta property="og:image" content="<?php echo e($ogImageUrl); ?>">
  <meta property="og:image:secure_url" content="<?php echo e($ogImageUrl); ?>">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="675">
  <meta property="og:image:alt" content="<?php echo e($meta['heroImageAlt'] ?? 'The crew of the U.S.S. Aethelgard looking out from the open cargo hatch onto the purple-sand beach and ringed gas giant Vespera on Caelum-IV.'); ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo e($ogTitle); ?>">
  <meta name="twitter:description" content="<?php echo e($ogDesc); ?>">
  <meta name="twitter:image" content="<?php echo e($ogImageUrl); ?>">
  <meta name="twitter:image:alt" content="<?php echo e($meta['heroImageAlt'] ?? 'The crew of the U.S.S. Aethelgard looking out from the open cargo hatch onto the purple-sand beach and ringed gas giant Vespera on Caelum-IV.'); ?>">

  <!-- Tints mobile browser address bars to match Cosmic Void dark mode (#0b0914) or LCARS Parchment light mode (#f8f5f0) -->
  <meta name="theme-color" content="#0b0914" media="(prefers-color-scheme: dark)">
  <meta name="theme-color" content="#f8f5f0" media="(prefers-color-scheme: light)">

  <!-- Favicons for desktop tabs and iOS home-screen bookmarks -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/favicon-16x16.png">
  <link rel="shortcut icon" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/favicon.ico">

  <!-- Modern Web Guidance (optimize-image-priority): Preload the main 16:9 cargo-hatch artwork immediately so Largest Contentful Paint (LCP) finishes fast -->
  <link rel="preload" as="image" href="<?php echo e($heroImageUrl); ?>" fetchpriority="high">

  <!-- Typography (Audiowide display headers + Titillium Web body copy) and Network/Nebulae Stylesheets -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Titillium+Web:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e($networkCssUrl); ?>">
  <link rel="stylesheet" href="<?php echo e($nebulaeCssUrl); ?>">

  <!-- Early Synchronous Theme Restoration: runs BEFORE the body paints so a user who chose Light or Dark mode never sees a brief flash of the wrong background color -->
  <script>
    (function () {
      try {
        var saved = localStorage.getItem('nebulae_theme');
        if (saved === 'light' || saved === 'dark') {
          document.documentElement.setAttribute('data-theme', saved);
          document.documentElement.setAttribute('data-bs-theme', saved);
        }
      } catch (e) {}
    })();
  </script>

  <!-- Schema.org JSON-LD Structured Data serialized directly from PHP's $schemaData array -->
  <script type="application/ld+json">
<?php echo json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>

  <!-- Deferred Scripts: `defer` downloads JavaScript in parallel without blocking HTML parsing, executing right before DOMContentLoaded -->
  <script src="<?php echo e($networkJsUrl); ?>" defer></script>
  <script src="<?php echo e($nebulaeJsUrl); ?>" defer data-lore-json="<?php echo e($loreJsonUrl); ?>"></script>
</head>
<body>
  <!-- Accessible Skip Link (WCAG 2.4.1): hidden visually until a keyboard user presses Tab, letting them jump straight past navigation bars to main content -->
  <a href="#main-content" class="skip-link visually-hidden">Skip to main content</a>

  <!-- Centralized Polite Live Region: when `nebulae.js` writes text into this hidden box, screen readers read the update aloud after finishing their current sentence -->
  <div id="nebulae-live-announcer" class="visually-hidden" aria-live="polite" aria-atomic="true"></div>

  <!-- RaggieSoft Ecosystem Global Network Bar: cross-property navigation landmark (`aria-current="page"` marks Nebulae as active) -->
  <nav class="rs-network-bar" aria-label="RaggieSoft Ecosystem">
    <div class="rs-network-bar-inner">
      <span class="rs-network-label">✦ RaggieSoft Network:</span>
      <ul class="rs-network-links">
        <li><a href="https://raggiesoft.com">🌐 Hub</a></li>
        <li><a href="https://nebulae.raggiesoft.com" aria-current="page" class="is-active">🌌 Nebulae</a></li>
        <li><a href="https://music.raggiesoft.com">🎧 Music</a></li>
        <li><a href="https://books.raggiesoft.com">📚 Books</a></li>
        <li><a href="https://lore.raggiesoft.com">📜 Lore</a></li>
        <li><a href="https://stardust.raggiesoft.com">🚀 Stardust</a></li>
        <li><a href="https://engineroom.raggiesoft.com">⚙️ Engine Room</a></li>
        <li><a href="https://corporate.raggiesoft.com">🏢 Corporate</a></li>
        <li><a href="https://storetrainer.raggiesoft.com">💾 StoreTrainer</a></li>
        <li><a href="https://michaelpragsdale.com">👔 Portfolio &amp; Resume</a></li>
      </ul>
    </div>
  </nav>

  <!-- Subdomain Command Header: sticky frosted-glass header with brand lockup, in-page anchor links, and Dark/Light theme toggle button -->
  <header class="nebulae-header">
    <div class="nebulae-header-inner">
      <a href="/" class="brand-lockup">
        <span class="brand-badge">U.S.S. AETHELGARD</span>
        <span class="brand-titles">
          <span class="brand-title-main">Escape Velocity (Ad Astra)</span>
          <span class="brand-title-sub">1996 Short Film &amp; Caelum-IV Planetary Survey</span>
        </span>
      </a>

      <nav class="section-nav" aria-label="On-page sections">
        <ul>
          <li><a href="#landing-survey">01. Hatch Sensor Scan</a></li>
          <li><a href="#short-film-storyboard">02. 4-Act Short Film</a></li>
          <li><a href="#planetary-survey">03. Caelum-IV Lore</a></li>
          <li><a href="#cosmic-dedication">04. Ad Astra Tribute</a></li>
          <li>
            <!-- `type="button"` prevents accidental form submission; `aria-pressed` communicates toggle state to assistive tech -->
            <button type="button" id="nebulae-theme-toggle" class="theme-toggle-btn" aria-pressed="false">
              <span aria-hidden="true">◐</span>
              <span id="nebulae-theme-label">Theme: Cosmic Void (Dark)</span>
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Landmark (`tabindex="-1"` allows the Skip Link anchor `#main-content` to programmatically place keyboard focus here) -->
  <main id="main-content" class="nebulae-main" tabindex="-1">
    <?php if ($isNotFound): ?>
    <!-- Genuine 404 View: rendered only when `$isNotFound` is true for unknown paths -->
    <section class="section-block" aria-labelledby="nebulae-404-heading" style="margin-top: 2rem;">
      <div class="hero-intro">
        <div class="eyebrow-tag">
          <span>RAGGIESOFT NEBULAE • COORDINATES NOT FOUND</span>
        </div>
        <h1 id="nebulae-404-heading" class="hero-title">We Could Not Find That Page</h1>
        <p class="hero-lead">
          The planetary survey link or storyboard address you followed could not be found. Return to the Caelum-IV planetary survey below, or explore the companion music and novels across the RaggieSoft network.
        </p>
        <div class="hero-cta-row">
          <a href="/" class="btn-cosmic btn-cosmic-primary">🌌 Open Caelum-IV Planetary Survey</a>
          <a href="https://music.raggiesoft.com" class="btn-cosmic btn-cosmic-secondary">🎧 The Listening Room</a>
          <a href="https://books.raggiesoft.com" class="btn-cosmic btn-cosmic-secondary">📚 RaggieSoft Book Reader</a>
        </div>
      </div>
    </section>
    <?php else: ?>
    <!-- ======================================================================
         SECTION A: HERO AND INTERACTIVE "LANDING ON CAELUM-IV" SENSOR HOTSPOTS
         ====================================================================== -->
    <section id="landing-survey" aria-labelledby="hero-heading">
      <div class="hero-intro">
        <div class="eyebrow-tag">
          <!-- Decorative 120 BPM pulsing emerald indicator (`aria-hidden="true"` hides purely visual decoration from screen readers) -->
          <span class="pulse-dot" aria-hidden="true"></span>
          <span>PLANETARY TELEMETRY ACTIVE • 120.0 BPM HARMONIC LOCK • KEPLER-442c / CAELUM-IV</span>
        </div>

        <h1 id="hero-heading" class="hero-title">
          <?php echo e($meta['title'] ?? 'Escape Velocity (Ad Astra) — Interactive Short Film & Caelum-IV Planetary Survey'); ?>
        </h1>

        <p class="hero-lead">
          Imagining the 1996 cosmic short film for <a href="<?php echo e($links['stardustPortal'] ?? 'https://stardust.raggiesoft.com'); ?>"><strong>The Stardust Engine</strong></a>’s
          15-minute progressive rock opus, <strong>&ldquo;Escape Velocity (Ad Astra)&rdquo;</strong>—charting the O’Connell &amp; Wright family’s
          journey from the fluorescent claustrophobia of <em>The Cage</em> to touchdown aboard the <em>U.S.S. Aethelgard</em> on the
          tidally locked, purple-ocean sanctuary moon <strong>Caelum-IV</strong>.
        </p>

        <!-- Primary and Secondary Call-to-Action Links into Music and Book Reader subdomains -->
        <div class="hero-cta-row">
          <a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra'); ?>"
             class="btn-cosmic btn-cosmic-primary">
            <span aria-hidden="true">🎧</span>
            <span>Stream the 15:33 Full Suite in The Listening Room</span>
          </a>
          <a href="<?php echo e($links['listeningRoomRadioEdit'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra-radio-edit'); ?>"
             class="btn-cosmic btn-cosmic-secondary">
            <span aria-hidden="true">📻</span>
            <span>Listen to the 5:09 Radio Edit</span>
          </a>
          <a href="<?php echo e($links['bookReaderAdAstra'] ?? 'https://books.raggiesoft.com/ad-astra'); ?>"
             class="btn-cosmic btn-cosmic-secondary">
            <span aria-hidden="true">📚</span>
            <span>Read Escape Velocity: Ad Astra in Book Reader</span>
          </a>
          <a href="<?php echo e($links['bookReaderStardust'] ?? 'https://books.raggiesoft.com/stardust-engine'); ?>"
             class="btn-cosmic btn-cosmic-secondary">
            <span aria-hidden="true">📖</span>
            <span>The Stardust Engine Chronicles</span>
          </a>
        </div>
      </div>

      <!-- Planetary Telemetry Strip: uses a semantic HTML description list (dl -> dt term + dd value) populated from `ad-astra-lore.json` -->
      <aside aria-label="Caelum-IV Planetary Telemetry Summary">
        <dl class="telemetry-grid">
          <?php foreach ($telemetryBar as $stat): ?>
          <div class="telemetry-item">
            <dt class="telemetry-label"><?php echo e($stat['label'] ?? ''); ?></dt>
            <dd class="telemetry-value"><?php echo e($stat['value'] ?? ''); ?></dd>
          </div>
          <?php endforeach; ?>
        </dl>
      </aside>

      <!-- 16:9 Widescreen U.S.S. Aethelgard Cargo Hatch Viewport with Overlaid Interactive Hotspot Pins -->
      <figure class="hatch-frame">
        <div class="hatch-status-bar">
          <div class="hatch-status-left">
            <span class="hatch-badge">AFT CARGO HATCH // OPEN</span>
            <span>VIEWPORT: CAELUM-IV BAY (&ldquo;SANCTUARY&rdquo;)</span>
          </div>
          <div class="hatch-status-right">
            <span>SELECT ANY SENSOR HOTSPOT PIN OR CONSOLE TAB BELOW TO SCAN</span>
          </div>
        </div>

        <div class="viewport-stage">
          <!-- Modern Web Guidance (optimize-image-priority): explicit width and height reserve exact 16:9 space before load to prevent layout shift (CLS = 0) -->
          <img
            src="<?php echo e($heroImageUrl); ?>"
            alt="<?php echo e($meta['heroImageAlt'] ?? 'The crew of the U.S.S. Aethelgard looking out from the open cargo hatch onto the violet ocean and purple basaltic beach of Caelum-IV under the ringed gas giant Vespera.'); ?>"
            width="<?php echo (int) ($meta['heroImageWidth'] ?? 2752); ?>"
            height="<?php echo (int) ($meta['heroImageHeight'] ?? 1536); ?>"
            fetchpriority="high"
          >

          <?php
          // Loop over every sensor hotspot from `ad-astra-lore.json` and place a real `<button>`
          // over the 16:9 image using percentage X/Y coordinates passed into CSS variables!
          // The first hotspot (`$index === 0`) starts expanded (`aria-expanded="true"`) by default.
          foreach ($sensorHotspots as $index => $spot):
            $spotId = (string) ($spot['id'] ?? ('sensor-' . $index));
            $panelId = 'panel-' . $spotId;
            $isFirst = ($index === 0);
            $coordX = (float) ($spot['coordinates']['x'] ?? 50);
            $coordY = (float) ($spot['coordinates']['y'] ?? 50);
          ?>
          <button
            type="button"
            class="hotspot-pin"
            style="--pin-x: <?php echo e($coordX); ?>; --pin-y: <?php echo e($coordY); ?>;"
            data-sensor-target="<?php echo e($panelId); ?>"
            aria-expanded="<?php echo $isFirst ? 'true' : 'false'; ?>"
            aria-controls="<?php echo e($panelId); ?>"
          >
            <span class="hotspot-pin-dot" aria-hidden="true"></span>
            <span class="hotspot-pin-code"><?php echo e($spot['code'] ?? ''); ?></span>
            <span class="hotspot-pin-label"><?php echo e($spot['shortLabel'] ?? ''); ?></span>
          </button>
          <?php endforeach; ?>
        </div>

        <figcaption class="hatch-caption">
          <strong>Act IV Touchdown Frame (12:15 – 15:33):</strong> Looking out from the open aft ramp of the <em>U.S.S. Aethelgard</em> onto
          Caelum-IV (&ldquo;Aethelgard’s Shore&rdquo;). Left to right: Pilot/Co-Pilot twin <strong>Tyler/Evan Wright</strong>, lead guitarist
          <strong>Ryan O’Connell</strong> seated in his manual off-road wheelchair at the top of the ramp, lead vocalist
          <strong>Cassidy O’Connell</strong> opening hailing frequencies at 120 BPM, and band manager <strong>Holly O’Connell</strong> logging
          planetary telemetry at the starboard console.
        </figcaption>
      </figure>

      <!-- Accessible Below-Viewport Sensor Selector Buttons: mirrors the overlaid pins in a clean grid for mobile touch users and keyboard navigation -->
      <div class="sensor-selector-bar" role="group" aria-label="Planetary Sensor Hotspot Controls">
        <?php foreach ($sensorHotspots as $index => $spot):
          $spotId = (string) ($spot['id'] ?? ('sensor-' . $index));
          $panelId = 'panel-' . $spotId;
          $isFirst = ($index === 0);
        ?>
        <button
          type="button"
          class="sensor-tab-btn"
          data-sensor-target="<?php echo e($panelId); ?>"
          aria-expanded="<?php echo $isFirst ? 'true' : 'false'; ?>"
          aria-controls="<?php echo e($panelId); ?>"
        >
          <span class="sensor-tab-code"><?php echo e($spot['code'] ?? ''); ?> • <?php echo e($spot['category'] ?? ''); ?></span>
          <span class="sensor-tab-title"><?php echo e($spot['shortLabel'] ?? ''); ?></span>
        </button>
        <?php endforeach; ?>
      </div>

      <!-- Sensor Telemetry Readout Panels: only the active panel omits the HTML `hidden` attribute; `nebulae.js` swaps `hidden` when a user clicks any pin or tab -->
      <div class="sensor-readout-deck">
        <?php foreach ($sensorHotspots as $index => $spot):
          $spotId = (string) ($spot['id'] ?? ('sensor-' . $index));
          $panelId = 'panel-' . $spotId;
          $isFirst = ($index === 0);
        ?>
        <article
          id="<?php echo e($panelId); ?>"
          class="sensor-panel"
          <?php echo $isFirst ? '' : 'hidden'; ?>
        >
          <div class="sensor-panel-header">
            <div>
              <span class="sensor-panel-category"><?php echo e($spot['code'] ?? ''); ?> // <?php echo e($spot['category'] ?? ''); ?></span>
              <h3><?php echo e($spot['title'] ?? ''); ?></h3>
            </div>
          </div>

          <p class="sensor-panel-summary"><?php echo e($spot['summary'] ?? ''); ?></p>

          <div class="sensor-details-grid">
            <?php foreach (($spot['details'] ?? []) as $detail): ?>
            <div class="sensor-detail-card">
              <h4><?php echo e($detail['heading'] ?? ''); ?></h4>
              <p><?php echo e($detail['body'] ?? ''); ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ======================================================================
         SECTION B: THE 1996 "SHORT FILM IN SPACE" 4-ACT DIRECTOR'S STORYBOARD
         ====================================================================== -->
    <section id="short-film-storyboard" class="section-block" aria-labelledby="storyboard-heading">
      <div class="section-header">
        <div class="eyebrow-tag">
          <span>1996 LONG-FORM VISUAL CONCEPT • 15:33 PROGRESSIVE ROCK SUITE (ISRC: <?php echo e($meta['fullSuiteIsrc'] ?? 'QZTB62697616'); ?>)</span>
        </div>
        <h2 id="storyboard-heading" class="section-title">
          The 1996 &ldquo;Short Film in Space&rdquo; Storyboard (4-Movement Director’s Treatment)
        </h2>
        <p class="section-subtitle">
          Conceived in 1996 as an ambitious, 15-minute theatrical short film in space structured around the four movements of
          <a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra'); ?>"><strong>&ldquo;Escape Velocity (Ad Astra)&rdquo;</strong></a>
          (and originally unveiled as the B-Side closer of 1995’s
          <a href="<?php echo e($links['listeningRoomWarehouseTapes'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1995-the-warehouse-tapes/escape-velocity-ad-astra'); ?>"><em>The Warehouse Tapes</em></a>).
          Filter by movement below to inspect the cinematography, studio production lore, and lyrics.
        </p>
      </div>

      <!-- Interactive Act Filter Controls: `nebulae.js` toggles `aria-pressed` and filters `.act-card` elements by `data-act-id` -->
      <div class="act-filter-bar" role="group" aria-label="Filter storyboard by movement">
        <button type="button" class="act-filter-btn" data-act-filter="all" aria-pressed="true">
          All 4 Acts (0:00 – 15:33)
        </button>
        <?php foreach ($storyboardActs as $act): ?>
        <button
          type="button"
          class="act-filter-btn"
          data-act-filter="<?php echo e($act['id'] ?? ''); ?>"
          aria-pressed="false"
        >
          <?php echo e($act['actNumber'] ?? ''); ?>: <?php echo e($act['movementTitle'] ?? ''); ?> (<?php echo e($act['timecode'] ?? ''); ?>)
        </button>
        <?php endforeach; ?>
      </div>

      <!-- Storyboard Movement Cards: each Act renders its set design, visual treatment, director's note, audio cue, and lyric excerpt -->
      <div class="storyboard-grid">
        <?php foreach ($storyboardActs as $act): ?>
        <article class="act-card" data-act-id="<?php echo e($act['id'] ?? ''); ?>">
          <div class="act-card-header">
            <div class="act-badge-group">
              <span class="act-number-pill"><?php echo e($act['actNumber'] ?? ''); ?></span>
              <span class="act-timecode-pill"><?php echo e($act['timecode'] ?? ''); ?></span>
              <h3><?php echo e($act['movementTitle'] ?? ''); ?></h3>
            </div>
            <span class="act-tempo"><?php echo e($act['tempoAndKey'] ?? ''); ?></span>
          </div>

          <div class="act-card-body">
            <div>
              <div class="act-meta-label">Location &amp; Set Design</div>
              <p class="act-prose"><strong><?php echo e($act['setting'] ?? ''); ?></strong></p>

              <div class="act-meta-label">Widescreen Visual Treatment</div>
              <p class="act-prose"><?php echo e($act['visualTreatment'] ?? ''); ?></p>

              <div class="act-meta-label">Director’s &amp; Studio Lore Note</div>
              <p class="act-prose"><?php echo e($act['directorNotes'] ?? ''); ?></p>

              <div class="act-meta-label">Audio &amp; Instrumentation Cue</div>
              <p class="act-prose"><?php echo e($act['audioProductionCue'] ?? ''); ?></p>
            </div>

            <figure class="act-lyrics-box">
              <figcaption>
                Canonical Movement Lyrics — <cite>Escape Velocity (Ad Astra)</cite>
              </figcaption>
              <blockquote cite="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra'); ?>">
                <p>
                  <?php
                  // Convert the array of lyric lines into safe HTML separated by line-break elements:
                  // `array_map` works just like JavaScript's `.map()`, escaping each non-empty line via `e()`
                  // and joining them together with `implode()` (PHP's equivalent of JS `.join()`).
                  $lines = $act['lyricsExcerpt'] ?? [];
                  $escapedLines = array_map(static fn($line) => $line === '' ? '<br>' : e($line), $lines);
                  echo implode("<br>\n                  ", $escapedLines);
                  ?>
                </p>
              </blockquote>
            </figure>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ======================================================================
         SECTION C: PLANETARY SURVEY AND WORLDBUILDING LORE (CAELUM-IV DOSSIER)
         ====================================================================== -->
    <section id="planetary-survey" class="section-block" aria-labelledby="survey-heading">
      <div class="section-header">
        <div class="eyebrow-tag">
          <span>PART 1 // PLANETARY SURVEY &amp; WORLDBUILDING LORE • SOUND, RESONANCE &amp; LOW-SENSORY PEACE</span>
        </div>
        <h2 id="survey-heading" class="section-title">
          Caelum-IV Planetary Survey &amp; Worldbuilding Lore
        </h2>
        <p class="section-subtitle">
          To make this exoplanet fit seamlessly into <a href="<?php echo e($links['stardustPortal'] ?? 'https://stardust.raggiesoft.com'); ?>"><em>The Stardust Engine</em></a>
          canon alongside the <em>U.S.S. Aethelgard</em>, the
          <a href="<?php echo e($links['listeningRoomTwinMoons'] ?? 'https://music.raggiesoft.com/the-stardust-engine/2003-sanctuary-zero-g/moon-1-tidal-lock'); ?>"><em>Twin Moons</em></a>
          project, and the lyrics of <a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra'); ?>">&ldquo;Escape Velocity (Ad Astra),&rdquo;</a>
          the science and lore of Caelum-IV reflect <strong>sound, resonance, and low-sensory peace</strong>—the exact polar opposite
          of the noisy, litigious &ldquo;Cage&rdquo; the family escaped back on Earth.
        </p>
      </div>

      <!-- Worldbuilding Lore Pillars: rendered as responsive cards containing semantic description lists -->
      <div class="pillars-grid">
        <?php foreach ($surveyPillars as $pillar): ?>
        <article class="pillar-card">
          <span class="pillar-eyebrow">SECTION <?php echo e($pillar['number'] ?? ''); ?> // <?php echo e($pillar['eyebrow'] ?? ''); ?></span>
          <h3 class="pillar-title"><?php echo e($pillar['number'] ?? ''); ?>. <?php echo e($pillar['title'] ?? ''); ?></h3>
          <p class="pillar-intro"><?php echo e($pillar['intro'] ?? ''); ?></p>

          <dl class="pillar-dl">
            <?php foreach (($pillar['items'] ?? []) as $item): ?>
            <div class="pillar-dl-item">
              <dt><?php echo e($item['term'] ?? ''); ?></dt>
              <dd><?php echo e($item['description'] ?? ''); ?></dd>
            </div>
            <?php endforeach; ?>
          </dl>
        </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ======================================================================
         SECTION D: PERMANENT CREATOR'S COSMIC DEDICATION (SIR PATRICK STEWART)
         ====================================================================== -->
    <section id="cosmic-dedication" aria-labelledby="dedication-heading">
      <div class="dedication-banner">
        <div class="eyebrow-tag">
          <span>✦ SECOND STAR TO THE RIGHT • IN MEMORIAM: SIR PATRICK STEWART (JULY 13, 1940 – OCTOBER 28, 2026)</span>
        </div>
        <h2 id="dedication-heading">
          Why the Crew of the <em>Aethelgard</em> Opens Hailing Frequencies Instead of Planting a Flag
        </h2>
        <p>
          Every starship bridge, LCARS-inspired telemetry console, and tidal-locked horizon across the RaggieSoft network traces back
          to a childhood living room ritual—watching <em>Local News</em>, <em>National News</em>, <em>Wheel of Fortune</em>,
          <em>Jeopardy!</em>, and <em>Star Trek: The Next Generation</em> together as a family every weeknight. Watching the Captain
          of the <em>NCC-1701-D</em> taught a kid to look up at the night sky, wonder what is out there, and believe that when humanity
          reaches a new shore like Caelum-IV, we arrive with curiosity, empathy, and open hailing frequencies.
        </p>
        <p>
          <a href="<?php echo e($links['inMemoriamTribute'] ?? 'https://raggiesoft.com/in-memoriam'); ?>">
            Read Michael P. Ragsdale’s Full Cosmic Tribute &amp; Dedication at raggiesoft.com/in-memoriam &rarr;
          </a>
        </p>
      </div>
    </section>
    <?php endif; ?>
  </main>

  <!-- Global Footer, Dual Licensing Notice (MIT + CC BY-SA 4.0), and Mandatory Fictitious Persons/Entities Disclaimer -->
  <footer class="nebulae-footer">
    <div class="nebulae-footer-inner">
      <ul class="footer-links">
        <li><a href="https://raggiesoft.com">RaggieSoft Hub</a></li>
        <li><a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single/escape-velocity-ad-astra'); ?>">Stream &ldquo;Escape Velocity (Ad Astra)&rdquo;</a></li>
        <li><a href="https://books.raggiesoft.com">RaggieSoft Book Reader</a></li>
        <li><a href="https://stardust.raggiesoft.com">The Stardust Engine Portal</a></li>
        <li><a href="https://engineroom.raggiesoft.com">Engine Room Records</a></li>
        <li><a href="https://corporate.raggiesoft.com/licensing">Licenses (MIT Code / CC BY-SA 4.0 Content)</a></li>
        <li><a href="https://raggiesoft.com/in-memoriam">In Memoriam: Sir Patrick Stewart</a></li>
      </ul>

      <!-- `date('Y')` prints the current 4-digit server year automatically so the copyright range never goes stale -->
      <p>
        &copy; 2008 &ndash; <?php echo date('Y'); ?> <strong>Michael P. Ragsdale</strong> (RaggieSoft / RaggieSoft Media / Engine Room Records / Ocean View Archives).
        All software source code is licensed under the <a href="https://corporate.raggiesoft.com/licensing">MIT License</a>;
        all narrative prose, planetary lore, artwork, and musical compositions are licensed under
        <a href="https://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)</a>
        alongside applicable DSP consumer streaming and direct commercial sync licenses.
      </p>

      <div class="fictitious-disclaimer">
        <strong>Fictitious Persons &amp; Entities Disclaimer:</strong> All narrative characters (including Cassidy, Ryan, and Holly O’Connell,
        and Tyler and Evan Wright), bands (The Stardust Engine), starships (<em>U.S.S. Aethelgard</em>), exoplanets and moons
        (Vespera / Kepler-442c, Caelum-IV, Lumen, Umbra, Solis-V), universities (including Commonwealth Polytechnic Institute / CPI,
        The Forgers, and The Crucible), corporations (including OmniCorp, Apex Records, Prairie Coachworks, and Sainte-Claire),
        transit agencies (Blue Ridge Transit), in-universe legal filings (including <em>Engine Room Records, LLC</em> and
        <em>The O’Connell Family, LLC</em>), and events depicted on this property are works of fiction. Any resemblance to actual
        persons, living or dead, businesses, institutions, or events is purely coincidental.
      </div>
    </div>
  </footer>
</body>
</html>
