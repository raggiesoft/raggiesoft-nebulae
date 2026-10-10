<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: ARTIST ORIGIN SIDEBAR
 * ============================================================================
 * 
 * This component provides the side navigation structure specific to the 
 * "Origin" artist entity within the Engine Room's narrative database.
 * 
 * MAINTENANCE NOTES:
 * - Pure HTML/PHP component leveraging Bootstrap classes.
 * - Manually links to specific lore archives that tie "Origin" to the broader 
 *   RaggieSoft / Stardust Engine universe (e.g., The 1998 Signing).
 * ============================================================================
 */
?>
<div class="p-3">
    <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary">
        <i slot="start" class="ph ph-user-group fa-2x text-primary"></i> <div>
            <h6 class="text-uppercase fw-bold mb-0 text-body-emphasis" style="font-family: 'Oswald', sans-serif;">Origin</h6>
            <small class="text-body-secondary font-monospace" style="font-size: 0.75rem;">EST. 1982 // LONDON</small>
        </div>
    </div>
    
    <div class="list-group list-group-flush mb-4">
        <a href="/engine-room/artists/origin" class="list-group-item list-group-item-action bg-transparent ps-0 border-0">
            <i slot="start" class="ph ph-id-card me-3 text-body-secondary"></i> Profile & Bio
        </a>
        <a href="/engine-room/artists/origin/discography" class="list-group-item list-group-item-action bg-transparent ps-0 border-0">
            <i slot="start" class="ph ph-compact-disc"></i> Discography
        </a>
    </div>

    <h6 class="text-uppercase fw-bold text-body-secondary mb-3 small" style="font-family: 'Oswald', sans-serif;">
        Lore Archives
    </h6>
    <div class="list-group list-group-flush">
         <a href="/engine-room/history/london-discovery" class="list-group-item list-group-item-action bg-transparent ps-0 border-0 small text-body-secondary">
            <i slot="start" class="ph ph-handshake"></i> The 1998 Signing
        </a>
         <a href="/engine-room/artists/stardust-engine/story/crash-of-90" class="list-group-item list-group-item-action bg-transparent ps-0 border-0 small text-body-secondary">
            <i slot="start" class="ph ph-shield-heart"></i> Protocol: Safe Harbor
        </a>
    </div>

    <div class="mt-5 pt-3 border-top border-secondary">
        <a href="/engine-room/artists" class="btn btn-outline-secondary btn-sm w-100 rounded-0">
            <i slot="start" class="ph ph-arrow-left"></i> Full Roster
        </a>
    </div>
</div>