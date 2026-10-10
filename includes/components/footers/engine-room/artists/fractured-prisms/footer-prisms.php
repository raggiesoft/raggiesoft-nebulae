<?php
/**
 * @fileoverview Dedicated footer component for the Fractured Prisms artist section.
 *
 * This file constructs the footer navigation and branding specifically for the
 * Fractured Prisms context within Engine Room Records. It utilizes Bootstrap 5 grid
 * classes and custom CSS variables for theme-aware styling.
 *
 * Maintenance Note:
 * - When modifying links, ensure they correctly map to the `/engine-room/artists/fractured-prisms/*` paths.
 * - The `$cdnBaseUrl` variable must be defined in the parent scope before this file is included.
 * - Theme-specific behaviors (light/dark mode) are handled via CSS mix-blend-mode and filters.
 */
// includes/components/footers/engine-room/artists/fractured-prisms/footer-prisms.php
// The dedicated footer for Fractured Prisms
?>
<!-- Footer wrapper with dynamic theme background styling -->
<footer class="py-5 border-top border-prism" style="background-color: var(--bs-bg-prism); transition: all var(--transition-speed) ease-in-out;">
    <div class="container">
        <!-- Main row for footer grid sections -->
        <div class="row gy-5">
            
            <!-- Artist Branding and Bio Section -->
            <div class="col-lg-4 text-center text-lg-start">
                <a href="/engine-room/artists/fractured-prisms" class="d-inline-block mb-3">
                    <!-- Band logo using CDN base URL injected from parent scope -->
                    <img src="<?php echo $cdnBaseUrl; ?>/engine-room-records/artists/fractured-prisms/band-logo.jpg" 
                         alt="Fractured Prisms" 
                         class="img-fluid prism-footer-logo" 
                         style="max-height: 80px;">
                </a>
                <p class="small pe-lg-4" style="line-height: 1.6; color: var(--bs-body-color); font-family: var(--font-tech);">
                    Architects of the modern rock landscape. Progressive concepts and atmospheric pop born from the isolation of the Maryland sanctuary.
                </p>
            </div>

            <!-- Discography Links Section -->
            <div class="col-lg-3 col-md-4 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-3 gothic-font" style="color: var(--bs-primary); letter-spacing: 1px;">The Archives</h6>
                <!-- List of primary releases -->
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2" style="font-family: var(--font-tech);">
                    <li><a href="/engine-room/artists/fractured-prisms/discography/1983-carnaby-street" class="text-decoration-none prism-footer-link">Carnaby Street (1983)</a></li>
                    <li><a href="/engine-room/artists/fractured-prisms/discography/1984-1883" class="text-decoration-none prism-footer-link">1883 (The Rock Opera)</a></li>
                    <li class="mt-2 pt-2 border-top border-prism border-">
                        <!-- Link to full catalog -->
                        <a href="/engine-room/artists/fractured-prisms/discography" class="text-decoration-none fw-bold prism-footer-link-active">
                            View Full Catalog <i class="ph ph-arrow-right ms-1"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- World-Building/Lore Links Section -->
            <div class="col-lg-2 col-md-4 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-3 gothic-font" style="color: var(--bs-primary); letter-spacing: 1px;">The Sanctuary</h6>
                <!-- List of lore and context pages -->
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2" style="font-family: var(--font-tech);">
                    <li><a href="/engine-room/artists/fractured-prisms/square" class="text-decoration-none prism-footer-link">The Square</a></li>
                    <li><a href="/engine-room/artists/fractured-prisms/lore" class="text-decoration-none prism-footer-link">Lore Archives</a></li>
                    <li><a href="/engine-room/artists/fractured-prisms/residents" class="text-decoration-none prism-footer-link">The Residents</a></li>
                </ul>
            </div>

            <!-- Label/Management Link Section -->
            <div class="col-lg-3 col-md-4 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-3 gothic-font" style="color: var(--bs-secondary); letter-spacing: 1px;">Management</h6>
                <!-- Engine Room Records logo -->
                <a href="/engine-room" class="d-inline-block mb-2">
                    <img src="<?php echo $cdnBaseUrl; ?>/engine-room-records/images/logos/engine-room-records-logo.png" 
                        alt="Engine Room Records" 
                        class="engine-room-logo"
                        style="height: 35px; opacity: 0.7; transition: opacity var(--transition-speed) ease, filter var(--transition-speed) ease;">
                </a>
                <p class="small mb-0 mt-2" style="color: var(--bs-secondary); font-family: var(--font-tech);">
                    Fractured Prisms is an independent project published exclusively via Engine Room Records.
                </p>
            </div>

        </div>
    </div>
</footer>

<style>
    /* Fractured Prisms Footer Specifics */
    /* Hover effects for primary footer links */
    .prism-footer-link {
        color: var(--bs-secondary);
        transition: color var(--transition-speed) ease;
    }
    .prism-footer-link:hover {
        color: var(--bs-primary);
        text-decoration: underline !important;
    }
    
    /* Hover effects for active/highlighted links */
    .prism-footer-link-active {
        color: var(--bs-body-color);
        transition: color var(--transition-speed) ease;
    }
    .prism-footer-link-active:hover {
        color: var(--bs-primary);
    }
    
    /* Auto-inverts the Engine Room Records logo based on theme to maintain contrast */
    [data-bs-theme="dark"] .engine-room-logo {
        filter: invert(1) grayscale(100%) brightness(100%);
    }
    [data-bs-theme="light"] .engine-room-logo {
        filter: invert(0) grayscale(100%) brightness(20%);
    }
    
    /* Blend the band logo depending on mode for a seamless integration with background */
    [data-bs-theme="dark"] .prism-footer-logo {
        mix-blend-mode: screen;
    }
    [data-bs-theme="light"] .prism-footer-logo {
        mix-blend-mode: multiply;
    }
</style>