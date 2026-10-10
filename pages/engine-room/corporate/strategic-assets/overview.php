<?php
/**
 * ============================================================================
 * ARCHITECTURE & ENGINEERING BLOCK
 * Entity: Stardust Strategic Assets, LLC
 * Theme: "Stealth" (Grey/Black/Industrial)
 * 
 * 1. COMPONENT PURPOSE:
 *    - Renders the overview landing page for the "Stardust Strategic Assets" division.
 *    - Acts as the primary navigational hub for private corporate holdings (e.g., The Fortress, Stardust Studios).
 * 
 * 2. DESIGN & STYLING:
 *    - Utilizes a "Stealth" aesthetic with dark gradients and Bootstrap secondary/tertiary colors to emphasize privacy and security.
 *    - Enforces physical boundary representation between public and private operations.
 *    - Interactive elements (cards) include hover animations respecting `prefers-reduced-motion` settings for accessibility.
 * 
 * 3. TECHNICAL & INTEGRATION NOTES:
 *    - Relies on global asset inclusion (e.g., `$cdnBaseUrl`) for external imagery (hero section).
 *    - Icons utilize Phosphor Icons (`ph-*`).
 *    - Font stack relies heavily on Bootstrap's utility classes (e.g., `font-monospace` for data/telemetry aesthetic).
 * 
 * 4. FUTURE MAINTENANCE:
 *    - Any new strategic/private assets added to the portfolio should be appended as new `.col-md-6` or `.col-md-4` blocks within the `.row.g-4` container.
 *    - To maintain thematic consistency, avoid using bright primary/accent colors outside of specific highlight needs (e.g., warning border for Stardust Studios).
 * ============================================================================
 */
// pages/engine-room/corporate/strategic-assets/overview.php
// Entity: Stardust Strategic Assets, LLC
// Context: The holding company for the "Private" assets.
// Theme: "Stealth" (Grey/Black/Industrial).

$pageTitle = "Stardust Strategic Assets - Corporate Infrastructure";
?>

<style>
    /* STEALTH THEME */
    /* Hero section utilizes dark overlays over secure imagery to reinforce the private/internal nature of the entity */
    .hero-section {
        background: linear-gradient(rgba(33, 37, 41, 0.95), rgba(33, 37, 41, 0.98)), 
                    url($cdnBaseUrl . '/stardust-engine/images/corporate/secure-server-room.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 6rem 0;
        border-bottom: 4px solid var(--bs-secondary);
    }

    .asset-card {
        background-color: var(--bs-body-tertiary);
        border: 1px solid var(--bs-border-color);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    @media (prefers-reduced-motion: no-preference) {
        .asset-card:hover {
            transform: translateY(-5px);
            border-color: var(--bs-primary);
        }
    }
</style>

<div class="hero-section text-center">
    <div class="container">
        <div class="mb-3">
            <i class="ph ph-chess-rook fa-4x text-secondary"></i>
        </div>
        <h1 class="display-4 fw-bold text-uppercase letter-spacing-1 mb-2">Stardust Strategic Assets, LLC</h1>
        <p class="lead text-white-50 mx-auto font-monospace" style="max-width: 800px;">
            <i class="ph ph-shield-check me-2"></i>Operational Infrastructure & Private Holdings
        </p>
    </div>
</div>

<div class="container py-5">
    
    <!-- Profile Section: Contextual explanation of the holding company -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9 text-center">
            <h2 class="h5 text-uppercase text-body-secondary fw-bold mb-3">Entity Profile</h2>
            <p class="fs-5 text-body-emphasis">
                This entity creates the physical boundary between the public and the private. 
                It holds the titles to the operational headquarters, the private residence, and the logistical fleet of the O'Connell Trust.
            </p>
            <p class="small text-muted font-monospace mt-3">
                NOT OPEN TO THE PUBLIC. SOLICITATIONS REJECTED.
            </p>
        </div>
    </div>

    <!-- Asset Cards Container -->
    <div class="row g-4 mb-5">
        
        <!-- Asset: The Fortress (Residential) -->
        <div class="col-md-6">
            <a href="/engine-room/corporate/strategic-assets/the-fortress" class="text-decoration-none">
                <div class="card h-100 asset-card shadow-sm border-start-0 border-end-0 border-top-0 border-bottom-4 border-secondary">
                    <div class="card-body p-5 text-center">
                        <i class="ph ph-house-chimney fa-3x text-body-emphasis mb-3"></i>
                        <h3 class="h4 fw-bold text-uppercase text-body-emphasis">The Fortress</h3>
                        <p class="text-body-secondary font-monospace small mb-0">ID: PCC-01 (Residential)</p>
                        <hr class="my-3 opacity-25">
                        <p class="card-text text-body-secondary">
                            512 Progress St NE. The private residence and historical point of origin. Maintained as a secure sanctuary.
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="/engine-room/corporate/strategic-assets/stardust-studios" class="text-decoration-none">
                <div class="card h-100 asset-card shadow-sm border-start-0 border-end-0 border-top-0 border-bottom-4 border-warning">
                    <div class="card-body p-5 text-center">
                        <i class="ph ph-warehouse fa-3x text-warning mb-3"></i>
                        <h3 class="h4 fw-bold text-uppercase text-body-emphasis">Stardust Studios</h3>
                        <p class="text-body-secondary font-monospace small mb-0">ID: HQ-01 (Commercial)</p>
                        <hr class="my-3 opacity-25">
                        <p class="card-text text-body-secondary">
                            Falling Branch Industrial Park. The Global Headquarters, Production Facility, and Secure Archives.
                        </p>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="alert bg-body-tertiary border border-secondary border-opacity-25 p-4 rounded-0 shadow-sm">
        <div class="d-flex align-items-center">
            <i class="ph ph-lock text-secondary fs-3 me-3 opacity-50"></i>
            <div>
                <h6 class="fw-bold text-uppercase text-secondary small mb-1">Corporate Governance</h6>
                <p class="small text-body-secondary mb-0 font-monospace">
                    <strong>Stardust Strategic Assets, LLC</strong> is a wholly-owned subsidiary of Stardust Properties, LLC. 
                    Assets held by this entity are not available for lease or public use.
                </p>
            </div>
        </div>
    </div>

</div>