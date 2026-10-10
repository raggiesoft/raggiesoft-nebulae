<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: STARDUST ENGINE - BAND SIDEBAR
 * ============================================================================
 * 
 * This file serves as the main directory sidebar for the fictional band 
 * "The Stardust Engine." It provides quick links to individual character 
 * biographies and a timeline of major narrative events.
 * 
 * MAINTENANCE NOTES:
 * - Uses custom `rs-btn` components (simulating Web Components styling) for 
 *   navigation rather than standard anchor tags.
 * - Ensure icon alignment (using Phosphor icons) when adding new band members.
 * ============================================================================
 */
?>
<h5 class="pt-3 pb-2 mb-3 border-bottom">
    <i slot="start" class="ph ph-users"></i> The Band
</h5>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-users-viewfinder me-2"></i> Overview
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/ryan-oconnell" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-user-music"></i> Ryan O'Connell
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/cassidy-oconnell" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-user-music"></i> Cassidy O'Connell
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/holly-oconnell" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-user-tie"></i> Holly O'Connell
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/evan-wright" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-guitar"></i> Evan Wright
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/tyler-wright" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-drum"></i> Tyler Wright
    </button>
  
</div>

<h6 class="pt-3 pb-2 mb-3 border-bottom mt-4">
    <i slot="start" class="ph ph-book-open"></i> History & Lore
</h6>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/history" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-timeline me-2"></i> Full Timeline
    </button>
  
  
  <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/ad-astra" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
    <i slot="start" class="ph ph-rocket-launch"></i> Ad Astra
  </button>
  
  
  <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/cpi" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
    <i slot="start" class="ph ph-school"></i> CPI & The Forgers
  </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/crash-of-90" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-car-crash"></i> The Crash of '90
    </button> 
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/friction" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-burst"></i> The Friction Scandal
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/nine-figure-refusal" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-handshake-slash"></i> The Nine-Figure Refusal
    </button>
  
</div>