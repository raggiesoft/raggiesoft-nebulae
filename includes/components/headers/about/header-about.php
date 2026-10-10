<?php
/**
 * ARCHITECTURE: "About" Section Header Navigation Component
 * 
 * DESCRIPTION:
 * This component provides the sub-navigation menu specifically tailored for the `/about/*` 
 * directory (also known as the "Mission Profile"). It dynamically determines the active 
 * navigation state based on the requested URI and renders Web Components (WebAwesome) 
 * for dropdown menus.
 *
 * STRUCTURE:
 * - PHP Routing Logic: Extracts the URI and evaluates `$isGovernance` and `$isProfiles` 
 *   to determine which dropdown should receive the 'active' styling class.
 * - Mobile Nav Container: A flexbox wrapper ensuring correct alignment across breakpoints.
 * - Home Link: A simple `rs-btn` linking back to the root.
 * - Governance Dropdown: A `wa-dropdown` containing links to legal/policy documents (Licenses, Privacy, etc.).
 * - Network Profiles Dropdown: A categorized `wa-dropdown` linking to author portfolios, DevOps info, and major projects.
 * - Contact Link: A simple `rs-btn` pointing to the contact page.
 *
 * USAGE:
 * - Dynamically included in the header area of any page residing within the `/about/` path hierarchy.
 * - Relies on custom Web Components (`<wa-dropdown>`, `<wa-menu>`, `<wa-dropdown-item>`) for interactive menus.
 *
 * MAINTENANCE NOTES:
 * - The logic for `$isGovernance` uses `str_contains` which matches substrings anywhere in the URI. 
 *   Be careful of false positives if new paths are added that include these keywords (e.g., `/about/not-privacy`).
 * - Dropdown items use `value` attributes for their destinations. An external JavaScript listener 
 *   (likely bound to `wa-select` events) is required to handle the actual routing when an item is clicked.
 */

// includes/components/headers/about/header-about.php
// Navigation for the /about/* directory (Mission Profile)

$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Determine active section
$isGovernance = (str_contains($uri, '/license') || str_contains($uri, '/privacy') || str_contains($uri, '/terms') || str_contains($uri, '/ai-disclaimer'));
$isProfiles   = (!$isGovernance && $uri !== '/about'); // If not governance and not root about, assume it's a profile
?>

<!-- Section: Mobile Navigation Container -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <!-- Home Link -->
    <button class="rs-btn" appearance="plain" href="/">
        <i slot="start" class="ph ph-house me-2"></i>Home
    </button>
  

  
  <!-- Governance Dropdown Menu -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  <?php echo $isGovernance ? 'active' : ''; ?>" slot="trigger" appearance="plain">
        <i class="ph ph-scale-balanced me-2"></i>Governance
     <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="/raggiesoft-media/licensing"><i class="ph ph-file-certificate me-2 text-primary"></i>Licenses (MIT/CC)</wa-dropdown-item>
      <wa-dropdown-item value="/about/privacy"><i class="ph ph-shield-check me-2 text-success"></i>Privacy Policy</wa-dropdown-item>
      <wa-dropdown-item value="/about/terms"><i class="ph ph-gavel me-2 text-warning"></i>Terms of Service</wa-dropdown-item>
      <wa-dropdown-item value="/about/ai-disclaimer"><i class="ph ph-robot me-2 text-info"></i>AI Disclaimer</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
  <!-- Network Profiles Dropdown Menu -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  <?php echo $isProfiles ? 'active' : ''; ?>" slot="trigger" appearance="plain">
        <i class="ph ph-sitemap me-2"></i>Network Profiles
     <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <!-- Sub-category: The Core -->
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase">The Core</div>
      <wa-dropdown-item value="/about/michael-ragsdale"><i class="ph ph-user-visor me-2"></i>The Architect (Portfolio)</wa-dropdown-item>
      <wa-dropdown-item value="/about/family"><i class="ph ph-people-group me-2"></i>The Family (DevOps)</wa-dropdown-item>
      
      <wa-divider></wa-divider>
      
      <!-- Sub-category: The Projects -->
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase">The Projects</div>
      <wa-dropdown-item value="/about/engine-room"><i class="ph ph-industry me-2"></i>Engine Room Records</wa-dropdown-item>
      <wa-dropdown-item value="/about/stardust-engine"><i class="ph ph-rocket-launch me-2"></i>The Stardust Engine</wa-dropdown-item>
      <wa-dropdown-item value="/about/aethel"><i class="ph ph-sword me-2"></i>The Aethel Saga</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <!-- Contact Link -->
    <button class="rs-btn" appearance="plain" href="/contact">
        <i slot="start" class="ph ph-envelope me-2"></i>Contact
    </button>
  

</div>