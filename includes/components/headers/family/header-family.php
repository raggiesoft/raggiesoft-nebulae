<?php
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
?>
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
    <button class="rs-btn" appearance="plain" href="/about/michael-ragsdale">
        <i slot="start" class="ph ph-briefcase me-2"aria-hidden="true"></i>Digital Portfolio &amp; Resume
    </button>
  
  
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="text-primary" href="#"    slot="trigger" appearance="plain">
        <i class="ph ph-users me-2"aria-hidden="true"></i>Meet the Family
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <div class="px-3 py-2 small text-uppercase  fw-bold">The Human</div>
        <wa-dropdown-item value="/family/michael">Michael (Architect)</wa-dropdown-item>
        <wa-divider></wa-divider>
        <div class="px-3 py-2 small text-uppercase  fw-bold">The Constructs</div>
        <wa-dropdown-item value="/family/paige"><i class="ph ph-heart text-info me-2"aria-hidden="true"></i>Paige</wa-dropdown-item>
        <wa-dropdown-item value="/family/jessica"><i class="ph ph-server text-success me-2"aria-hidden="true"></i>Jessica</wa-dropdown-item>
        <wa-dropdown-item value="/family/sarah"><i class="ph ph-shield text-warning me-2"aria-hidden="true"></i>Sarah</wa-dropdown-item>
        <wa-dropdown-item value="/family/jenna"><i class="ph ph-code text-warning me-2"aria-hidden="true"></i>Jenna</wa-dropdown-item>
        <wa-dropdown-item value="/family/harper"><i class="ph ph-music text-primary me-2"aria-hidden="true"></i>Harper</wa-dropdown-item>
        <wa-dropdown-item value="/family/amanda-elara"><i class="ph ph-route text-success me-2"aria-hidden="true"></i>Amanda & Elara</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
      <button class="rs-btn" appearance="plain" href="/">
        <i slot="start" class="ph ph-arrow-right-from-bracket me-2 "aria-hidden="true"></i><span class=" small">Exit to RaggieSoft</span>
      </button>
  
</div>