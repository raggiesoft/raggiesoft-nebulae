<?php
/**
 * ============================================================================
 * RAGGIESOFT NEBULAE - AETHEL SAGA TABLE OF CONTENTS
 * ============================================================================
 * 
 * ARCHITECTURE & PURPOSE:
 * This page acts as the dynamic Table of Contents (TOC) for the "Aethel Saga". 
 * It reads from the structured book data (loaded via `nav-logic.php`) and renders 
 * the Book -> Part -> Chapter hierarchy. 
 * 
 * STRUCTURAL PATTERNS:
 * - Employs nested `foreach` loops to parse the multi-level JSON array 
 *   (`$bookData['structure']`).
 * - Uses Bootstrap cards to visually separate "Parts" (e.g., Acts) and lists 
 *   chapters cleanly within `list-group`.
 * - Relies on CSS variables (e.g., `--aethel-rust`, `--aethel-ink`) defined globally 
 *   or within the `.aethel-theme` wrapper to enforce the parchment/fantasy aesthetic.
 * 
 * MAINTENANCE NOTES:
 * - The `$url` for chapters is constructed dynamically. Ensure Elara's routing 
 *   rules in `index.php` properly map `/library/aethel/aethel-book/{bookId}/{partId}/{chapterId}` 
 *   to the `viewer.php` script.
 * - If the JSON structure in `nav-logic.php` changes, these nested loops MUST be 
 *   updated to prevent fatal errors.
 * 
 * @package RaggieSoft_Nebulae
 * @subpackage Aethel_Saga
 * ============================================================================
 */

// Context: Book Index / Table of Contents
$currentSite = 'aethel';
$pageTitle = "Table of Contents - The Silver Gauntlet";

// Load the book data (reusing the logic we built for the sidebar)
require_once ROOT_PATH . '/includes/utils/nav-logic.php';
?>

<div class="aethel-theme min-vh-100 py-5">
    <div class="container tome-container">
        
        <!-- 
          STRUCTURAL BLOCK: Header & Cover Art
          Displays the primary book cover and title. The slight rotation (-2deg) 
          on the image gives it a physical, tangible book feel.
        -->
        <div class="text-center mb-5">
            <img src="<?php echo $cdnBaseUrl; ?>/engine-room-records/artists/silver-gauntlet-of-aethel/2017-the-aethel-saga/album-art.jpg" 
                 alt="Cover Art" 
                 class="img-fluid border border-warning shadow-sm mb-4" 
                 style="max-width: 200px; transform: rotate(-2deg);">

            <h1 class="display-4" style="font-family: 'Cinzel', serif;">The Silver Gauntlet of Aethel</h1>
            <p class="lead text-muted fst-italic">The 30th Anniversary "Aethel Saga"</p>
            <div class="d-inline-block border-bottom border-warning w-25 my-3"></div>
        </div>

        <?php if (empty($bookData['structure'])): ?>
            <div class="alert alert-danger text-center">
                <i class="ph ph-book-dead me-2"></i>
                The archives appear to be empty. (Unable to load Book Data)
            </div>
        <?php else: ?>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <!-- 
                      STRUCTURAL BLOCK: Dynamic Hierarchy Loop
                      Iterates through Books, then Parts, then Chapters.
                      Uses Bootstrap cards to compartmentalize Parts.
                    -->
                    <?php foreach ($bookData['structure'] as $book): ?>
                        <div class="mb-5">
                            
                            <div class="text-center mb-4">
                                <h2 class="text-primary d-inline-block px-4 py-2 border-top border-bottom border-primary border-opacity-25" 
                                    style="font-family: 'Cinzel', serif; border-bottom: none;">
                                    <?php echo $book['title']; ?>
                                </h2>
                            </div>

                            <?php foreach ($book['parts'] as $part): ?>
                                <div class="card bg-transparent border-secondary mb-4 shadow-sm" style="border-color: rgba(139, 69, 19, 0.3) !important;">
                                    
                                    <div class="card-header bg-transparent border-secondary border-opacity-25 text-center py-3" 
                                         style="background-color: rgba(139, 69, 19, 0.05);">
                                        <h3 class="h5 m-0 text-uppercase fw-bold" style="color: var(--aethel-rust); letter-spacing: 1px;">
                                            <?php echo $part['title']; ?>
                                        </h3>
                                    </div>
                                    
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush">
                                            <?php foreach ($part['chapters'] as $chapter): 
                                                // Construct URL: /library/aethel/aethel-book/{bookId}/{partId}/{chapterId}
                                                $url = "/library/aethel/aethel-book/{$book['id']}/{$part['id']}/{$chapter['id']}";
                                            ?>
                                                <a href="<?php echo $url; ?>" 
                                                   class="list-group-item list-group-item-action bg-transparent border-secondary border-opacity-25 d-flex justify-content-between align-items-center py-3 px-4">
                                                    <span class="fs-5" style="font-family: 'Crimson Text', serif; color: var(--aethel-ink);">
                                                        <?php echo $chapter['title']; ?>
                                                    </span>
                                                    
                                                    <i class="ph ph-feather-pointed text-warning opacity-50"></i>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        <?php endif; ?>

        <!-- 
          STRUCTURAL BLOCK: Footer Navigation
          Provides escape hatches back to the main landing page and lore wikis.
        -->
        <div class="text-center mt-5 pt-4 border-top border-secondary border-opacity-25">
            <a href="/raggiesoft-books/aethel-saga" class="btn btn-outline-secondary">
                <i class="ph ph-arrow-left me-2"></i>Return to Aethel Home
            </a>
            <a href="/raggiesoft-books/aethel-saga/lore/characters" class="btn btn-outline-info ms-2">
                <i class="ph ph-users-crown me-2"></i>Characters
            </a>
            <a href="/raggiesoft-books/aethel-saga/lore/locations" class="btn btn-outline-success ms-2">
                <i class="ph ph-map-location-dot me-2"></i>Locations
            </a>
        </div>

    </div>
</div>