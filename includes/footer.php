<?php
// includes/footer.php
// v1.1 - Lyra Router (Web Awesome Edition)
// Removed redundant HTML/Body closures (Handled by Lyra)

// --- 1. DYNAMIC LOCATION LOGIC ---
$location_json_url = 'https://assets.raggiesoft.com/portfolio/json/locations.json';
$hq_location = 'Location Classified'; // Fallback in case of failure

$location_json = @file_get_contents($location_json_url);
if ($location_json !== false) {
    $location_data = json_decode($location_json, true);
    if (is_array($location_data)) {
        foreach ($location_data as $loc) {
            if (isset($loc['is_home']) && $loc['is_home'] === true) {
                // Strip out "In-Office: " and trim any whitespace
                $hq_location = trim(str_replace('In-Office:', '', $loc['label']));
                break;
            }
        }
    }
}

// --- 2. RESOLVE VISUAL FOOTER ---
if (isset($pageConfig['footer'])) {
    $footerFile = $pageConfig['footer'];
} else {
    $footerMap = $settings['footerMap'] ?? [];
    $footerFile = resolveAsset($footerMap, $request_uri) ?? 'footer-default';
}

$currentFooter = ROOT_PATH . '/includes/components/footers/' . $footerFile . '.php';
if (!file_exists($currentFooter)) {
    $currentFooter = ROOT_PATH . '/includes/components/footers/footer-default.php';
}
?>

<footer id="lyra-master-footer">
    <div id="visual-footer-container">
        <?php include $currentFooter; ?>
    </div>

    <div id="global-legal-band" class="wa-padding-m" style="background-color: var(--wa-color-neutral-subtle); border-top: 1px solid var(--wa-color-neutral-border-quiet); z-index: 1;">
        <div class="wa-flex wa-flex-wrap wa-justify-between wa-align-center wa-gap-m">
            
            <!-- Left Side: Copyright & Licenses -->
            <div class="wa-font-size-s" style="color: var(--wa-color-neutral-text);">
                <div class="wa-flex wa-align-center wa-gap-s wa-flex-wrap">
                    <span class="wa-font-bold">&copy; 2008 &ndash; <?php echo date("Y"); ?> Michael Ragsdale.</span>
                    <span style="opacity: 0.5;">|</span>
                    <span style="opacity: 0.8;">
                        Content: <a href="/raggiesoft-media/licensing" style="color: inherit; text-decoration: none; border-bottom: 1px solid currentColor;">CC BY-SA 4.0</a> &bull; 
                        Code: <a href="/raggiesoft-media/licensing" style="color: inherit; text-decoration: none; border-bottom: 1px solid currentColor;">MIT</a>
                    </span>
                </div>
                <div class="wa-margin-top-3xs" style="color: var(--wa-color-neutral-text-quiet); font-size: 0.85em;">
                    RaggieSoft&trade;, The Stardust Engine&trade;, and Engine Room Records&trade; are trademarks of Michael P. Ragsdale.
                </div>
            </div>

            <!-- Right Side: Navigation Links -->
            <div class="wa-flex wa-flex-wrap wa-align-center wa-gap-m wa-font-size-s">
                <a href="https://store.raggiesoft.com/" target="_blank" rel="noopener" class="wa-text-decoration-none wa-text-default wa-font-bold">
                    <i class="fa-solid fa-bag-shopping wa-margin-right-2xs" aria-hidden="true"></i>Official Store
                </a>
                
                <a href="/raggiesoft-media" class="wa-text-decoration-none wa-text-default wa-font-bold">RaggieSoft Media</a>
                
                <a href="/raggiesoft-media/careers" class="wa-text-decoration-none wa-font-bold" style="color: var(--wa-color-danger-text);">
                    <i class="fa-solid fa-shield-exclamation wa-margin-right-2xs" aria-hidden="true"></i>Careers (Fraud Alert)
                </a>
                
                <a href="/about/privacy" class="wa-text-decoration-none wa-text-default">Privacy</a>
                <a href="/about/terms" class="wa-text-decoration-none wa-text-default">Terms</a>
                <a href="/raggiesoft-media/licensing" class="wa-text-decoration-none wa-text-default">Licenses</a>
                <a href="/contact" class="wa-text-decoration-none wa-text-default">Contact</a>
                
                <a href="/about/ai-disclaimer" class="wa-text-decoration-none wa-font-bold wa-text-uppercase" style="color: var(--wa-color-brand-text); letter-spacing: 1px; font-size: 0.9em;">
                    <i class="fa-duotone fa-robot-astromech wa-margin-right-2xs"></i>AI Disclaimer
                </a>
            </div>
            
        </div>
    </div>
</footer>

<div id="global-player-zone" style="position: fixed; bottom: 0; width: 100%; z-index: 1050;">
    <?php include ROOT_PATH . '/includes/components/audio-player/sticky-player.php'; ?>
    <script src="https://assets.raggiesoft.com/engine-room-records/js/stardust-player.js?v=<?php echo time(); ?>"></script>
    <script>
        // Initialize global registry if not exists
        window.STARDUST_PLAYLIST = window.STARDUST_PLAYLIST || [];
    </script>
</div>

<script>
// 1. Wrap the Store UI logic into a reusable function (Refactored for Web Awesome)
function initializeStorePreferences() {
    const savedPlatform = localStorage.getItem('preferredMusicStore');
    
    function updateButtonGroup(group, platformData) {
        const mainBtn = group.querySelector('.main-store-btn'); 
        const toggleBtn = group.querySelector('.toggle-store-btn');
        const icon = group.querySelector('.main-store-icon');
        const textSpan = group.querySelector('.main-store-text');
        
        if (!mainBtn || !toggleBtn) return; 
        
        // Update Web Awesome variant instead of Bootstrap class
        mainBtn.setAttribute('variant', platformData.color);
        toggleBtn.setAttribute('variant', platformData.color);
        mainBtn.setAttribute('href', platformData.url);
        
        if(icon) icon.className = `main-store-icon ${platformData.icon} wa-margin-right-2xs`;
        if(textSpan) textSpan.textContent = `${mainBtn.dataset.defaultText} ${platformData.name}`;
    }

    if (savedPlatform) {
        document.querySelectorAll('.dynamic-store-group').forEach(group => {
            const targetLink = group.querySelector(`.store-selector-link[data-platform="${savedPlatform}"]`);
            if (targetLink) updateButtonGroup(group, targetLink.dataset);
        });
    }

    document.querySelectorAll('.store-selector-link').forEach(link => {
        // Remove old listeners to prevent duplicates on SPA load
        const newLink = link.cloneNode(true);
        link.parentNode.replaceChild(newLink, link);
        
        newLink.addEventListener('click', function(e) {
            localStorage.setItem('preferredMusicStore', this.dataset.platform);
        });
    });
}

// 2. Run on initial hard load
document.addEventListener('DOMContentLoaded', initializeStorePreferences);

// 3. The Lyra SPA Lifecycle Hook
document.addEventListener('lyra:loaded', function() {
    // Re-bind the store selector buttons in the new DOM
    initializeStorePreferences();

    // Re-bind the Stardust Engine tracklist buttons so music keeps playing
    if (typeof bindTracklistButtons === 'function') {
        bindTracklistButtons(); 
    }

    // Ping Google Analytics to log the virtual pageview (Tag ID supplied by Orion Vault)
    if (typeof gtag === 'function' && '<?php echo $googleTag ?? ''; ?>' !== '') {
        gtag('config', '<?php echo htmlspecialchars($googleTag ?? ''); ?>', {
            'page_path': window.location.pathname
        });
    }
});
</script>

<?php if (isset($pageConfig['scripts']) && is_array($pageConfig['scripts'])): ?>
    <?php foreach ($pageConfig['scripts'] as $script): ?>
        <script src="<?php echo htmlspecialchars($script); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>