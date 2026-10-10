<?php
/**
 * ARCHITECTURE: RaggieSoft Media Licensing Sidebar Component
 * 
 * DESCRIPTION:
 * This component provides contextual navigation and contact information for the Master Licensing portal 
 * within the RaggieSoft Media section. It includes navigation links to various IP portfolio categories 
 * (Overview, Commercial Sync, Creative Commons, MIT Architecture) and direct email links to relevant desks.
 *
 * STRUCTURE:
 * - Internal <style> block: Contains 'Frutiger Aero Glass' styling for the navigation links, including
 *   pill-shaped buttons, hover transitions, and monospace email blocks.
 * - IP Portfolio Section: A card containing a list of buttons (`rs-btn`) for internal portal navigation.
 * - Direct Desks Section: A transparent card containing a list of direct email links styled as monospace blocks.
 *
 * USAGE:
 * - Included dynamically in the sidebar area of licensing-related pages within the RaggieSoft Media section.
 * - Utilizes Bootstrap 5 utility classes (e.g., `card`, `d-flex`, `text-uppercase`) and custom 
 *   CSS variables for theming.
 *
 * MAINTENANCE NOTES:
 * - When updating styles, ensure compatibility with both light and dark themes (see `[data-bs-theme="dark"]` selector).
 * - The navigation buttons use a custom element `<button class="rs-btn">` which handles its own routing (via `href`).
 * - Icons are sourced from Phosphor Icons (`ph-*`) and FontAwesome (`fa-*`).
 */

// includes/components/sidebars/raggiesoft-media/licensing/sidebar-licensing.php
// Contextual navigation for the Master Licensing portal.
// Updated: Frutiger Aero Glass Navigation
?>

<style>
    /* Aero Glass Navigation Tabs */
    .aero-nav-link {
        border-radius: 50rem; /* Pill shape */
        padding: 0.5rem 1rem;
        margin-bottom: 0.25rem;
        transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 1px solid transparent;
        font-weight: 500;
    }
    
    /* Individual Hover States based on Brand Colors */
    .aero-nav-link.nav-primary:hover, .aero-nav-link.nav-primary:focus {
        background: rgba(0, 130, 230, 0.1);
        border: 1px solid rgba(0, 130, 230, 0.3);
        color: var(--bs-primary) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
        transform: translateX(4px);
    }
    [data-bs-theme="dark"] .aero-nav-link.nav-primary:hover {
        background: rgba(0, 229, 255, 0.15);
        border-color: rgba(0, 229, 255, 0.4);
        color: var(--mpr-cyan-400) !important;
        text-shadow: 0 0 8px rgba(0, 229, 255, 0.5);
    }

    .aero-nav-link.nav-warning:hover, .aero-nav-link.nav-warning:focus {
        background: rgba(255, 179, 0, 0.1);
        border: 1px solid rgba(255, 179, 0, 0.3);
        color: var(--bs-warning) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
        transform: translateX(4px);
    }
    
    .aero-nav-link.nav-info:hover, .aero-nav-link.nav-info:focus {
        background: rgba(0, 195, 255, 0.1);
        border: 1px solid rgba(0, 195, 255, 0.3);
        color: var(--bs-info) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
        transform: translateX(4px);
    }

    /* Monospace Email Hover Blocks */
    .aero-mail-link {
        display: block;
        padding: 0.5rem;
        border-radius: 8px;
        background: var(--bs-tertiary-bg);
        border: 1px solid var(--bs-border-color);
        transition: all 0.2s ease;
    }
    .aero-mail-link:hover {
        background: var(--raggie-glass-bg);
        border-color: var(--raggie-glass-border);
        box-shadow: var(--raggie-glass-shadow);
        text-decoration: none;
    }
</style>

<div class="card bg-hud-base border-0 shadow-sm mb-4">
    <div class="card-body p-3 p-xl-4">
        <!-- Section Header: IP Portfolio -->
        <h5 class="pb-2 mb-3 border-bottom border-secondary-subtle text-uppercase h6 fw-bold ">
            <i slot="start" class="ph ph-folder-tree"></i> IP Portfolio
        </h5>
        
        <!-- Navigation Links Container -->
        <div class="d-flex flex-column gap-1">
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/licensing" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="ph ph-house fa-fw me-2 " aria-hidden="true"></i> Licensing Overview
                </button>
            
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/licensing/commercial" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="ph ph-briefcase fa-fw"></i> Commercial Sync
                </button>
            
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/licensing#cc-by-sa" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="fa-brands fa-creative-commons fa-fw"></i> Creative Commons
                </button>
            
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/projects/elara" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="fa-brands fa-github fa-fw"></i> MIT Architecture
                </button>
            
        </div>
    </div>
</div>

<div class="card border-0 bg-transparent">
    <div class="card-body p-0 p-xl-2">
        <!-- Section Header: Direct Desks Contacts -->
        <h6 class="text-uppercase fw-bold text-body-secondary mb-3 small border-bottom border-secondary-subtle pb-2">
            <i slot="start" class="ph ph-envelope"></i> Direct Desks
        </h6>
        <div class="d-flex flex-column gap-1">
            
                <a class="aero-mail-link link-secondary font-monospace text-break" href="mailto:sync@raggiesoftmedia.com">
                    <span class="d-block text-primary small fw-bold mb-1">SYNC DESK</span>
                    sync@raggiesoftmedia.com
                </a>
            
            
                <a class="aero-mail-link link-secondary font-monospace text-break" href="mailto:licensing@raggiesoftmedia.com">
                    <span class="d-block text-warning small fw-bold mb-1">RIGHTS DESK</span>
                    licensing@raggiesoftmedia.com
                </a>
            
            
                <a class="aero-mail-link link-secondary font-monospace text-break" href="mailto:ops@raggiesoftmedia.com">
                    <span class="d-block text-info small fw-bold mb-1">INFRASTRUCTURE</span>
                    ops@raggiesoftmedia.com
                </a>
            
        </div>
    </div>
</div>