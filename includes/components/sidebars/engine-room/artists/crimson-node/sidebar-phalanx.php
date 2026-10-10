<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: The primary character directory sidebar for 'The Phalanx' (The Miller/Brooks family) in Crimson Node.
 * Architecture: Defines a custom helper function `is_active_phalanx` using `str_contains` to evaluate 
 * the current URI. This fuzzy matching ensures that sub-pages (e.g. `/matt-miller/equipment`) keep the 
 * parent character highlighted.
 * Future Maintainers: Do not remove the `is_active_phalanx` helper function; it is essential for preventing 
 * strict-match failures on nested character lore pages. Keep the "Unified Pelletier Twins Profile" as a single entry.
 */
// includes/components/sidebars/sidebar-phalanx.php
$sidebar_uri = $_SERVER['REQUEST_URI'] ?? '/';

// Helper function to easily check active states
// Abstracted to support fuzzy matching for deeply nested character sub-pages
function is_active_phalanx($path, $current_uri) {
    return str_contains($current_uri, $path);
}
?>

<!-- Main Phalanx Roster: Uses specific FontAwesome/Phospor icons mapping to their narrative roles -->
<div class="list-group mb-4 shadow-sm border-0">
    <div class="list-group-item bg-dark text-white fw-bold text-uppercase" style="border-left: 4px solid #dc3545;">
        The Phalanx
    </div>
    
    <a href="/engine-room/artists/crimson-node/characters/family" class="list-group-item list-group-item-action <?php echo ($sidebar_uri === '/engine-room/artists/crimson-node/characters/family' || $sidebar_uri === '/engine-room/artists/crimson-node/characters/family/') ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-users"></i> Overview
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/matt-miller" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/matt-miller', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-microchip"></i> Matt Miller
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/sarah-miller" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/sarah-miller', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-shield-halved"></i> Sarah Miller
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/emily-miller" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/emily-miller', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-microphone"></i> Emily Miller
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/jessica-brooks" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/jessica-brooks', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-wave-square"></i> Jessica Brooks
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/rachel-miller" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/rachel-miller', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-drum"></i> Rachel Miller
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/shiloh-brooks" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/shiloh-brooks', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-guitar"></i> Shiloh Brooks
    </a>
    
    <a href="/engine-room/artists/crimson-node/characters/family/chloe-brooks" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/chloe-brooks', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-chess-knight"></i> Chloe Brooks
    </a>
    
    <!-- Unified Pelletier Twins Profile: They share a dossier due to narrative reasons -->
    <!-- Unified Pelletier Twins Profile -->
    <a href="/engine-room/artists/crimson-node/characters/family/the-pelletier-twins" class="list-group-item list-group-item-action <?php echo is_active_phalanx('/the-pelletier-twins', $sidebar_uri) ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-user-group"></i> Elise & Elodie Pelletier
    </a>
</div>
