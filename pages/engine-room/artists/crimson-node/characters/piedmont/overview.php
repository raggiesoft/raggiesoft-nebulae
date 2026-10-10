<?php
/**
 * ============================================================================
 * ARCHITECTURE & ENGINEERING BLOCK
 * Component: Crimson Node - The University of the Piedmont Directory
 * 
 * 1. COMPONENT PURPOSE:
 *    - Renders the character index/directory for the "University of the Piedmont" faction in the Crimson Node lore.
 * 
 * 2. DESIGN & STYLING:
 *    - Simple Bootstrap grid layout for character cards.
 *    - Heavily leverages the institution's theme color (Orange: `#ff7900`) for headers, borders, and subtitle highlights.
 *    - Custom font (`Impact`) for the main title to simulate collegiate branding.
 * 
 * 3. TECHNICAL & INTEGRATION NOTES:
 *    - Images are pulled dynamically using the `$cdnBaseUrl`.
 * 
 * 4. FUTURE MAINTENANCE:
 *    - Append new characters as standard Bootstrap column (`.col-md-6 .col-lg-4`) blocks within the `.row.g-4` container.
 *    - Maintain the inline `#ff7900` styling for thematic consistency, unless a global CSS class is implemented later.
 * ============================================================================
 */
// pages/engine-room/artists/crimson-node/characters/piedmont/overview.php
// The University of the Piedmont Directory

$pageTitle = "The University of the Piedmont - Crimson Node";
?>

<!-- Main Directory Container -->
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold" style="font-family: 'Impact', sans-serif; letter-spacing: 2px;">
                THE <span style="color: #ff7900;">UNIVERSITY OF THE PIEDMONT</span>
            </h1>
            <p class="lead text-muted max-w-75 mx-auto mt-3">
                A prestigious, historic institution in Charlottesville defined by extreme wealth, intense elitism, and deep-seated "Rahoo" lacrosse culture. The ultimate test of the Crimson Node's clinical durability.
            </p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Trent Montgomery -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm" style="border-top: 5px solid #ff7900;">
                <a href="<?php echo $cdnBaseUrl; ?>/shiloh/images/characters/piedmont/trent-montgomery.jpg" target="_blank">
                    <img src="<?php echo $cdnBaseUrl; ?>/shiloh/images/thumbnails/piedmont/trent-montgomery-thumb.jpg" class="card-img-top rounded-0" alt="Portrait of Trent Montgomery" style="aspect-ratio: 1/1; object-fit: cover; object-position: center top;">
                </a>
                <div class="card-body">
                    <h4 class="card-title fw-bold">Trent Montgomery</h4>
                    <h6 class="card-subtitle mb-3 text-uppercase fw-bold" style="color: #ff7900;">The Lacrosse Bro</h6>
                    <p class="card-text text-muted">A hyper-insecure lacrosse player desperate for status at The University of the Piedmont. His false dominance met its end at the hands of the Brooks sisters.</p>
                    <a href="/engine-room/artists/crimson-node/characters/piedmont/trent-montgomery" class="btn btn-outline-secondary btn-sm">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
