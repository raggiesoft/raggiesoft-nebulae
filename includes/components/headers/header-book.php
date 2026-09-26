<?php 
// Load the logic
require_once __DIR__ . '/../../utils/nav-logic.php'; 

// Initialize navigation using the variable from index.php
// Default to empty if not set to prevent crashes
$sourceUrl = $bookJsonUrl ?? ''; 
$navData = getBookNavigation($sourceUrl);

// Extract variables for easy use in HTML
// ($prevLink, $nextLink, $upLink, $currentIndex, etc.)
extract($navData);
?>

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/library/" class="text-primary">Library</button>
  

  
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  " href="#"    slot="trigger" appearance="plain">
      Aethel
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="/library/aethel">Hub</wa-dropdown-item>
      <wa-dropdown-item value="/library/aethel/aethel-book">Book Index</wa-dropdown-item>
      <wa-dropdown-item value="/library/aethel/lore">Lore</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  " href="#"    slot="trigger" appearance="plain">
      <i class="ph ph-compass me-1"></i>Navigate
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="<?php echo $prevLink; ?>">
           <i class="ph ph-arrow-left me-2"></i>Back
        </wa-dropdown-item>
      
      <wa-dropdown-item>
            <i class="ph ph-arrow-up me-2"></i>Up
        </wa-dropdown-item>
      
      <wa-dropdown-item value="<?php echo $nextLink; ?>">
           Next<i class="ph ph-arrow-right ms-2"></i>
        </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

  
  
    <button class="rs-btn" class="nav-link  " href="#"    slot="trigger" appearance="plain">
      RaggieSoft
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    
      <wa-dropdown-item value="#">RaggieSoft.com</wa-dropdown-item>
      <wa-dropdown-item value="/" class="active">RaggieSoft Knox</wa-dropdown-item>
      <wa-divider></wa-divider>
      <wa-dropdown-item value="/engine-room/artists/stardust-engine/contact">Contact Me</wa-dropdown-item>
    </wa-dropdown>

</div>