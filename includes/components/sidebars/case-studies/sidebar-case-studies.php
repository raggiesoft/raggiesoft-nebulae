<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Sidebar navigation for the internal "Case Studies" / Incident Reports archive.
 * Architecture: Utilizes static Web Awesome `rs-btn` components styled as plain text links 
 * (`appearance="plain"`) to create a brutalist, administrative directory feel. No active-state
 * logic is currently implemented.
 * Future Maintainers: If the case studies library expands significantly, implement the `$_SERVER['REQUEST_URI']`
 * active-state logic from `sidebar-about.php`. Maintain the severe, report-driven aesthetics.
 */
?>
// includes/components/sidebars/case-studies/sidebar-case-studies.php
?>
<!-- Root Section: Returns the user to the high-level case study overview -->
<h5 class="pt-3 pb-2 mb-3 border-bottom">Operational Archives</h5>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/case-studies" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-layer-group"></i> Overview
    </button>
  
</div>

<!-- Specific Incident Reports Directory -->
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
  <span>Incident Reports</span>
</h6>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/case-studies/cascade-protocol" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-heart-pulse"></i> The Cascade Protocol
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="/case-studies/shenandoah-valley" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-route"></i> Shenandoah Gauntlet
    </button>
  
</div>

<!-- System Navigation: Escape hatch back to the global homepage -->
<h5 class="pt-3 pb-2 mb-3 mt-5 border-bottom">System</h5>
<div class="d-flex flex-column gap-1">
  
    <button class="rs-btn" appearance="plain" href="/" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
      <i slot="start" class="ph ph-arrow-left"></i> Return to Main
    </button>
  
</div>