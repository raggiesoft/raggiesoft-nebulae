<?php
// includes/components/headers/raggiesoft-books/header-knox.php
// Adapted from Engine Room Records template.
// Context: Navigation for the specific book "Knox".
// Theme: Stark, Functional, Adaptive Colors.

$uri = $_SERVER['REQUEST_URI'] ?? '';

// Determine active states
$isChapters = str_contains($uri, '/chapters');
$isLore     = str_contains($uri, '/lore');
$isChars    = str_contains($uri, '/characters');
?>

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">

  
    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/knox/chapters" class="<?php echo $isChapters ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-book-open-reader me-2"></i>Read the Story
    </button>
  

  
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  <?php echo ($isLore || $isChars) ? 'active' : ''; ?>" slot="trigger" appearance="plain">
      <i class="ph ph-planet-ringed me-2"></i>The Telsan Gap
     <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase text-success fw-bold">The Reality</div>
      <wa-dropdown-item value="/raggiesoft-books/knox/characters">
            <i class="ph ph-users me-2 text-body-secondary"></i>The Twins & Pip
          </wa-dropdown-item>
      <wa-dropdown-item value="/raggiesoft-books/knox/lore/aerie-hold">
            <i class="ph ph-tree me-2 text-body-secondary"></i>Aerie-Hold
          </wa-dropdown-item>

      <wa-divider></wa-divider>
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase text-danger fw-bold">The Threat</div>
      <wa-dropdown-item value="/raggiesoft-books/knox/lore/axiom-corp">
            <i class="ph ph-building me-2 text-danger"></i>The Axiom
          </wa-dropdown-item>
      <wa-dropdown-item value="/raggiesoft-books/knox/lore/port-telsus">
            <i class="ph ph-industry-windows me-2 text-danger"></i>Port Telsus
          </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


  
      <button class="rs-btn" appearance="plain" href="/">
        <i slot="start" class="ph ph-arrow-right-from-bracket me-2 text-body-secondary"></i><span class="text-body-secondary small">Exit to RaggieSoft</span>
      </button>
  

</div>