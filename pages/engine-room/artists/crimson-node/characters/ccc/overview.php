<?php
/**
 * CRIMSON NODE LORE: CCC CAMPUS (OVERVIEW)
 * 
 * ARCHITECTURAL CONTEXT:
 * This file serves as the directory overview for the "Charlottesville Community College"
 * (CCC) faction within the Crimson Node lore. It aggregates the profiles of characters
 * belonging to this specific ecosystem.
 *
 * KEY FEATURES:
 * - Semantic Grid Layout: Utilizes a Bootstrap card grid (`row g-4`, `col-md-6 col-lg-4`)
 *   to cleanly present character thumbnails and summary data.
 * - Thematic Border Accents: Employs custom CSS variables (e.g., `var(--bs-purple)`) on
 *   the card's `border-top` to visually differentiate the characters or their faction.
 * - Centralized Headings: Uses `Impact` font with custom letter spacing to maintain the
 *   industrial aesthetic consistent with other Crimson Node character pages.
 *
 * MAINTENANCE NOTES:
 * - When adding new CCC characters, replicate the card structure precisely, ensuring
 *   the top border color aligns with the established visual language.
 * - The image aspect ratio is hardcoded to `1/1` on the thumbnail; ensure newly
 *   uploaded assets conform to this to prevent UI layout shifts.
 */

// pages/engine-room/artists/crimson-node/characters/ccc/overview.php
// CCC Campus Directory

$pageTitle = "CCC Campus - Crimson Node";
?>

<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold" style="font-family: 'Impact', sans-serif; letter-spacing: 2px;">
                CCC <span class="text-primary">CAMPUS</span>
            </h1>
            <p class="lead text-muted max-w-75 mx-auto mt-3">
                The Charlottesville Community College ecosystem provided a critical off-site network of safe variables, forming the early academic structure around the Crimson Node.
            </p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Heather Bouchard -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="border-top: 5px solid var(--bs-purple);">
                <a href="<?php echo $cdnBaseUrl; ?>/shiloh/images/characters/ccc/bouchard/heather-bouchard.jpg" target="_blank">
                    <img src="<?php echo $cdnBaseUrl; ?>/shiloh/images/thumbnails/ccc/bouchard/heather-bouchard-thumb.jpg" class="card-img-top rounded-0" alt="Portrait of Heather Bouchard" style="aspect-ratio: 1/1; object-fit: cover; object-position: center top;">
                </a>
                <div class="card-body">
                    <h4 class="card-title fw-bold">Heather Bouchard</h4>
                    <h6 class="card-subtitle mb-3 text-uppercase" style="color: var(--bs-purple);">The Sensory Regulation System</h6>
                    <p class="card-text text-muted">A vital grounding mechanism providing a safe, judgment-free environment. Her connection was built entirely on strict safety parameters.</p>
                    <a href="/engine-room/artists/crimson-node/characters/ccc/heather-bouchard" class="btn btn-outline-secondary btn-sm">View Profile</a>
                </div>
            </div>
        </div>

        <!-- Hailey Bouchard -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="border-top: 5px solid var(--bs-indigo);">
                <a href="<?php echo $cdnBaseUrl; ?>/shiloh/images/characters/ccc/bouchard/hailey-bouchard.jpg" target="_blank">
                    <img src="<?php echo $cdnBaseUrl; ?>/shiloh/images/thumbnails/ccc/bouchard/hailey-bouchard-thumb.jpg" class="card-img-top rounded-0" alt="Portrait of Hailey Bouchard" style="aspect-ratio: 1/1; object-fit: cover; object-position: center top;">
                </a>
                <div class="card-body">
                    <h4 class="card-title fw-bold">Hailey Bouchard</h4>
                    <h6 class="card-subtitle mb-3 text-uppercase" style="color: var(--bs-indigo);">The Creative Co-Processor</h6>
                    <p class="card-text text-muted">Heather's identical twin and the perfect UI/UX counterbalance to Matt's raw backend logic. A key member of the original CCC Quad.</p>
                    <a href="/engine-room/artists/crimson-node/characters/ccc/hailey-bouchard" class="btn btn-outline-secondary btn-sm">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
