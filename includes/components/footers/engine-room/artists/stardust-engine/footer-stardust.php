<?php
/**
 * @fileoverview Dedicated footer component for The Stardust Engine artist section.
 *
 * This file constructs the footer navigation and branding specifically for
 * The Stardust Engine context within Engine Room Records. It features unique
 * synthwave/neon styling (custom colors, glows, text shadows) that override
 * default themes to maintain the artist's aesthetic.
 *
 * Maintenance Note:
 * - When modifying links, ensure they correctly map to the `/engine-room/artists/stardust-engine/*` paths.
 * - The `$cdnBaseUrl` variable must be defined in the parent scope before this file is included.
 * - Styling overrides (e.g., `#4DB8FF`, `#E699FF`) are kept inline or in the attached `<style>` block to isolate them.
 */
// includes/components/footers/engine-room/artists/stardust-engine/footer-stardust.php
// The dedicated footer for The Stardust Engine
?>
<!-- Footer wrapper with hardcoded dark theme and custom border color for synthwave aesthetic -->
<footer class="py-5 bg-black text-white-50 border-top border-secondary" style="border-top-color: #4DB8FF !important;">
    <div class="container">
        <!-- Main row for footer grid sections -->
        <div class="row gy-5">
            
            <!-- Artist Branding and Bio Section -->
            <div class="col-lg-4 text-center text-lg-start">
                <a href="/engine-room/artists/stardust-engine" class="d-inline-block mb-3">
                    <!-- Band logo with neon drop shadow effect -->
                    <img src="<?php echo $cdnBaseUrl; ?>/engine-room-records/artists/the-stardust-engine/band-logo.png" 
                         alt="The Stardust Engine" 
                         class="img-fluid drop-shadow-neon logo-invert" 
                         style="max-height: 80px;">
                </a>
                <p class="small text-white-75 pe-lg-4" style="line-height: 1.6;">
                    Pushing the boundaries of the digital frontier. 80s Synth-Pop and Progressive Rock fueled by nostalgia, narrative, and electric color.
                </p>
            </div>

            <!-- Discography/Audio Links Section -->
            <div class="col-lg-3 col-md-4 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-3" style="color: #E699FF; letter-spacing: 1px;">Terminal / Audio</h6>
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                    <li><a href="/engine-room/artists/stardust-engine/discography/1987-electric-color" class="text-decoration-none text-white-50 hover-neon-blue">Electric Color</a></li>
                    <li><a href="/engine-room/artists/stardust-engine/discography/1989-neon-hearts" class="text-decoration-none text-white-50 hover-neon-blue">Neon Hearts</a></li>
                    <li><a href="/engine-room/artists/stardust-engine/discography/1997-hard-reset" class="text-decoration-none text-white-50 hover-neon-blue">Hard Reset</a></li>
                    <li class="mt-2 pt-2 border-top border-secondary border-">
                        <!-- Link to full catalog -->
                        <a href="/engine-room/artists/stardust-engine/discography" class="text-decoration-none text-white fw-bold hover-neon-purple">
                            View Full Catalog <i class="ph ph-arrow-right ms-1"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- External and Lore Links Section -->
            <div class="col-lg-2 col-md-4 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-3" style="color: #4DB8FF; letter-spacing: 1px;">The Network</h6>
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                    <!-- External storefront link -->
                    <li><a href="https://store.raggiesoft.com/pages/the-stardust-engine" target="_blank" rel="noopener" class="text-decoration-none text-info fw-bold hover-neon-blue"><i class="ph ph-bag-shopping me-1"></i> Official Store</a></li>
                    <li><a href="/engine-room/artists/stardust-engine/band" class="text-decoration-none text-white-50 hover-neon-blue">Band Member Roster</a></li>
                    <li><a href="/engine-room/artists/stardust-engine/band/history" class="text-decoration-none text-white-50 hover-neon-blue">History of the Band</a></li>
                    <li><a href="/engine-room/artists/stardust-engine/story" class="text-decoration-none text-white-50 hover-neon-blue">The Band's Stories</a></li>
                </ul>
            </div>

            

            <!-- Label/Management Link Section -->
            <div class="col-lg-3 col-md-4 text-center text-md-start">
                <h6 class="text-uppercase fw-bold mb-3 " style="letter-spacing: 1px;">Management</h6>
                <a href="/engine-room" class="d-inline-block mb-2">
                    <img src="<?php echo $cdnBaseUrl; ?>/engine-room-records/images/logos/engine-room-records-logo.png" 
                        alt="Engine Room Records" 
                        class="logo-invert"
                        style="height: 35px; opacity: 0.7; transition: opacity 0.3s ease;">
                </a>
                <p class="small text-white-50 mb-0 mt-2">
                    The Stardust Engine is an independent project published exclusively via Engine Room Records.
                </p>
            </div>

        </div>

        <!-- Copyright and Legal Links Row -->
        <div class="row mt-5 pt-4 border-top border-secondary border- align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <!-- Dynamic copyright year -->
                <p class="small text-white-50 mb-0 font-monospace">
                    &copy; <?php echo date('Y'); ?> RaggieSoft Media / Engine Room Records. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="/raggiesoft-media/licensing" class="text-decoration-none text-white-50 small hover-neon-purple me-3">Licensing</a>
                <a href="/about/terms" class="text-decoration-none text-white-50 small hover-neon-purple">Terms of Broadcast</a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Stardust Engine Footer Hover Effects */
    /* Neon Blue glow effect for links */
    .hover-neon-blue:hover {
        color: #4DB8FF !important;
        text-shadow: 0 0 8px rgba(77, 184, 255, 0.5);
    }
    
    /* Neon Purple glow effect for links */
    .hover-neon-purple:hover {
        color: #E699FF !important;
        text-shadow: 0 0 8px rgba(230, 153, 255, 0.5);
    }
    
    /* Image drop shadow utilizing neon blue color */
    .drop-shadow-neon {
        filter: drop-shadow(0 0 10px rgba(77, 184, 255, 0.3));
    }
</style>