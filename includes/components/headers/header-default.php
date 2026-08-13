<?php
// includes/components/headers/header-default.php
// UPDATED: Web Awesome Edition
// Serves as the global navigation for the root domain

// 1. Determine Active States
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$isHome = ($request_uri === '/');
$isArchitect = (str_starts_with($request_uri, '/about/michael-ragsdale') || str_starts_with($request_uri, '/portfolio'));
$isCreative = (str_starts_with($request_uri, '/raggiesoft-books') || str_starts_with($request_uri, '/engine-room'));
$isMedia = str_starts_with($request_uri, '/raggiesoft-media');
$isAbout = ($request_uri === '/about');
$isContact = ($request_uri === '/contact');
?>

<div class="wa-flex wa-gap-2xs wa-align-center">

  <!-- Home -->
  <wa-button appearance="plain" href="/" variant="<?php echo $isHome ? 'brand' : 'neutral'; ?>">
    <i slot="start" class="fa-duotone fa-house" aria-hidden="true"></i> Home
  </wa-button>

  <!-- The Architect -->
  <wa-button appearance="plain" href="/about/michael-ragsdale" variant="<?php echo $isArchitect ? 'brand' : 'neutral'; ?>">
    <i slot="start" class="fa-duotone fa-user-visor" aria-hidden="true"></i> The Architect
  </wa-button>

  <!-- Creative Works Dropdown -->
  <wa-dropdown placement="bottom-end">
    <wa-button slot="trigger" appearance="plain" with-caret variant="<?php echo $isCreative ? 'brand' : 'neutral'; ?>">
        <i slot="start" class="fa-duotone fa-layer-group" aria-hidden="true"></i> Creative Works
    </wa-button>
    
    <div class="wa-padding-inline-m wa-padding-block-s wa-text-uppercase wa-font-bold wa-font-size-xs" style="color: var(--wa-color-neutral-text-quiet);">Multimedia</div>
    
    <wa-dropdown-item value="/engine-room/artists/stardust-engine">
      <i slot="icon" class="fa-duotone fa-rocket-launch" style="color: var(--wa-color-brand-text);"></i> The Stardust Engine
    </wa-dropdown-item>
    
    <wa-dropdown-item value="/engine-room/radio">
      <i slot="icon" class="fa-duotone fa-signal-stream" style="color: var(--wa-color-warning-text);"></i> Engine Room Radio
    </wa-dropdown-item>
    
    <wa-divider></wa-divider>
    
    <div class="wa-padding-inline-m wa-padding-block-s wa-text-uppercase wa-font-bold wa-font-size-xs" style="color: var(--wa-color-neutral-text-quiet);">Literature</div>
    
    <wa-dropdown-item value="/raggiesoft-books/aethel-saga">
      <i slot="icon" class="fa-duotone fa-sword" style="color: var(--wa-color-warning-text);"></i> The Silver Gauntlet of Aethel
    </wa-dropdown-item>
    
    <wa-dropdown-item value="/raggiesoft-books/knox">
      <i slot="icon" class="fa-duotone fa-leaf" style="color: var(--wa-color-success-text);"></i> Project: KNOX
    </wa-dropdown-item>
    
    <wa-divider></wa-divider>
    
    <wa-dropdown-item value="/engine-room">
      <i slot="icon" class="fa-solid fa-industry" style="color: var(--wa-color-neutral-text);"></i> Engine Room Records
    </wa-dropdown-item>
  </wa-dropdown>

  <!-- RaggieSoft Media Dropdown -->
  <wa-dropdown placement="bottom-end">
    <wa-button slot="trigger" appearance="plain" with-caret variant="<?php echo $isMedia ? 'brand' : 'neutral'; ?>">
        <i slot="start" class="fa-duotone fa-building" aria-hidden="true"></i> RaggieSoft Media
    </wa-button>
    
    <div class="wa-padding-inline-m wa-padding-block-s wa-text-uppercase wa-font-bold wa-font-size-xs" style="color: var(--wa-color-neutral-text-quiet);">B2B Operations</div>
    
    <wa-dropdown-item value="/raggiesoft-media">
      <i slot="icon" class="fa-duotone fa-network-wired" style="color: var(--wa-color-brand-text);"></i> Corporate Hub
    </wa-dropdown-item>
    
    <wa-dropdown-item value="/raggiesoft-media/licensing">
      <i slot="icon" class="fa-duotone fa-scale-balanced" style="color: var(--wa-color-warning-text);"></i> Master Licensing
    </wa-dropdown-item>
    
    <wa-dropdown-item value="/raggiesoft-media/licensing/commercial">
      <i slot="icon" class="fa-solid fa-briefcase" style="color: var(--wa-color-neutral-text);"></i> Commercial Portal
    </wa-dropdown-item>
    
    <wa-divider></wa-divider>
    
    <div class="wa-padding-inline-m wa-padding-block-s wa-text-uppercase wa-font-bold wa-font-size-xs" style="color: var(--wa-color-neutral-text-quiet);">Infrastructure</div>
    
    <wa-dropdown-item value="/raggiesoft-media/projects/stardust-engine-cms">
      <i slot="icon" class="fa-brands fa-rocket-launch" style="color: var(--wa-color-brand-text);"></i> Stardust Engine CMS
    </wa-dropdown-item>
  </wa-dropdown>

  <!-- Mission Profile -->
  <wa-button appearance="plain" href="/about" variant="<?php echo $isAbout ? 'brand' : 'neutral'; ?>">
    <i slot="start" class="fa-duotone fa-circle-info" aria-hidden="true"></i> Mission Profile
  </wa-button>

  <!-- Contact -->
  <wa-button appearance="plain" href="/contact" variant="<?php echo $isContact ? 'brand' : 'neutral'; ?>">
    <i slot="start" class="fa-duotone fa-envelope-open" aria-hidden="true"></i> Contact
  </wa-button>

</div>

<!-- Dropdown Navigation Routing Script -->
<script>
  document.addEventListener('wa-select', event => {
      const item = event.detail.item;
      if (item && item.value && item.value.startsWith('/')) {
          window.location.href = item.value;
      }
  });
</script>
