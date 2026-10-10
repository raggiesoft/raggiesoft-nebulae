<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: The default, universal sidebar navigation for Engine Room Records content.
 * Architecture: Provides a standardized stack of Web Awesome `rs-btn` elements pointing 
 * to primary routing hubs (Discography, Lore, About). It lacks dynamic active-state logic, 
 * acting as a static anchor across the site.
 * Future Maintainers: This is the fallback sidebar. If adding context-specific navigation
 * (e.g., for a specific album or story), create a new sidebar component rather than bloating
 * this default template.
 */
?>
<!-- Universal Navigation Menu: Static routing to top-level domains -->
<h5 class="pt-3 pb-2 mb-3 border-bottom">Navigation</h5>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-home"></i> Home
    </button>
  
  
  
    <!-- Core Content Hubs -->
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/discography" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-record-vinyl"></i> Discography
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-users"></i> The Band
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/lore/" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-book-atlas"></i> The Lore
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/about" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-circle-info"></i> About
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/contact" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-paper-plane"></i> Contact
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/license" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
       <i slot="start" class="ph ph-file-contract"></i> License
    </button>
  
</div>