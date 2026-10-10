<?php
/**
 * ARCHITECTURE & PURPOSE:
 * This component provides the dedicated navigation header for the "Fractured Prisms" 
 * artist sub-site within the Engine Room imprint. It includes links to lore, discography, 
 * band members, and a way back to the main Engine Room HQ.
 *
 * MAINTENANCE NOTES:
 * - Uses Web Awesome (wa-dropdown, wa-menu) for drop-down sub-navigation.
 * - Ensure href links match the route structure for the Fractured Prisms sub-site.
 */
// includes/components/headers/engine-room/artists/fractured-prisms/header-prisms.php
// Dedicated navigation for the Fractured Prisms artist sub-site.
?>
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/fractured-prisms">
        <i slot="start" class="ph ph-house me-2"></i>The Square
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/fractured-prisms/story">
        <i slot="start" class="ph ph-book-journal-whills me-2"></i>Lore
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/fractured-prisms/discography">
        <i slot="start" class="ph ph-compact-disc me-2"></i>Discography
    </button>
  

  
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn"  href="#"    slot="trigger" appearance="plain">
        <i class="ph ph-ghost me-2"></i>The Residents
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
        <wa-menu>
      <wa-dropdown-item value="/engine-room/artists/fractured-prisms/band">Overview</wa-dropdown-item>
        
        <wa-divider></wa-divider>
        
        <div class="px-3 py-2 small text-uppercase fw-bold text-uppercase small">The Mannings</div>
        <wa-dropdown-item value="/character/fractured-prisms/claire-manning"><i class="ph ph-microphone me-2"></i>Claire Manning</wa-dropdown-item>
        <wa-dropdown-item value="/character/fractured-prisms/rhys-manning"><i class="ph ph-guitar me-2"></i>Rhys Manning</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <button class="rs-btn" appearance="plain" href="/contact">
        <i slot="start" class="ph ph-envelope me-2"></i>Contact
    </button>
  

  

  
      <button class="rs-btn" appearance="plain" href="/engine-room" class="">
        <i slot="start" class="ph ph-arrow-turn-up me-2"></i>Engine Room HQ
      </button>
  

</div>