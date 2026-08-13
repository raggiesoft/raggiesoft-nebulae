<?php
// includes/components/sidebars/sidebar-default.php
// Nebulae Incubator: Web Awesome Tree Navigation

// Determine current path to set the active tree item automatically
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<!-- Header -->
<div class="wa-padding-top-s wa-padding-bottom-2xs wa-margin-bottom-m wa-font-size-l wa-font-bold" style="border-bottom: 1px solid var(--wa-color-neutral-border-quiet);">
    Nebulae Modules
</div>

<!-- Web Awesome Tree Menu -->
<wa-tree id="sidebar-nav-tree" selection="single">
    
    <wa-tree-item value="/" <?php echo ($current_path === '/') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-rocket-launch" style="color: var(--wa-color-brand-text); width: 24px;"></i> Mission Control
    </wa-tree-item>

    <!-- Core Repositories (Nested Folders) -->
    <wa-tree-item value="/projects/stardust-engine-cms" <?php echo (str_starts_with($current_path, '/projects/stardust-engine-cms')) ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-server" style="color: var(--wa-color-neutral-text); width: 24px;"></i> Stardust Engine CMS
    </wa-tree-item>

    <wa-tree-item value="/projects/narratives" <?php echo (str_starts_with($current_path, '/projects/narratives')) ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-books" style="color: var(--wa-color-neutral-text); width: 24px;"></i> Narratives Archive
    </wa-tree-item>

    <wa-tree-item value="/projects/hub" <?php echo (str_starts_with($current_path, '/projects/hub')) ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-network-wired" style="color: var(--wa-color-neutral-text); width: 24px;"></i> RaggieSoft Hub
    </wa-tree-item>
    
    <!-- UI Component Sandbox -->
    <wa-tree-item value="/sandbox" <?php echo (str_starts_with($current_path, '/sandbox')) ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-flask" style="color: var(--wa-color-neutral-text); width: 24px;"></i> UI Sandbox
        
        <wa-tree-item value="/sandbox/buttons" <?php echo ($current_path === '/sandbox/buttons') ? 'selected' : ''; ?>>
            <i class="fa-duotone fa-game-board-simple" style="color: var(--wa-color-neutral-text-quiet); width: 24px;"></i> Buttons & Inputs
        </wa-tree-item>
        
        <wa-tree-item value="/sandbox/cards" <?php echo ($current_path === '/sandbox/cards') ? 'selected' : ''; ?>>
            <i class="fa-duotone fa-objects-column" style="color: var(--wa-color-neutral-text-quiet); width: 24px;"></i> Cards & Layouts
        </wa-tree-item>
    </wa-tree-item>

    <!-- Configuration -->
    <wa-tree-item value="/settings" <?php echo ($current_path === '/settings') ? 'selected' : ''; ?>>
        <i class="fa-duotone fa-gear" style="color: var(--wa-color-neutral-text); width: 24px;"></i> Vault Settings
    </wa-tree-item>

</wa-tree>

<!-- Native Vanilla JS Routing Script -->
<script>
    document.getElementById('sidebar-nav-tree').addEventListener('wa-selection-change', (event) => {
        const tree = event.target;
        
        const selectedItem = tree.querySelector('wa-tree-item[selected]');
        
        if (selectedItem && selectedItem.hasAttribute('value')) {
            const targetUrl = selectedItem.getAttribute('value');
            
            // Prevent redundant reloads if clicking the active page
            if (window.location.pathname !== targetUrl) {
                window.location.href = targetUrl;
            }
        }
    });
</script>