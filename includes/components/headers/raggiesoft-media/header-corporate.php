<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: CORPORATE MEDIA B2B HEADER
 * ============================================================================
 * 
 * This header component provides the global B2B (Business-to-Business) 
 * navigation for the "RaggieSoft Media" holding entity. It emphasizes 
 * licensing, open-source projects, and corporate commercial access.
 * 
 * MAINTENANCE NOTES:
 * - Employs Web Awesome (`wa-dropdown`, `wa-menu`) and custom `rs-btn` 
 *   elements for interactive dropdowns and styled routing.
 * - Dynamic active state calculation leverages `$_SERVER['REQUEST_URI']`.
 * ============================================================================
 */
// includes/components/headers/raggiesoft-media/header-corporate.php
// The global B2B navigation for the RaggieSoft Media holding entity.
// Updated: Web Awesome Components

$request_uri = $_SERVER['REQUEST_URI'] ?? '/raggiesoft-media';
$isHub = ($request_uri === '/raggiesoft-media');
$isLicensing = (str_starts_with($request_uri, '/raggiesoft-media/licensing'));
$isOpenSource = (str_starts_with($request_uri, '/raggiesoft-media/projects'));
$isPortfolio = (str_starts_with($request_uri, '/about/michael-ragsdale'));
?>

<div class="d-flex flex-wrap align-items-center gap-2 ms-auto text-uppercase fw-bold" style="letter-spacing: 0.5px;">
  
  <button class="rs-btn" href="/raggiesoft-media" pill
    variant="<?php echo $isHub ? 'brand' : 'neutral'; ?>" 
    appearance="<?php echo $isHub ? 'filled-outlined' : 'plain'; ?>">
    <i slot="start" class="ph ph-house-building"></i> Hub
  </button>

  <button class="rs-btn" href="/raggiesoft-media/licensing" pill
    variant="<?php echo $isLicensing ? 'warning' : 'neutral'; ?>" 
    appearance="<?php echo $isLicensing ? 'filled-outlined' : 'plain'; ?>">
    <i slot="start" class="ph ph-file-signature"></i> Master Licensing
  </button>

  <wa-dropdown placement="bottom-end">
    <button class="rs-btn" slot="trigger" with-caret pill
      variant="<?php echo $isOpenSource ? 'neutral' : 'neutral'; ?>" 
      appearance="<?php echo $isOpenSource ? 'filled-outlined' : 'plain'; ?>">
      <i slot="start" class="fa-brands fa-osi"></i> Open Source
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="/raggiesoft-media/projects">
      <i slot="start" class="ph ph-network-wired text-info"></i> Projects Hub
    </wa-dropdown-item>
    <wa-dropdown-item value="/raggiesoft-media/projects/stardust-engine-cms">
      <i slot="start" class="ph ph-rocket-launch text-primary"></i> Stardust Engine CMS
    </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

  <button class="rs-btn" href="/about/michael-ragsdale" pill
    variant="<?php echo $isPortfolio ? 'success' : 'neutral'; ?>" 
    appearance="<?php echo $isPortfolio ? 'filled-outlined' : 'plain'; ?>"
    class="me-3">
    <i slot="start" class="ph ph-user-tie <?php echo !$isPortfolio ? 'text-success' : ''; ?>"></i> Architect Portfolio
  </button>

  <div class="d-none d-md-flex align-items-center ps-3" style="border-left: 1px solid var(--wa-color-neutral-border-quiet); opacity: 0.8;">
    <button class="rs-btn" href="/raggiesoft-media/licensing/commercial" variant="brand" appearance="filled" pill>
        <i slot="start" class="ph ph-briefcase"></i> Commercial Portal
    </button>
  </div>

  <div class="ms-2 ps-2 border-start border-secondary border-">
      <button class="rs-btn" appearance="plain" variant="neutral" href="/" class="text-body-secondary">
        <i slot="start" class="ph ph-arrow-right-from-bracket"></i> Exit to RaggieSoft
      </button>
  </div>

</div>
