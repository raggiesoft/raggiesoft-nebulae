<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: JESSICA MILLER CENTER HEADER
 * ============================================================================
 * 
 * This header component provides navigation specifically for the "Jessica Miller 
 * Center for the Neurodivergent Arts" narrative section. It focuses on 
 * accessibility-themed lore and facility features.
 * 
 * MAINTENANCE NOTES:
 * - Uses Web Awesome (`wa-dropdown`, `wa-menu`) for interactive elements.
 * - Some links (like Tenant Portal) are intentional stubs (`#`) for narrative 
 *   flavor and do not require active routing logic.
 * ============================================================================
 */
?>
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
    
    
        <button class="rs-btn" appearance="plain" href="/engine-room/jessica-miller-center">
            <i slot="start" class="ph ph-building-columns me-2"></i>Overview
        </button>
    
    
    
        <button class="rs-btn" appearance="plain" href="/engine-room/jessica-miller-center/the-quiet-floor">
            <i slot="start" class="ph ph-ear-muffs me-2"></i>The Quiet Floor
        </button>
    
    
    
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn"  href="#"    slot="trigger" appearance="plain">
            <i class="ph ph-wheelchair me-2"></i>The Standard
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
        </button>
    <wa-menu>
      <li><span class="dropdown-header text-uppercase small letter-spacing-1">Universal Design</span>
            <wa-dropdown-item value="#"><i class="ph ph-eye-slash me-2 "></i>Low-Sensory Lighting</wa-dropdown-item>
            <wa-dropdown-item value="#"><i class="ph ph-volume-xmark me-2 "></i>Acoustic Zoning</wa-dropdown-item>
            <wa-dropdown-item value="/engine-room/jessica-miller-center/destination-dispatch-elevators">
                    <i class="ph ph-elevator me-2 "></i>Destination Dispatch
                </wa-dropdown-item>
            <wa-divider></wa-divider>
            <wa-dropdown-item value="#"><i class="ph ph-book-open me-2 text-primary"></i>Research Library</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

    
    
        <button class="rs-btn" appearance="plain" href="#">
            <i slot="start" class="ph ph-id-card me-2"></i>Tenant Portal
        </button>
    
    

    
        <button class="rs-btn" appearance="plain" href="/engine-room" class="">
            <i slot="start" class="ph ph-arrow-turn-up me-2"></i>Engine Room HQ
        </button>
    

</div>