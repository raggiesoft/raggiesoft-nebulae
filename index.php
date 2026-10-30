<?php
declare(strict_types=1);

/**
 * ============================================================================
 * THE RAGGIESOFT NEBULAE (nebulae.raggiesoft.com)
 * "Escape Velocity (Ad Astra)" — Interactive Short Film & Planetary Survey
 * ============================================================================
 * File: /raggiesoft-servers/raggiesoft.com/subdomains/nebulae/index.php
 * Production URL: https://nebulae.raggiesoft.com/
 * Stack: PHP 8.5 + Semantic HTML5 + WCAG 2.1 AA / Section 508 Adaptive CSS
 * Licenses: MIT License (Code) & CC BY-SA 4.0 (Creative Content)
 *
 * ARCHITECTURAL & MAINTENANCE OVERVIEW:
 * 1. Global Settings Resolution (`settings.json`):
 *    - Dynamically inspects the RaggieSoft server hierarchy (`../../www/data/settings.json`,
 *      `/var/www/raggiesoft.com/data/settings.json`, or local `./data/settings.json`)
 *      to resolve `cdnBaseUrl` (`https://assets.raggiesoft.com`) and the Google
 *      Analytics (`gtag.js`) tracking configuration (`G-P9RG9JVYB6`).
 *    - Resolves all static assets (`css`, `js`, `images`, `json`) dynamically via
 *      `$cdnBaseUrl . '/nebulae/...'`.
 * 2. Zero-Database Structured Lore Architecture (`ad-astra-lore.json`):
 *    - Reads the canonical planetary telemetry, crew hotspot profiles, 4-act
 *      1996 short-film storyboard treatment, and astrophysical/xenobotanical
 *      worldbuilding lore from `ad-astra-lore.json`.
 * 3. Accessibility & Progressive Enhancement (WCAG 2.1 AA / 7:1 AAA):
 *    - Semantic HTML5 landmarks (`<header>`, `<nav>`, `<main>`, `<section>`,
 *      `<article>`, `<aside>`, `<footer>`), native `<button>` hotspot triggers
 *      with `aria-expanded` and `aria-controls`, centralized `aria-live="polite"`
 *      telemetry announcer, and full support for `@media (prefers-color-scheme: dark | light)`
 *      and `@media (prefers-reduced-motion: reduce)`.
 * ============================================================================
 */

// ----------------------------------------------------------------------------
// 1. RESOLVE GLOBAL SETTINGS (`settings.json`)
// ----------------------------------------------------------------------------
$settingsCandidates = [
    dirname(__DIR__, 2) . '/www/data/settings.json',
    '/var/www/raggiesoft.com/data/settings.json',
    __DIR__ . '/data/settings.json',
];

$settings = [];
foreach ($settingsCandidates as $candidatePath) {
    if (is_file($candidatePath) && is_readable($candidatePath)) {
        $decoded = json_decode((string) file_get_contents($candidatePath), true);
        if (is_array($decoded)) {
            $settings = $decoded;
            break;
        }
    }
}

$cdnBaseUrl = rtrim((string) ($settings['cdnBaseUrl'] ?? 'https://assets.raggiesoft.com'), '/');
$analyticsEnabled = (bool) ($settings['analytics']['enabled'] ?? true);
$analyticsTrackingId = (string) ($settings['analytics']['trackingId'] ?? 'G-P9RG9JVYB6');

// Asset URLs resolved dynamically through $cdnBaseUrl + '/nebulae/...'
$assetVersion = '20261029f';
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

// Fallback to CDN URL if local filesystem mirrors are unavailable
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
 * HTML-escape helper for safe template output.
 */
function e(mixed $value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// ----------------------------------------------------------------------------
// 3. SEO, OPENGRAPH & SCHEMA.ORG METADATA (<= 60 CHAR TITLE, <= 155 CHAR DESC)
// ----------------------------------------------------------------------------
$pageTitle = 'Escape Velocity (Ad Astra) | RaggieSoft Nebulae';
$ogTitle   = 'Escape Velocity (Ad Astra) — Short Film & Survey';
$ogDesc    = 'Explore the 1996 Escape Velocity (Ad Astra) short film storyboard and Caelum-IV planetary survey aboard the U.S.S. Aethelgard.';
$canonicalUrl = 'https://nebulae.raggiesoft.com/';

$meta = $loreData['meta'] ?? [];
$links = $meta['links'] ?? [];
$telemetryBar = $loreData['telemetryBar'] ?? [];
$sensorHotspots = $loreData['sensorHotspots'] ?? [];
$surveyPillars = $loreData['surveyPillars'] ?? [];
$storyboardActs = $loreData['storyboardActs'] ?? [];

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
                'url' => $links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-01-escape-velocity-ad-astra',
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php if ($analyticsEnabled && $analyticsTrackingId !== ''): ?>
  <!-- Google Analytics (Resolved dynamically from settings.json) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($analyticsTrackingId); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo e($analyticsTrackingId); ?>');
  </script>
  <?php endif; ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Modern Web Guidance (dark-mode): Declare support for both dark and light color schemes -->
  <meta name="color-scheme" content="dark light">

  <title><?php echo e($pageTitle); ?></title>
  <meta name="description" content="<?php echo e($ogDesc); ?>">
  <link rel="canonical" href="<?php echo e($canonicalUrl); ?>">

  <!-- OpenGraph & Twitter Card Metadata (Mandatory Network Standard — 1200x675 sips OG Image) -->
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

  <meta name="theme-color" content="#0b0914" media="(prefers-color-scheme: dark)">
  <meta name="theme-color" content="#f8f5f0" media="(prefers-color-scheme: light)">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/favicon-16x16.png">
  <link rel="shortcut icon" href="<?php echo e($cdnBaseUrl); ?>/common/images/favicons/favicon.ico">

  <!-- Modern Web Guidance (optimize-image-priority): Preload LCP Hero Image -->
  <link rel="preload" as="image" href="<?php echo e($heroImageUrl); ?>" fetchpriority="high">

  <!-- Typography & Network Stylesheets -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Titillium+Web:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e($networkCssUrl); ?>">
  <link rel="stylesheet" href="<?php echo e($nebulaeCssUrl); ?>">

  <!-- Early Synchronous Theme Restoration (Prevents Flash of Un-themed Content) -->
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

  <!-- Schema.org JSON-LD Structured Data -->
  <script type="application/ld+json">
<?php echo json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>

  <!-- Deferred Scripts (Served via assets.raggiesoft.com) -->
  <script src="<?php echo e($networkJsUrl); ?>" defer></script>
  <script src="<?php echo e($nebulaeJsUrl); ?>" defer data-lore-json="<?php echo e($loreJsonUrl); ?>"></script>
</head>
<body>
  <!-- Accessible Skip Link (Modern Web Guidance `accessibility`) -->
  <a href="#main-content" class="skip-link visually-hidden">Skip to main content</a>

  <!-- Centralized Polite Live Region for Interactive Sensor & Storyboard Updates -->
  <div id="nebulae-live-announcer" class="visually-hidden" aria-live="polite" aria-atomic="true"></div>

  <!-- RaggieSoft Ecosystem Global Network Bar -->
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
        <li><a href="https://michaelpragsdale.com">👔 Michael P. Ragsdale</a></li>
      </ul>
    </div>
  </nav>

  <!-- Subdomain Command Header -->
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
            <button type="button" id="nebulae-theme-toggle" class="theme-toggle-btn" aria-pressed="false">
              <span aria-hidden="true">◐</span>
              <span id="nebulae-theme-label">Theme: Cosmic Void (Dark)</span>
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main-content" class="nebulae-main" tabindex="-1">
    <!-- ======================================================================
         SECTION A: HERO & INTERACTIVE "LANDING ON CAELUM-IV" SENSOR HOTSPOTS
         ====================================================================== -->
    <section id="landing-survey" aria-labelledby="hero-heading">
      <div class="hero-intro">
        <div class="eyebrow-tag">
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

        <div class="hero-cta-row">
          <a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-01-escape-velocity-ad-astra'); ?>"
             class="btn-cosmic btn-cosmic-primary">
            <span aria-hidden="true">🎧</span>
            <span>Stream the 15:33 Full Suite in The Listening Room</span>
          </a>
          <a href="<?php echo e($links['listeningRoomRadioEdit'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-02-escape-velocity-ad-astra-radio-edit'); ?>"
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

      <!-- Planetary Telemetry Strip -->
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

      <!-- 16:9 Widescreen U.S.S. Aethelgard Cargo Hatch Viewport -->
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
          <!-- Modern Web Guidance (optimize-image-priority): fetchpriority="high" + explicit width/height -->
          <img
            src="<?php echo e($heroImageUrl); ?>"
            alt="<?php echo e($meta['heroImageAlt'] ?? 'The crew of the U.S.S. Aethelgard looking out from the open cargo hatch onto the violet ocean and purple basaltic beach of Caelum-IV under the ringed gas giant Vespera.'); ?>"
            width="<?php echo (int) ($meta['heroImageWidth'] ?? 2752); ?>"
            height="<?php echo (int) ($meta['heroImageHeight'] ?? 1536); ?>"
            fetchpriority="high"
          >

          <?php foreach ($sensorHotspots as $index => $spot):
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

      <!-- Accessible Below-Viewport Sensor Selector Buttons -->
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

      <!-- Sensor Telemetry Readout Panels -->
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
          <a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-01-escape-velocity-ad-astra'); ?>"><strong>&ldquo;Escape Velocity (Ad Astra)&rdquo;</strong></a>
          (and originally unveiled as the B-Side closer of 1995’s
          <a href="<?php echo e($links['listeningRoomWarehouseTapes'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1995-the-warehouse-tapes?track=1-06-escape-velocity-ad-astra'); ?>"><em>The Warehouse Tapes</em></a>).
          Filter by movement below to inspect the cinematography, studio production lore, and lyrics.
        </p>
      </div>

      <!-- Interactive Act Filter Controls -->
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
              <blockquote cite="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-01-escape-velocity-ad-astra'); ?>">
                <p>
                  <?php
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
         SECTION C: PLANETARY SURVEY & WORLDBUILDING LORE (CAELUM-IV DOSSIER)
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
          <a href="<?php echo e($links['listeningRoomTwinMoons'] ?? 'https://music.raggiesoft.com/the-stardust-engine/2003-sanctuary-zero-g?track=1-01-moon-1-tidal-lock'); ?>"><em>Twin Moons</em></a>
          project, and the lyrics of <a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-01-escape-velocity-ad-astra'); ?>">&ldquo;Escape Velocity (Ad Astra),&rdquo;</a>
          the science and lore of Caelum-IV reflect <strong>sound, resonance, and low-sensory peace</strong>—the exact polar opposite
          of the noisy, litigious &ldquo;Cage&rdquo; the family escaped back on Earth.
        </p>
      </div>

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
  </main>

  <!-- Global Footer & Mandatory Fictitious Persons/Entities Disclaimer -->
  <footer class="nebulae-footer">
    <div class="nebulae-footer-inner">
      <ul class="footer-links">
        <li><a href="https://raggiesoft.com">RaggieSoft Hub</a></li>
        <li><a href="<?php echo e($links['listeningRoomFullSuite'] ?? 'https://music.raggiesoft.com/the-stardust-engine/1996-ad-astra-single?track=1-01-escape-velocity-ad-astra'); ?>">Stream &ldquo;Escape Velocity (Ad Astra)&rdquo;</a></li>
        <li><a href="https://books.raggiesoft.com">RaggieSoft Book Reader</a></li>
        <li><a href="https://stardust.raggiesoft.com">The Stardust Engine Portal</a></li>
        <li><a href="https://engineroom.raggiesoft.com">Engine Room Records</a></li>
        <li><a href="https://corporate.raggiesoft.com/licensing">Licenses (MIT Code / CC BY-SA 4.0 Content)</a></li>
        <li><a href="https://raggiesoft.com/in-memoriam">In Memoriam: Sir Patrick Stewart</a></li>
      </ul>

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

