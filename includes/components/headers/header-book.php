<?php 
/**
 * ARCHITECTURE: Book Reader Header Navigation Component
 * 
 * DESCRIPTION:
 * This component provides the top-level navigation for the book reading interface. 
 * It dynamically calculates "Previous", "Next", and "Up" routing based on the JSON structure 
 * of the currently loaded book.
 *
 * STRUCTURE:
 * - Data Retrieval: Requires `utils/nav-logic.php` to fetch and parse `$bookJsonUrl`.
 * - Mobile Nav Container: A responsive flexbox wrapper.
 * - Global Links: Direct links to the Library and project hubs (e.g., Aethel).
 * - Dynamic Navigation Dropdown: "Navigate" menu populated with `$prevLink` and `$nextLink` calculated 
 *   from the book's sequence logic.
 * - Corporate Links: A dropdown providing exits to other RaggieSoft domains and contact info.
 *
 * USAGE:
 * - Included dynamically in the header of book reading views (e.g., `index.php` of a book directory).
 * - Depends on `$bookJsonUrl` being set in the parent scope before inclusion.
 * - Uses WebAwesome components (`<wa-dropdown>`, `<wa-menu>`) for menus.
 *
 * MAINTENANCE NOTES:
 * - WARNING: The "RaggieSoft" dropdown at the end of the file appears to be missing its 
 *   opening `<wa-dropdown>` and `<wa-menu>` tags. It starts with a `<button>` and `<wa-dropdown-item>`s 
 *   but ends with a `</wa-dropdown>`. This is malformed HTML and should be fixed in a future pass 
 *   (left as-is to preserve logic per instructions).
 * - The `Up` link in the Navigate dropdown currently lacks a `value` attribute, meaning it will not 
 *   route anywhere when clicked.
 */

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

<!-- Section: Mobile Navigation Container -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <!-- Library Root Link -->
    <button class="rs-btn" appearance="plain" href="/library/" class="text-primary">Library</button>
  

  
  <!-- Series/Hub Dropdown -->
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


  
  <!-- Dynamic Reader Navigation -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  " href="#"    slot="trigger" appearance="plain">
      <i class="ph ph-compass me-1"></i>Navigate
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="<?php echo $prevLink; ?>">
           <i class="ph ph-arrow-left me-2"></i>Back
        </wa-dropdown-item>
      
      <!-- Note: Missing value attribute for upstream routing -->
      <wa-dropdown-item>
            <i class="ph ph-arrow-up me-2"></i>Up
        </wa-dropdown-item>
      
      <wa-dropdown-item value="<?php echo $nextLink; ?>">
           Next<i class="ph ph-arrow-right ms-2"></i>
        </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

  
  
    <!-- Corporate Links (Note: Malformed HTML missing wa-dropdown/wa-menu wrappers) -->
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