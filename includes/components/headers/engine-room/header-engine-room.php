<?php
/**
 * ARCHITECTURE & PURPOSE:
 * This component renders the primary navigation header for the Engine Room imprint.
 * It routes users to key areas like Engine Room Radio, the active artist roster, 
 * company archives, and B2B industry contacts (licensing/sync).
 *
 * MAINTENANCE NOTES:
 * - Active state detection is dynamically handled by parsing `$_SERVER['REQUEST_URI']`.
 * - Uses Web Awesome (wa-dropdown, wa-menu) components for responsive sub-menus.
 * - Email addresses are obfuscated using `data-u`, `data-d`, and `data-t` attributes to deter scraping.
 */
// includes/components/headers/engine-room/header-engine-room.php
// The Official Imprint Navigation. 
// Fan-Centric Focus with Corporate Routing to RaggieSoft Media.

// 1. Determine Active States
$uri = $_SERVER['REQUEST_URI'] ?? '';

$isRoster = str_starts_with($uri, '/engine-room/artists');
$isRadio = str_contains($uri, '/radio');
$isArchives = (
    str_starts_with($uri, '/engine-room/history') || 
    str_contains($uri, '/corporate') ||
    str_contains($uri, '/story')
);
?>

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">

  <button class="rs-btn" appearance="plain" href="/engine-room/radio" class="<?php echo $isRadio ? 'text-warning' : ''; ?>">
    <i slot="start" class="ph ph-signal-stream"></i> Engine Room Radio
  </button>

  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" slot="trigger" appearance="plain" with-caret class="<?php echo $isRoster ? 'text-primary' : ''; ?>">
      <i slot="start" class="ph ph-compact-disc"></i> The Roster
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <wa-dropdown-item value="/engine-room/artists">View Full Roster</wa-dropdown-item>
    <wa-divider></wa-divider>
    <div class="px-3 py-2 small text-uppercase text-primary fw-bold">Active Artists</div>
    <wa-dropdown-item value="/engine-room/artists/stardust-engine">
      <i slot="start" class="ph ph-rocket-launch text-primary"></i> The Stardust Engine
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/artists/crimson-node">
      <i slot="start" class="ph ph-waveform-lines text-danger"></i> Crimson Node
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/artists/fractured-prisms">
      <i slot="start" class="ph ph-gem "></i> Fractured Prisms
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/artists/the-paper-wall">
      <i slot="start" class="ph ph-waveform-lines text-danger"></i> The Paper Wall
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/artists/the-winter-palace">
      <i slot="start" class="ph ph-snowflake text-info"></i> The Winter Palace
    </wa-dropdown-item>
    <wa-dropdown-item value="/raggiesoft-books/aethel-saga">
      <i slot="start" class="ph ph-sword text-warning"></i> Firelight
    </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" slot="trigger" appearance="plain" with-caret class="<?php echo $isArchives ? 'text-primary' : ''; ?>">
      <i slot="start" class="ph ph-box-archive"></i> The Archives
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <div class="px-3 py-2 small text-uppercase  fw-bold">Company History</div>
    <wa-dropdown-item value="/engine-room/history">
      <i slot="start" class="ph ph-clock-rotate-left "></i> Full Timeline
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/about">
      <i slot="start" class="ph ph-industry "></i> About The Fortress
    </wa-dropdown-item>
    <wa-divider></wa-divider>
    <div class="px-3 py-2 small text-uppercase  fw-bold">Declassified Case Files</div>
    <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/friction">
      <i slot="start" class="ph ph-fire text-danger"></i> 1992: The Friction Scandal
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/nine-figure-refusal">
      <i slot="start" class="ph ph-ban text-success"></i> 2018: The $150M Refusal
    </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

  <wa-dropdown placement="bottom-end">
    <button class="rs-btn" slot="trigger" appearance="plain" with-caret class="text-body-secondary">
      <i slot="start" class="ph ph-briefcase"></i> Industry
        <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
    </button>
    <wa-menu>
      <div class="px-3 py-2 small text-uppercase  fw-bold">B2B Operations</div>
    <wa-dropdown-item value="/raggiesoft-media/licensing">
      <i slot="start" class="ph ph-handshake text-primary"></i> Master Licensing Portal
    </wa-dropdown-item>
    <wa-dropdown-item value="/engine-room/dsp-verification">
      <i slot="start" class="ph ph-shield-check text-success"></i> DSP Verification Desk
    </wa-dropdown-item>
    <wa-divider></wa-divider>
    <div class="px-3 py-2 small text-uppercase  fw-bold">Media Contacts</div>
    <wa-dropdown-item class="elara-secure-mail font-monospace" value="#" data-u="sync" data-d="raggiesoftmedia" data-t="com">
      <i slot="start" class="ph ph-file-audio text-warning"></i> sync@raggiesoftmedia.com
    </wa-dropdown-item>
    <wa-dropdown-item class="elara-secure-mail font-monospace" value="#" data-u="ops" data-d="raggiesoftmedia" data-t="com">
      <i slot="start" class="ph ph-envelope "></i> ops@raggiesoftmedia.com
    </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>

  <div class="ms-2 ps-2 border-start border-secondary border-">
      <button class="rs-btn" appearance="plain" variant="neutral" href="/" class="text-body-secondary">
        <i slot="start" class="ph ph-arrow-right-from-bracket"></i> Exit to RaggieSoft
      </button>
  </div>

</div>
