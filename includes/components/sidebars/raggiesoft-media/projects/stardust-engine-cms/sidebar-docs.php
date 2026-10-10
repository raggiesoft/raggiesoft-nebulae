<?php
/**
 * @fileoverview Sidebar navigation for the Stardust Engine CMS documentation.
 *
 * This file provides the side navigation used throughout the documentation section 
 * for the Stardust Engine CMS project. It includes specific styling for Frutiger Aero
 * inspired navigation items and provides links to internal docs and external repositories.
 *
 * Maintenance Note:
 * - When adding new documentation pages, add a new `<button>` or `<a>` tag matching the existing structure.
 * - Ensure `data-bs-theme` overrides are maintained if styling is changed, to support light/dark modes.
 * - Note that `<button>` tags with `href` attributes are tied to the UI framework or custom JS routing (like Elara).
 */
// includes/components/sidebars/raggiesoft-media/projects/stardust-engine-cms/sidebar-docs.php
// Documentation navigation for the Stardust Engine CMS.
// Updated: Frutiger Aero Glass Navigation
?>

<style>
    /* Aero Glass Navigation Tabs (Reused & customized for Docs) */
    .aero-nav-link {
        border-radius: 50rem;
        padding: 0.5rem 1rem;
        margin-bottom: 0.25rem;
        transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: 1px solid transparent;
        font-weight: 500;
    }

    /* Primary hover state for standard navigation items */
    .aero-nav-link.nav-primary:hover, .aero-nav-link.nav-primary.active {
        background: rgba(0, 130, 230, 0.1);
        border: 1px solid rgba(0, 130, 230, 0.3);
        color: var(--bs-primary) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
        transform: translateX(4px);
    }
    
    /* Dark mode overrides for primary hover state to ensure contrast and neon feel */
    [data-bs-theme="dark"] .aero-nav-link.nav-primary:hover,
    [data-bs-theme="dark"] .aero-nav-link.nav-primary.active {
        background: rgba(0, 229, 255, 0.15);
        border-color: rgba(0, 229, 255, 0.4);
        color: var(--mpr-cyan-400) !important;
        text-shadow: 0 0 8px rgba(0, 229, 255, 0.5);
    }

    /* Cyan Highlight specifically for Elara documentation links */
    .aero-nav-link.nav-info:hover, .aero-nav-link.nav-info.active {
        background: rgba(0, 195, 255, 0.1);
        border: 1px solid rgba(0, 195, 255, 0.3);
        color: var(--bs-info) !important;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
        transform: translateX(4px);
    }

    /* Outer Glass Blocks styling for External Links (GitHub, etc.) */
    .aero-external-link {
        display: block;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        background: rgba(0,0,0,0.02);
        border: 1px solid var(--raggie-glass-border);
        transition: all 0.2s ease;
    }
    [data-bs-theme="dark"] .aero-external-link {
        background: rgba(255,255,255,0.02);
    }
    .aero-external-link:hover {
        background: var(--raggie-glass-bg);
        border-color: var(--bs-primary);
        box-shadow: var(--raggie-glass-shadow);
        text-decoration: none;
        transform: translateY(-2px);
    }
</style>

<!-- Internal Documentation Navigation Section -->
<div class="card bg-hud-base border-0 shadow-sm mb-4">
    <div class="card-body p-3 p-xl-4">
        <h5 class="pb-2 mb-3 border-bottom border-secondary-subtle text-uppercase h6 fw-bold ">
            <i slot="start" class="ph ph-book-open"></i> Documentation
        </h5>
        <div class="d-flex flex-column gap-1">
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/projects/stardust-engine-cms" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="ph ph-rocket-launch fa-fw me-2 text-primary" aria-hidden="true"></i> Overview
                </button>
            
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/projects/stardust-engine-cms/elara" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="fa-brands fa-js fa-fw"></i> Elara SPA Router
                </button>
            
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/projects/stardust-engine-cms/configuration" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="ph ph-brackets-curly fa-fw"></i> JSON Routing
                </button>
            
            
                <button class="rs-btn" appearance="plain" href="/raggiesoft-media/projects/stardust-engine-cms/deployment" class="text-body w-100 text-start justify-content-start" style="text-align: left;">
                    <i slot="start" class="ph ph-terminal fa-fw"></i> Deploy: Jenna & Sarah
                </button>
            
        </div>
    </div>
</div>

<!-- External Repository Links Section -->
<div class="card border-0 bg-transparent">
    <div class="card-body p-0 p-xl-2">
        <h6 class="text-uppercase fw-bold text-body-secondary mb-3 small border-bottom border-secondary-subtle pb-2">
            <i slot="start" class="fa-brands fa-github"></i> Repository Links
        </h6>
        <div class="d-flex flex-column gap-1">
            
                <a class="aero-external-link link-secondary fw-bold" href="https://github.com/raggiesoft/stardust-engine-cms" target="_blank" rel="noopener noreferrer">
                    <span class="d-flex align-items-center justify-content-between">
                        <span><i slot="start" class="ph ph-code-branch me-2 " aria-hidden="true"></i> Source Code</span>
                        <i class="ph ph-arrow-up-right-from-square small " aria-hidden="true"></i>
                    </span>
                </a>
            
            
                <a class="aero-external-link link-secondary fw-bold" href="https://github.com/raggiesoft/stardust-engine-cms/issues" target="_blank" rel="noopener noreferrer">
                    <span class="d-flex align-items-center justify-content-between">
                        <span><i slot="start" class="ph ph-bug"></i> Report an Issue</span>
                        <i slot="start" class="ph ph-arrow-up-right-from-square small " aria-hidden="true"></i> </span>
                </a>
            
        </div>
    </div>
</div>