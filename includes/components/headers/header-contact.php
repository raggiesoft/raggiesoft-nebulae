<?php
// includes/components/headers/header-contact.php
// Navigation for the Global Contact Hub.
// UPDATED: Matches the new RaggieSoft Hub structure (Architect vs. Creative)

$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$isArchitect = (str_starts_with($request_uri, '/about/michael-ragsdale'));
?>

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/">
        <i slot="start" class="ph ph-house me-2" aria-hidden="true"></i>Home
    </button>
  

  
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  <?php echo $isArchitect ? 'active' : ''; ?>" slot="trigger" appearance="plain">
        <i class="ph ph-user-visor me-2" aria-hidden="true"></i>The Architect
     <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="/about/michael-ragsdale"><i class="ph ph-id-card me-2"></i>Overview</wa-dropdown-item>
      <wa-dropdown-item value="/about/michael-ragsdale/resume"><i class="ph ph-file-user me-2"></i>Resume / CV</wa-dropdown-item>
      <wa-divider></wa-divider>
      <wa-dropdown-item value="/about/michael-ragsdale/contact"><i class="ph ph-address-card me-2"></i>Recruiter Contact</wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
    <button class="rs-btn" appearance="plain" href="/engine-room">
        <i slot="start" class="ph ph-industry me-2" aria-hidden="true"></i>Engine Room
    </button>
  

  
    <button class="rs-btn" appearance="plain" href="/contact" class="active">
        <i slot="start" class="ph ph-envelope-open me-2" aria-hidden="true"></i>Contact
    </button>
  

</div>