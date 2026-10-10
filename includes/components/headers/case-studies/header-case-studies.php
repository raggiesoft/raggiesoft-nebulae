<?php
/**
 * ARCHITECTURE: Case Studies Section Header Component
 * 
 * DESCRIPTION:
 * This component provides the sub-navigation specifically for the "Case Studies" 
 * (or Operational Archives) section of the site. It ensures users can easily return 
 * to the root case studies index while also providing quick links to the author's portfolio.
 *
 * STRUCTURE:
 * - PHP Logic: Extracts `$request_uri` to determine if the user is on the root overview page 
 *   (`$isOverview`). Note: The `$isOverview` variable is defined but currently unused in the HTML below.
 * - Mobile Nav Container: A responsive flexbox wrapper.
 * - Home Link: A simple `rs-btn` linking to `/`.
 * - Case Studies Link: A hardcoded active `rs-btn` linking to `/case-studies`.
 * - The Architect Dropdown: A `wa-dropdown` containing links to the creator's portfolio, resume, and contact page.
 * - Mission Link: A simple `rs-btn` linking to the `/about` directory.
 *
 * USAGE:
 * - Included dynamically as the header on pages within the `/case-studies/` hierarchy.
 * - Relies on custom Web Components (`rs-btn`, `wa-dropdown`, `wa-menu`, `wa-dropdown-item`).
 *
 * MAINTENANCE NOTES:
 * - The `$isOverview` variable is currently calculated but ignored (the "Case Studies" button 
 *   has a hardcoded `class="active"`). If dynamic active states are required in the future, 
 *   this button's class attribute should be updated to use the variable.
 */

// includes/components/headers/case-studies/header-case-studies.php
// Header for the Case Studies / Operational Archives section

$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$isOverview = ($request_uri === '/case-studies');
?>

<!-- Section: Mobile Navigation Container -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <!-- Home Link -->
    <button class="rs-btn" appearance="plain" href="/">
        <i slot="start" class="ph ph-house me-2" aria-hidden="true"></i>Home
    </button>
  

  
    <!-- Case Studies Index Link (Currently Hardcoded to Active) -->
    <button class="rs-btn" appearance="plain" href="/case-studies" class="active">
        <i slot="start" class="ph ph-file-magnifying-glass me-2" aria-hidden="true"></i>Case Studies
    </button>
  

  
  <!-- The Architect Dropdown Profile Menu -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn"  href="#"    slot="trigger" appearance="plain">
        <i class="ph ph-user-visor me-2" aria-hidden="true"></i>The Architect
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="/about/michael-ragsdale"><i class="ph ph-id-card me-2"></i>Overview</wa-dropdown-item>
      <wa-dropdown-item value="/about/michael-ragsdale/resume"><i class="ph ph-file-user me-2"></i>Resume / CV</wa-dropdown-item>
      <wa-divider></wa-divider>
      <wa-dropdown-item value="/contact"><i class="ph ph-envelope-open me-2"></i>Contact</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <!-- Mission / About Link -->
    <button class="rs-btn" appearance="plain" href="/about">
        <i slot="start" class="ph ph-circle-info me-2" aria-hidden="true"></i>Mission
    </button>
  

</div>