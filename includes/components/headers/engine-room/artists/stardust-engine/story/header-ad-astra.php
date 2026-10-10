<?php
/**
 * ARCHITECTURE: Ad Astra Mission Control Header Component
 * 
 * DESCRIPTION:
 * This component provides the contextual navigation for the "Ad Astra" story section
 * (a High Contrast HUD / Sci-Fi simulation experience) within the Stardust Engine artist profile.
 *
 * STRUCTURE:
 * - Mobile Nav Container: A responsive flexbox wrapper (`mobile-nav-menu`) aligning navigation items.
 * - Mission Hub: A direct link returning to the Ad Astra landing page.
 * - Flight Logs Dropdown: A structured WebAwesome dropdown (`wa-dropdown`) categorizing 
 *   story chapters into "Phases" (Departure, The Void, Return).
 * - Transmission: A link pointing to the audio/discography page related to this story.
 * - Exit Sim: An escape hatch linking back to the root Stardust Engine artist hub.
 *
 * USAGE:
 * - Included dynamically as the top-level navigation on any page inside the `story/ad-astra` path.
 * - Relies on custom Web Components (`rs-btn`, `wa-dropdown`, `wa-menu`, `wa-dropdown-item`).
 *
 * MAINTENANCE NOTES:
 * - HUD Theming: The "Flight Logs" button utilizes a custom CSS variable (`--astra-text`) inline 
 *   to ensure it aligns with the high-contrast sci-fi aesthetic.
 * - Phase structure is hardcoded. If new story chapters are added, they must be manually inserted 
 *   into the appropriate `wa-menu` divider blocks.
 */

// includes/components/headers/engine-room/artists/stardust-engine/story/header-ad-astra.php
// Header: Ad Astra Mission Control
// Theme: HUD / Sci-Fi / High Contrast
// CONTEXT: The navigation HUD for the spaceship simulation.
?>
<!-- Section: HUD Navigation Container -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <!-- Link: Return to Hub -->
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/ad-astra" class="text-uppercase">
        <i slot="start" class="ph ph-radar me-2"></i>Mission Hub
    </button>
  

  
  <!-- Dropdown: Flight Logs (Story Chapters) -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  text-uppercase" href="#"    style="color: var(--astra-text) !important;" slot="trigger" appearance="plain">
      <i class="ph ph-book-sparkles me-2"></i>Flight Logs
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <!-- Sub-category: Phase I -->
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase ">Phase I: Departure</div>
      <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-01">
            <i class="ph ph-shuttle-space me-2"></i>Day 01: Ignition
          </wa-dropdown-item>
      <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-02">
            <i class="ph ph-earth-americas me-2"></i>Day 02: Stabilization
          </wa-dropdown-item>
      <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-03">
            <i class="ph ph-clock me-2"></i>Day 03: Ship's Time
          </wa-dropdown-item>
      
      <wa-divider></wa-divider>
      
      <!-- Sub-category: Phase II -->
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase ">Phase II: The Void</div>
      <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-10">
            <i class="ph ph-stars me-2"></i>Day 10: Harmonic Velocity
          </wa-dropdown-item>
      
      <wa-divider></wa-divider>
      
      <!-- Sub-category: Phase III -->
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase ">Phase III: Return</div>
      <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-21">
            <i class="ph ph-meteor me-2"></i>Day 21: Hard Reset
          </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <!-- Link: Audio Discography -->
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/discography/1995-the-warehouse-tapes/ad-astra" class="text-uppercase">
        <i slot="start" class="ph ph-play me-2"></i>Transmission
    </button>
  

  
      <!-- Escape Hatch: Return to Artist Root -->
      <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine" class="text-uppercase small">
        <i slot="start" class="ph ph-arrow-right-from-bracket me-2"></i>Exit Sim
      </button>
  

</div>