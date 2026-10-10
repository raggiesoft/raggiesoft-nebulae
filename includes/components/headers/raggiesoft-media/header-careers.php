<?php
/**
 * ARCHITECTURE: RaggieSoft Media "Quarantine" Careers Header Component
 * 
 * DESCRIPTION:
 * This component acts as a specialized, restricted header for the "Careers" section.
 * It intentionally omits global navigation links to trap the user's focus on a high-priority 
 * message (an "Active Fraud Alert"). It provides only a single escape hatch back to the main portal.
 *
 * STRUCTURE:
 * - Internal <style> block: Contains custom "Frutiger Aero Danger Glass" styling for the alert badge
 *   and the glass-morphic exit button, including light/dark mode variants.
 * - Mobile Nav Container: A flex container (`.mobile-nav-menu`) holding the UI elements.
 * - Alert Badge: A glowing, pulsing indicator warning of fraud.
 * - Exit Button: A custom web component (`rs-btn`) serving as the sole outbound link.
 *
 * USAGE:
 * - Included dynamically as the header replacement on career/hiring related pages where fraud 
 *   warnings are necessary.
 * - Uses Phosphor Icons (`ph-*`) and FontAwesome utilities (`fa-fade`) for animation.
 *
 * MAINTENANCE NOTES:
 * - DO NOT add standard navigation links here. The "quarantine" design pattern is intentional.
 * - The `<button class="rs-btn">` component handles its own routing via the `href` attribute.
 * - If removing the fraud alert in the future, this entire header should likely be swapped back 
 *   to the standard `header-default.php`.
 */

// includes/components/headers/raggiesoft-media/header-careers.php
// The Quarantine Header - Explicitly removes global navigation to focus on the fraud alert.
// Updated: Frutiger Aero Danger Glass
?>

<style>
    /* Glowing Danger Badge */
    .aero-badge-danger {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
        border: 1px solid #ff6b7a;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 0 12px rgba(220, 53, 69, 0.4);
        color: #fff;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }
    [data-bs-theme="dark"] .aero-badge-danger {
        background: linear-gradient(135deg, #ff4d5e 0%, #dc3545 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6), 0 0 15px rgba(220, 53, 69, 0.6);
        color: #000;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.5);
    }

    /* Glass Exit Button */
    .btn-glass-exit {
        background: rgba(108, 117, 125, 0.1);
        border: 1px solid rgba(108, 117, 125, 0.3);
        color: var(--bs-secondary) !important;
        backdrop-filter: blur(4px);
        transition: all 0.2s ease;
    }
    .btn-glass-exit:hover {
        background: rgba(108, 117, 125, 0.2);
        color: var(--bs-body-color) !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
    }
</style>

<!-- Section: Restricted Header Layout -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <!-- Fraud Alert Badge (Primary Focus) -->
    <span class="badge aero-badge-danger text-uppercase px-3 py-2 rounded-pill shadow-sm">
      <i class="ph ph-circle-dot fa-fade me-2" aria-hidden="true"></i>Active Fraud Alert
    </span>
  

  
    <!-- Single Escape Link -->
    <button class="rs-btn" appearance="plain" href="/raggiesoft-media" class="btn btn-glass-exit btn-sm rounded-pill px-3 py-1 fw-bold">
        <i slot="start" class="ph ph-arrow-right-from-bracket me-2" aria-hidden="true"></i>Exit to RaggieSoft Media
    </button>
  

</div>