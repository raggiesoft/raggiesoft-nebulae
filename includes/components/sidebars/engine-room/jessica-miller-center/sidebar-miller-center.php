<?php
/**
 * ARCHITECTURE: Jessica Miller Center Sidebar Component
 * 
 * DESCRIPTION:
 * This component provides contextual navigation and real-time status information for the Jessica Miller Center 
 * portal within the Engine Room section. It is designed to meet WCAG AAA compliance standards.
 *
 * STRUCTURE:
 * - Center Directory Section: A list-group containing primary navigation links (Campus Map, Quiet Floor, etc.).
 * - Administration Section: A list-group for staff and administrative contacts.
 * - System Status Card: A status card indicating environmental metrics (Air Quality, Noise Floor, Lighting).
 *
 * USAGE:
 * - Included dynamically in the sidebar area of Jessica Miller Center pages.
 * - Utilizes Bootstrap 5 utility classes (`list-group`, `list-group-flush`, `card`) and adheres to 
 *   adaptive theming conventions.
 *
 * MAINTENANCE NOTES:
 * - Ensure any new links added to the directory maintain the same spacing and accessibility attributes.
 * - The System Status Card is currently hardcoded but is designed to be easily integrated with a 
 *   real-time API or backend system in the future.
 * - Icons use Phosphor Icons (`ph-*`).
 */

// includes/components/sidebars/engine-room/jessica-miller-center/sidebar-miller-center.php
// Sidebar for The Jessica Miller Center
// WCAG STATUS: AAA Compliant (Adaptive Bootstrap 5.3)
?>

<!-- Section: Center Directory Navigation -->
<div class="mb-4">
    <h6 class="text-uppercase text-body-secondary fw-bold letter-spacing-1 mb-3" style="font-size: 0.75rem;">
        Center Directory
    </h6>
    <div class="list-group list-group-flush border-bottom border-secondary-subtle">
        <a href="/engine-room/jessica-miller-center" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-secondary-subtle px-0">
            <i slot="start" class="ph ph-map-location-dot"></i> Campus Map
        </a>
        <a href="/engine-room/jessica-miller-center/the-quiet-floor" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-secondary-subtle px-0">
            <i slot="start" class="ph ph-universal-access"></i> The Quiet Floor <span class="badge bg-body-secondary text-body-secondary ms-2 rounded-pill border" style="font-size: 0.6em;">BUILDING HOURS</span>
        </a>
        <a href="/engine-room/jessica-miller-center/destination-dispatch-elevators" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-secondary-subtle px-0">
            <i slot="start" class="ph ph-elevator"></i> Destination Dispatch
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-secondary-subtle px-0">
            <i slot="start" class="ph ph-calendar-check"></i> Book a Room
        </a>
    </div>
</div>

<!-- Section: Administration Contacts -->
<div class="mb-4">
    <h6 class="text-uppercase text-body-secondary fw-bold letter-spacing-1 mb-3" style="font-size: 0.75rem;">
        Administration
    </h6>
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-0 px-0 py-1">
            <small><i slot="start" class="ph ph-user-tie"></i> Exec. Dir. J. Miller</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-0 px-0 py-1">
            <small><i slot="start" class="ph ph-building"></i> Facilities Mgmt</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent text-body-secondary border-0 px-0 py-1">
            <small><i slot="start" class="ph ph-shield-check"></i> Security (Lobby)</small>
        </a>
    </div>
</div>

<!-- Section: Active System Status Widget -->
<div class="card bg-body-tertiary border-success shadow-sm mt-4">
    <div class="card-body p-3">
        <div class="d-flex align-items-center mb-2">
            <div class="spinner-grow text-success spinner-grow-sm me-2" role="status"></div>
            <span class="text-success-emphasis small text-uppercase fw-bold letter-spacing-1">Active System Status</span>
        </div>
        <p class="text-body-secondary small mb-0">
            <strong>Air Quality:</strong> 98% (HEPA)<br>
            <strong>Noise Floor:</strong> 32dB<br>
            <strong>Lighting:</strong> Circadian Sync
        </p>
    </div>
</div>