<?php
// includes/components/sidebars/sidebar-default.php
// UPDATED: Web Awesome Tree Navigation

// Determine current path to set the active tree item automatically
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<!-- Header -->
<div class="wa-padding-top-s wa-padding-bottom-2xs wa-margin-bottom-m wa-font-size-l wa-font-bold" style="border-bottom: 1px solid var(--wa-color-neutral-border-quiet);">
    Navigation
</div>

<!-- Web Awesome Tree Menu -->
<wa-tree id="sidebar-nav-tree" selection="single">
    
    <wa-tree-item value="/" <?php echo ($current_path === '/') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-home" style="color: var(--wa-color-brand-text); width: 24px;"></i> Home
    </wa-tree-item>
    
    <!-- Dynamic Discography Tree -->
    <wa-tree-item value="/engine-room/artists/stardust-engine/discography" <?php echo ($current_path === '/engine-room/artists/stardust-engine/discography') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-record-vinyl" style="color: var(--wa-color-neutral-text); width: 24px;"></i> Discography
        
        <?php
        // Fetch the JSON directly from the CDN
        $artistSlug = 'the-stardust-engine';
        $albumsJsonUrl = "https://assets.raggiesoft.com/engine-room-records/{$artistSlug}/albums.json"; 
        
        // Suppress warnings in case the CDN is temporarily unreachable
        $albumsJson = @file_get_contents($albumsJsonUrl);
        
        if ($albumsJson !== false) {
            $albumsData = json_decode($albumsJson, true);
            
            if (json_last_error() === JSON_ERROR_NONE && is_array($albumsData)) {
                // Loop through the Eras (Apex, Freedom, etc.)
                foreach ($albumsData as $eraKey => $eraData) {
                    
                    // Only render the Era folder if it actually contains albums
                    if (!empty($eraData['albums'])) {
                        
                        // Output the nested Era folder
                        echo '<wa-tree-item>';
                        echo '  <i class="fa-duotone fa-folder-music" style="color: var(--wa-color-neutral-text-quiet); width: 24px;"></i> ' . htmlspecialchars($eraData['label']);
                        
                        // Loop through the albums within this Era
                        foreach ($eraData['albums'] as $album) {
                            $albumTitle = $album['title'] ?? 'Unknown Album';
                            $albumUrl = $album['url'] ?? '';
                            
                            // Check if this specific album is the active page
                            $isSelected = ($current_path === $albumUrl) ? 'selected' : '';
                            
                            // Output the clickable album link
                            echo '  <wa-tree-item value="' . htmlspecialchars($albumUrl) . '" ' . $isSelected . '>';
                            echo '      <i class="fa-duotone fa-compact-disc" style="color: var(--wa-color-neutral-text-quiet); width: 24px;"></i> ' . htmlspecialchars($albumTitle);
                            echo '  </wa-tree-item>';
                        }
                        
                        // Close the Era folder
                        echo '</wa-tree-item>';
                    }
                }
            }
        }
        ?>
    </wa-tree-item>
    
    <wa-tree-item value="/engine-room/artists/stardust-engine/band" <?php echo ($current_path === '/engine-room/artists/stardust-engine/band') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-users" style="color: var(--wa-color-neutral-text); width: 24px;"></i> The Band
    </wa-tree-item>
    
    <wa-tree-item value="/engine-room/artists/stardust-engine/lore" <?php echo (str_starts_with($current_path, '/engine-room/artists/stardust-engine/lore')) ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-book-atlas" style="color: var(--wa-color-neutral-text); width: 24px;"></i> The Lore
    </wa-tree-item>

    <wa-tree-item value="/engine-room/artists/stardust-engine/about" <?php echo ($current_path === '/engine-room/artists/stardust-engine/about') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-circle-info" style="color: var(--wa-color-neutral-text); width: 24px;"></i> About
    </wa-tree-item>
    
    <wa-tree-item value="/engine-room/artists/stardust-engine/contact" <?php echo ($current_path === '/engine-room/artists/stardust-engine/contact') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-paper-plane" style="color: var(--wa-color-neutral-text); width: 24px;"></i> Contact
    </wa-tree-item>
    
    <wa-tree-item value="/engine-room/artists/stardust-engine/license" <?php echo ($current_path === '/engine-room/artists/stardust-engine/license') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-file-contract" style="color: var(--wa-color-neutral-text); width: 24px;"></i> License
    </wa-tree-item>

</wa-tree>

<!-- Native Vanilla JS Routing Script -->
<script>
    // Listen for the Web Awesome selection change event
    document.getElementById('sidebar-nav-tree').addEventListener('wa-selection-change', (event) => {
        const tree = event.target;
        
        // Locate the item that just became selected
        const selectedItem = tree.querySelector('wa-tree-item[selected]');
        
        if (selectedItem && selectedItem.hasAttribute('value')) {
            const targetUrl = selectedItem.getAttribute('value');
            
            // Prevent redundant reloads if they click the active page
            if (window.location.pathname !== targetUrl) {
                window.location.href = targetUrl;
            }
        }
    });
</script>