<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: AD ASTRA MISSION SIDEBAR
 * ============================================================================
 * 
 * This sidebar is specific to the "Ad Astra" lore arc (The Maiden Voyage). 
 * It structures the UI as a "Mission Control" panel, segregating story pages 
 * from related media/audio archives.
 * 
 * MAINTENANCE NOTES:
 * - Employs custom `rs-btn` components for routing.
 * - Make sure that the "Related Archives" links are updated if the audio 
 *   system architecture changes.
 * ============================================================================
 */
?>
<h5 class="pt-3 pb-2 mb-3 border-bottom text-info">
    <i slot="start" class="ph ph-rocket-launch"></i> Mission Control
</h5>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/lore/ad-astra" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-radar me-2"></i> Mission Overview
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/lore/ad-astra/voyage" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-book-sparkles"></i> The Maiden Voyage
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/discography/1995-the-warehouse-tapes/ad-astra" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-play-circle"></i> The Transmission (Audio)
    </button>
  
</div>

<h6 class="pt-3 pb-2 mb-3 border-bottom mt-4 ">
    <i slot="start" class="ph ph-database"></i> Related Archives
</h6>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/discography/1995-the-warehouse-tapes" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-compact-disc me-2"></i> The Warehouse Tapes
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/lore/nine-figure-refusal" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-file-invoice-dollar"></i> The Refusal
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/lore" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-chevron-left"></i> Return to Lore
    </button>
  
</div>