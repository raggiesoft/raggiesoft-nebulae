<?php
// includes/components/headers/case-studies/header-case-studies.php
// Header for the Case Studies / Operational Archives section

$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$isOverview = ($request_uri === '/case-studies');
?>

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/">
        <i slot="start" class="ph ph-house me-2" aria-hidden="true"></i>Home
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/case-studies" class="active">
        <i slot="start" class="ph ph-file-magnifying-glass me-2" aria-hidden="true"></i>Case Studies
    </button>
  

  
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


  
    <button class="rs-btn" appearance="plain" href="/about">
        <i slot="start" class="ph ph-circle-info me-2" aria-hidden="true"></i>Mission
    </button>
  

</div>