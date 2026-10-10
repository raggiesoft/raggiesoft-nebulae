<?php
/**
 * ARCHITECTURE: Stardust Engine Header Navigation
 * 
 * This component provides comprehensive navigation for the Stardust Engine
 * artist sub-site. 
 * 
 * COMPONENTS:
 * 1. Primary Links: Direct links to Home, Story, Discography, Radio, and Contact.
 * 2. Band Dropdown: Uses wa-dropdown to present an overview, history, and a list of 
 *    individual band members (The Kin).
 * 3. External integrations: Links to the official Shopify storefront.
 * 4. Return Navigation: Link to exit back to the Engine Room HQ.
 */

// includes/components/headers/engine-room/artists/stardust-engine/header-stardust.php
// Dedicated navigation for The Stardust Engine artist sub-site.
// UPDATED: Corrected Dropdown Labels (O'Connells vs Wrights) to reflect that everyone is kin.
// UPDATED: Added Official Storefront routing.
?>
<!-- RESPONSIVE NAVIGATION CONTAINER -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine">
        <i slot="start" class="ph ph-house me-2"></i>Home
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story">
        <i slot="start" class="ph ph-book-atlas me-2"></i>Story
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/discography">
        <i slot="start" class="ph ph-compact-disc me-2"></i>Discography
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/radio" class="text-warning">
        <i slot="start" class="ph ph-signal-stream me-2"></i>Radio
    </button>
  

  
  <!-- BAND ROSTER DROPDOWN -->
  <!-- Hierarchical menu presenting band history and individual member profiles. -->
  <wa-dropdown placement="bottom-start" hoist>
    <button class="rs-btn" slot="trigger" appearance="plain">
        <i class="ph ph-users me-2"></i>The Band
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
        <wa-menu>
      <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band')">Overview</wa-dropdown-item>
        <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band/history')">History & Lore</wa-dropdown-item>
        
        <wa-divider></wa-divider>
        
        <div class="px-3 py-2 small text-uppercase fw-bold text-uppercase small">The Kin</div>
        <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band/ryan-oconnell')"><i class="ph ph-microphone me-2"></i>Ryan O'Connell</wa-dropdown-item>
        <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band/cassidy-oconnell')"><i class="ph ph-guitar me-2"></i>Cassidy O'Connell</wa-dropdown-item>
        <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band/holly-oconnell')"><i class="ph ph-scale-balanced me-2"></i>Holly O'Connell</wa-dropdown-item>
        <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band/evan-wright')"><i class="ph ph-drum me-2"></i>Evan Wright</wa-dropdown-item>
        <wa-dropdown-item onclick="navigateTo('/engine-room/artists/stardust-engine/band/tyler-wright')"><i class="ph ph-guitar-electric me-2"></i>Tyler Wright</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <button class="rs-btn" appearance="plain" href="/contact">
        <i slot="start" class="ph ph-envelope me-2"></i>Contact
    </button>
  

  

  
      <!-- EXTERNAL STOREFRONT LINK -->
      <button class="rs-btn" appearance="plain" href="https://store.raggiesoft.com/pages/the-stardust-engine" class="text-info fw-bold">
        <i slot="start" class="ph ph-bag-shopping me-2"></i>Official Store
      </button>
  

  
      <!-- RETURN NAVIGATION -->
      <button class="rs-btn" appearance="plain" href="/engine-room" class="">
        <i slot="start" class="ph ph-arrow-turn-up me-2"></i>Engine Room HQ
      </button>
  

</div>