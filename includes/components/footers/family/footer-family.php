<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Secret "Family Mode" diagnostic footer module triggered via Konami Code.
 * Architecture: Configures an array `$konami_config` containing Easter egg properties
 * (title, icon, theme, images, and HTML body) specific to the "Elara" narrative arc.
 * It then injects the global `konami.php` component to handle the actual keystroke listening
 * and modal rendering.
 * Future Maintainers: If the Easter egg narrative changes, modify the array values here.
 * Do not alter the underlying `konami.php` script unless globally changing the trigger logic.
 */
// Custom "Family Mode" Konami Code
// Define the lore-specific payload to be injected into the universal Konami listener
$konami_config = [
    'title'      => 'Elara Diagnostic Mode',
    'icon'       => 'fa-duotone fa-microchip-ai',
    'theme'      => '#20c997', 
    'text_color' => '#ffffff',
    'image'      => $cdnBaseUrl . '/family/images/atmospheric/amanda-elara.jpg',
    'body'       => '<!-- Pre-formatted terminal output for immersive narrative diagnostic feel -->
        
        <h4 class="font-monospace text-white">> DIAGNOSTIC ACTIVE</h4>
        <p class="font-monospace text-light mt-2">
            Elara has recognized your signature.<br>
            Routing tables exposed. Latency: 0ms.
        </p>',
    'btn_text'   => 'View Routing Table',
    'btn_link'   => '/family/amanda-elara'
];
// Execute the global Easter egg handler which registers the keystroke listener and renders the modal
include ROOT_PATH . '/includes/components/easter-eggs/konami.php'; 
?>