<?php
/**
 * ARCHITECTURE: Crimson Node - Piedmont Sidebar Component
 * 
 * DESCRIPTION:
 * This component provides contextual navigation for the "Piedmont" character directory 
 * within the Crimson Node artist section of the Engine Room.
 *
 * STRUCTURE:
 * - Piedmont Directory Navigation: A list-group containing links to Piedmont-related character pages 
 *   (e.g., Trent Montgomery). Highlights the current active page based on `$currentPath`.
 * - The Phalanx Section: A secondary navigation card linking to the broader "Family Directory".
 *
 * USAGE:
 * - Included dynamically in the sidebar area of Piedmont-related pages.
 * - Utilizes Bootstrap 5 utility classes (`card`, `list-group`, `active`).
 *
 * MAINTENANCE NOTES:
 * - Ensure `$currentPath` is properly defined in the parent template before including this file,
 *   as it is used to determine the `active` state of the navigation links.
 * - The "The Phalanx" card uses a distinct `bg-danger` header for visual separation.
 */

// sidebar-piedmont.php
?>
<!-- Section: Piedmont Character Directory -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-dark text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
        <a href="/engine-room/artists/crimson-node/characters/piedmont" class="text-white text-decoration-none d-block">
            <i slot="start" class="ph ph-arrow-left"></i> Piedmont Directory
        </a>
    </div>
    <div class="list-group list-group-flush">
        <a href="/engine-room/artists/crimson-node/characters/piedmont/trent-montgomery" class="list-group-item list-group-item-action <?= ($currentPath == '/engine-room/artists/crimson-node/characters/piedmont/trent-montgomery') ? 'active' : '' ?>">
            Trent Montgomery
        </a>
    </div>
</div>
<!-- Section: The Phalanx Link -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-danger text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
        The Phalanx
    </div>
    <div class="list-group list-group-flush">
        <a href="/engine-room/artists/crimson-node/characters/family" class="list-group-item list-group-item-action">
            View Family Directory
        </a>
    </div>
</div>
