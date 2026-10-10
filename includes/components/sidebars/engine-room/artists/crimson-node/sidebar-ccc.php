<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Sub-navigation sidebar for the 'CCC Campus' character directory within the Crimson Node lore.
 * Architecture: Uses strict URI matching to highlight the active character. Includes a cross-reference 
 * link back to 'The Phalanx' (the core family directory) using a distinct red header to indicate 
 * narrative context shifting.
 * Future Maintainers: As more CCC-affiliated characters are documented, add them to the first `.list-group`. 
 * Ensure the exact `$currentPath` match logic is updated.
 */
// sidebar-ccc.php
?>
<!-- Primary Directory: CCC Campus Affiliates -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-dark text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
        <a href="/engine-room/artists/crimson-node/characters/ccc" class="text-white text-decoration-none d-block">
            <i slot="start" class="ph ph-arrow-left"></i> CCC Campus
        </a>
    </div>
    <!-- Character Links: Strict matching against $currentPath sets the active state -->
    <div class="list-group list-group-flush">
        <a href="/engine-room/artists/crimson-node/characters/ccc/heather-bouchard" class="list-group-item list-group-item-action <?= ($currentPath == '/engine-room/artists/crimson-node/characters/ccc/heather-bouchard') ? 'active' : '' ?>">
            Heather Bouchard
        </a>
        <a href="/engine-room/artists/crimson-node/characters/ccc/hailey-bouchard" class="list-group-item list-group-item-action <?= ($currentPath == '/engine-room/artists/crimson-node/characters/ccc/hailey-bouchard') ? 'active' : '' ?>">
            Hailey Bouchard
        </a>
    </div>
</div>
<!-- Cross-Navigation: Immediate escape hatch back to the core narrative group (The Phalanx) -->
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
