<?php
/**
 * ARCHITECTURE: Corporate Intranet Header Navigation
 * 
 * This component serves as the primary navigation bar for the Corporate Intranet
 * section of the Engine Room. It provides access to various corporate entities,
 * structures, and operational systems.
 * 
 * COMPONENTS:
 * 1. Top-Level Navigation: Static links to the corporate Dashboard and Structure pages.
 * 2. Entities Dropdown: A categorized menu linking to different operating companies 
 *    and philanthropic arms.
 * 3. Ops Dropdown: A section dedicated to internal operational systems like IT and Fleet Command.
 * 4. Exit Link: A stylized button to return to the public-facing Engine Room site.
 */

// includes/components/headers/engine-room/corporate/header.php
// Context: The Corporate Intranet Navigation.
?>
<!-- RESPONSIVE INTRANET NAVIGATION CONTAINER -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/corporate">
        <i slot="start" class="ph ph-building-columns me-2"></i>Dashboard
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/engine-room/corporate/structure">
        <i slot="start" class="ph ph-sitemap me-2"></i>Structure
    </button>
  

  
  <!-- ENTITIES DROPDOWN -->
  <!-- Categorized list of corporate holdings and initiatives -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn"  href="#"    slot="trigger" appearance="plain">
        <i class="ph ph-briefcase me-2"></i>Entities
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <div class="px-3 py-2 small text-uppercase  fw-bold">Operating Companies</div>
        <wa-dropdown-item value="/engine-room"><i class="ph ph-record-vinyl me-2 text-danger"></i>Engine Room Records</wa-dropdown-item>
        <wa-dropdown-item value="/engine-room/corporate/aethelgard"><i class="ph ph-gavel me-2 "></i>Aethelgard Holdings</wa-dropdown-item>
        <wa-dropdown-item value="/pacific-rim"><i class="ph ph-city me-2 text-primary"></i>Pacific Rim Properties</wa-dropdown-item>
        <wa-divider></wa-divider>
        <div class="px-3 py-2 small text-uppercase  fw-bold">Philanthropy</div>
        <wa-dropdown-item value="/engine-room/corporate/leadership"><i class="ph ph-hand-holding-heart me-2 text-success"></i>Jessica Miller Center</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
  <!-- OPERATIONS DROPDOWN -->
  <!-- Links to internal systems and command interfaces -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn"  href="#"    slot="trigger" appearance="plain">
        <i class="ph ph-server me-2"></i>Ops
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <div class="px-3 py-2 small text-uppercase  fw-bold text-info">Internal Only</div>
        <wa-dropdown-item value="/engine-room/corporate/systems"><i class="ph ph-terminal me-2"></i>Systems (Justin)</wa-dropdown-item>
        <wa-dropdown-item value="/engine-room/corporate/fleet"><i class="ph ph-bus me-2"></i>Fleet Command</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <!-- EXIT LINK -->
    <!-- Provides a clear path back to the public-facing site -->
    <button class="rs-btn" appearance="plain" href="/engine-room" class="text-dark">
        Exit to Public Site <i slot="start" class="ph ph-arrow-right-from-bracket ms-2"></i>
    </button>
  

</div>