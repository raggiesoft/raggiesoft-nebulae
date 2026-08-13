<?php
// includes/header.php
// v1.0 - Lyra Router (Web Awesome Incubator Edition)

// Ensure CDN Root exists
$cdn_root = $cdnBaseUrl ?? 'https://assets.raggiesoft.com'; 

// --- 1. BRAND FONT LOGIC ---
$font_stack = $pageConfig['brandFont'] ?? $settings['brandFont'] ?? ['sans-serif'];
if (!is_array($font_stack) || empty($font_stack)) { $font_stack = ['sans-serif']; }

$css_font_parts = array_map(function($font) {
    $generics = ['serif', 'sans-serif', 'monospace', 'cursive', 'fantasy', 'system-ui'];
    return in_array(strtolower($font), $generics) ? $font : "'$font'";
}, $font_stack);

$brand_font_css = implode(', ', $css_font_parts);

// --- 2. CRITICAL IMAGES ---
$critical_images = [];
if (!empty($pageConfig['navbarBrandLogo'])) $critical_images[] = $pageConfig['navbarBrandLogo'];
elseif (!empty($navbarBrandLogo)) $critical_images[] = $navbarBrandLogo;

if (!empty($pageConfig['navbarBrandLogoDark'])) $critical_images[] = $pageConfig['navbarBrandLogoDark'];

if (isset($customPageAssets) && is_array($customPageAssets)) {
    $critical_images = array_merge($critical_images, $customPageAssets);
}
?>
<!doctype html>
<html lang="en">
  <head>
    
    <?php 
    // Google Analytics Integration via Orion Vault
    if (!empty($googleTag)): 
    ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $googleTag; ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo $googleTag; ?>');
        </script>
    <?php endif; ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php echo htmlspecialchars($pageTitle ?? 'Nebulae Incubator'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($ogDescription ?? ''); ?>">
    
    <!-- Open Graph Metadata -->
    <meta property="og:title" content="<?php echo htmlspecialchars($ogTitle ?? $pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($ogDescription ?? ''); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($ogImage ?? ''); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($ogUrl ?? "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>">

    <link rel="canonical" href="<?php echo htmlspecialchars($ogUrl ?? "https://" . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>">

    <?php
    // JSON-LD Schema Generator
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => $pageTitle ?? 'Nebulae Incubator',
        "url" => $ogUrl ?? "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
    ];

    if (isset($pageConfig['schemaType']) && $pageConfig['schemaType'] === 'MusicGroup') {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "MusicGroup",
            "name" => "The Stardust Engine",
            "url" => "https://thestardustengine.com/",
            "image" => $ogImage ?? "",
            "description" => $ogDescription ?? "The official portal for The Stardust Engine.",
        ];
    } elseif (isset($pageConfig['schemaType']) && $pageConfig['schemaType'] === 'CreativeWork') {
         $schema = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $pageTitle,
            "url" => $ogUrl ?? "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
         ];
    }
    ?>
    <script type="application/ld+json">
        <?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>

    <!-- Web Awesome Pro Framework -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/themes/default.css">
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/utilities.css">
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/native.css">
    <script type="module" src="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/webawesome.loader.js"></script>

    <!-- Font Awesome Pro Kit -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/<?= $faKit ?>.css" crossorigin="anonymous">

    <?php foreach ($critical_images as $imgUrl): ?>
        <?php if($imgUrl): ?><link rel="preload" as="image" href="<?php echo $imgUrl; ?>"><?php endif; ?>
    <?php endforeach; ?>
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $cdn_root; ?>/common/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $cdn_root; ?>/common/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $cdn_root; ?>/common/images/favicons/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php echo $cdn_root; ?>/common/images/favicons/favicon.ico">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lyra Specific CSS -->
    <link href="/assets/css/nebulae-core.css?v=<?php echo time(); ?>" rel="stylesheet">

    <style>
        .brand-font { font-family: <?php echo $brand_font_css; ?> !important; }
        
        /* Lyra Page Loader Override */
        #page-loader {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: var(--wa-color-surface-default); 
            color: var(--wa-color-text-default);
            z-index: 99999; display: flex; flex-direction: column; justify-content: center; align-items: center;
            opacity: 1; visibility: visible; transition: opacity 0.5s ease-in-out, visibility 0s 0s;
        }
        #page-loader.loader-hidden {
            opacity: 0; visibility: hidden; transition: opacity 0.5s ease-in-out, visibility 0s 0.5s;
        }
        .loader-progress-container {
            width: 300px; height: 4px; margin-top: 20px; position: relative; overflow: hidden;
            background-color: var(--wa-color-neutral-border-quiet); 
        }
        .loader-progress-bar {
            height: 100%; width: 0%; transition: width 0.2s ease;
            background-color: var(--wa-color-brand-fill-loud); 
            box-shadow: 0 0 10px var(--wa-color-brand-fill-loud);
        }
        
        /* Dynamic Theme Logo Filters */
        .navbar-brand-corporate-img { mix-blend-mode: multiply; }
        [data-theme="dark"] .navbar-brand-corporate-img {
            filter: invert(1) grayscale(100%); mix-blend-mode: screen;
        }

        /* Native Theme Image Toggles */
        .theme-img-light { display: inline-block !important; }
        .theme-img-dark { display: none !important; }

        [data-theme="dark"] .theme-img-light { display: none !important; }
        [data-theme="dark"] .theme-img-dark { display: inline-block !important; }

        @media (prefers-color-scheme: dark) {
            html:not([data-theme="light"]) .theme-img-light { display: none !important; }
            html:not([data-theme="light"]) .theme-img-dark { display: inline-block !important; }
        }
    </style>

    <script>
    (function() {
        // Lightweight theme manager for Lyra
        const getPreferredTheme = () => {
            const storedTheme = localStorage.getItem('nebulae_theme');
            if (storedTheme) return storedTheme;
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };
        document.documentElement.setAttribute('data-theme', getPreferredTheme());
    })();
    </script>
  </head>
  
  <body class="wa-font-sans">
    
    <div id="page-loader">
        <wa-spinner class="wa-margin-bottom-m" style="font-size: 3rem; --indicator-color: var(--wa-color-brand-fill-loud);"></wa-spinner>
        <h4 class="wa-text-uppercase wa-font-bold brand-font" style="letter-spacing: 2px;">
            <?php echo htmlspecialchars($pageConfig['siteName'] ?? $settings['siteName'] ?? 'Loading'); ?>
        </h4>
        <div class="loader-progress-container">
            <div class="loader-progress-bar" id="loader-bar"></div>
        </div>
        <div class="wa-text-neutral wa-font-mono wa-font-size-s wa-margin-top-s" id="loader-text">> INITIALIZING...</div>
    </div>
    
    <script>
    (function() {
        const loader = document.getElementById('page-loader');
        const bar = document.getElementById('loader-bar');
        const text = document.getElementById('loader-text');
        let progress = 0; let progressInterval;

        function startHeartbeat() {
            if (progressInterval) clearInterval(progressInterval);
            progress = 10; 
            if(bar) { bar.style.width = '10%'; bar.style.opacity = '1'; }
            
            progressInterval = setInterval(() => {
                let step = (95 - progress) / 80; 
                if (step < 0.1) step = 0.1; 
                progress += step; 
                if (progress > 95) progress = 95; 
                if(bar) bar.style.width = progress + '%';
                
                if(text) {
                    if (progress < 30) text.innerText = "> ESTABLISHING UPLINK...";
                    else if (progress < 50) text.innerText = "> HANDSHAKING...";
                    else if (progress < 70) text.innerText = "> DECRYPTING STREAM...";
                    else text.innerText = "> AWAITING RESPONSE...";
                }
            }, 50);
        }

        function finishLoad() {
            if (progressInterval) clearInterval(progressInterval);
            if(bar) bar.style.width = '100%';
            if(text) text.innerText = "> CONNECTION ESTABLISHED.";
            
            setTimeout(() => { 
                if(loader) loader.classList.add('loader-hidden'); 
                setTimeout(() => { if(bar) { bar.style.width = '0%'; bar.style.opacity = '0'; } }, 500);
            }, 500);
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (!loader.classList.contains('loader-hidden')) startHeartbeat();
        });
        window.addEventListener('load', finishLoad);
    })();
    </script>
    
    <!-- WEB AWESOME SCAFFOLDING START -->
    <wa-page>
        <!-- Header Slot -->
        <div slot="header" class="wa-flex wa-align-center wa-justify-between wa-padding-m" style="border-bottom: 1px solid var(--wa-color-neutral-border-quiet);">
            <a href="<?php echo htmlspecialchars($pageConfig['navbarBrandLink'] ?? $navbarBrandLink ?? '/'); ?>" class="wa-flex wa-align-center wa-text-decoration-none wa-text-default">
                
                <?php 
                $logoLight = $pageConfig['navbarBrandLogo'] ?? $settings['navbarBrandLogo'] ?? $navbarBrandLogo ?? '';
                $logoDark  = $pageConfig['navbarBrandLogoDark'] ?? '';
                ?>

                <?php if (!empty($logoLight) && !empty($logoDark)): ?>
                    <img src="<?php echo htmlspecialchars($logoLight); ?>" 
                        alt="<?php echo htmlspecialchars($pageConfig['navbarBrandAlt'] ?? 'Logo'); ?>" 
                        height="30" width="30"
                        class="theme-img-light wa-margin-right-s <?php echo htmlspecialchars($pageConfig['navbarBrandClass'] ?? ''); ?>">
                    
                    <img src="<?php echo htmlspecialchars($logoDark); ?>" 
                        alt="<?php echo htmlspecialchars($pageConfig['navbarBrandAlt'] ?? 'Logo Dark'); ?>" 
                        height="30" width="30"
                        class="theme-img-dark wa-margin-right-s <?php echo htmlspecialchars($pageConfig['navbarBrandClass'] ?? ''); ?>">
                        
                <?php elseif (!empty($logoLight)): ?>
                    <img src="<?php echo htmlspecialchars($logoLight); ?>" 
                        alt="<?php echo htmlspecialchars($pageConfig['navbarBrandAlt'] ?? 'Logo'); ?>" 
                        height="30" width="30"
                        class="wa-margin-right-s <?php echo htmlspecialchars($pageConfig['navbarBrandClass'] ?? ''); ?>">
                <?php endif; ?>
                
                <span class="wa-font-bold wa-text-uppercase brand-font">
                    <?php echo strip_tags($pageConfig['navbarBrandText'] ?? $settings['siteName'] ?? 'Nebulae', '<span>'); ?>
                </span>
            </a>

            <!-- Header Menu / Right Side Actions -->
            <div class="header-actions">
                <?php 
                    if (isset($currentHeaderMenu) && file_exists($currentHeaderMenu)) {
                        include $currentHeaderMenu;
                    }
                ?>
            </div>
        </div>