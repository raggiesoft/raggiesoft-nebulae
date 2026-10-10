<?php
/**
 * ARCHITECTURE: Dynamic Book Navigation Sidebar
 * 
 * DESCRIPTION:
 * This component generates a dynamic accordion-style sidebar for traversing hierarchical book content.
 * It reads from a JSON source (via `getBookNavigation`) and builds a nested structure of Books > Chapters > Parts > Scenes.
 *
 * STRUCTURE:
 * - Data Retrieval: Uses `nav-logic.php` to fetch and parse JSON data defined by `$bookJsonUrl`.
 * - Title Block: Displays the overarching book/series title.
 * - Accordion (`#bookAccordion`): Iterates through the parsed `structure`.
 *   - Book Headings: Static group headers for sub-books.
 *   - Chapters: Bootstrap Accordion items. Automatically expanded if they contain the active path.
 *   - Parts & Scenes: Nested lists within chapter bodies. 
 *     - If a part has multiple scenes, the part becomes a subheading and scenes are listed.
 *     - If a part has only one scene, the part itself acts as the clickable link.
 *
 * USAGE:
 * - Define `$bookJsonUrl` before including this file to specify the data source.
 * - Variables like `$currentBookId`, `$currentChapId`, `$currentPartId`, and `$currentSceneId` 
 *   are extracted from the logic utility and used to determine active (`bg-primary text-white`) and expanded states.
 *
 * MAINTENANCE NOTES:
 * - Requires `utils/nav-logic.php`. Ensure paths are correct relative to inclusion contexts.
 * - HTML structure uses Bootstrap 5 Accordion components. Changing classes may break expand/collapse behavior.
 * - The logic distinguishing multi-scene vs single-scene parts is critical for UI simplification and should be preserved.
 */

require_once __DIR__ . '/../../utils/nav-logic.php'; 

$sourceUrl = $bookJsonUrl ?? ''; 
$navData = getBookNavigation($sourceUrl);
extract($navData);
?>

<!-- Section: Main Sidebar Container -->
<div class="pt-3">
    <!-- Component Title Block -->
    <?php if (!empty($bookData['title'])): ?>
    <h5 class="mb-3 pb-2 border-bottom border-secondary text-uppercase" style="font-family: 'Cinzel', serif;">
        <?php echo $bookData['title']; ?>
    </h5>
    <?php endif; ?>

    <!-- Section: Book Accordion -->
    <div class="accordion accordion-flush" id="bookAccordion">
        
        <?php if (!empty($bookData['structure'])): ?>
            <?php foreach ($bookData['structure'] as $book): ?>
                
                <div class="mb-4">
                    <!-- Book Header -->
                    <h6 class="text-primary fw-bold mb-2 ps-2 border-start border-3 border-primary bg-light py-1">
                        <?php echo $book['title']; ?>
                    </h6>
                    
                    <?php if (!empty($book['chapters'])): ?>
                        <?php foreach ($book['chapters'] as $chapter): 
                            // Determine Active State: Expand accordion if current chapter and book match
                            $isChapterActive = ($chapter['id'] === $currentChapId && $book['id'] === $currentBookId);
                        ?>
                            <!-- Chapter Accordion Item -->
                            <div class="accordion-item bg-transparent border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $isChapterActive ? '' : 'collapsed'; ?> bg-transparent shadow-none py-2 px-2" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse-<?php echo $book['id'] . '-' . $chapter['id']; ?>" 
                                            aria-expanded="<?php echo $isChapterActive ? 'true' : 'false'; ?>">
                                        <span class="small fw-bold text-uppercase" style="letter-spacing: 0.5px; color: var(--bs-body-color);">
                                            <!-- Logic: Strip 'Chapter ' prefix for cleaner UI -->
                                            <?php echo str_replace("Chapter ", "", $chapter['title']); ?>
                                        </span>
                                    </button>
                                </h2>
                                
                                <div id="collapse-<?php echo $book['id'] . '-' . $chapter['id']; ?>" 
                                     class="accordion-collapse collapse <?php echo $isChapterActive ? 'show' : ''; ?>" 
                                     data-bs-parent="#bookAccordion">
                                    <div class="accordion-body p-0 ps-3 pt-1">
                                        <!-- Parts & Scenes List -->
                                        <ul class="list-unstyled border-start border-secondary border- ps-2">
                                            
                                            <?php if (!empty($chapter['parts'])): ?>
                                                <?php foreach ($chapter['parts'] as $part): ?>
                                                    
                                                    <!-- UI Logic: Multi-scene Part vs Single-scene Part -->
                                                    <?php if (count($part['scenes']) > 1): ?>
                                                        <!-- Render as Subheading with Nested Scene Links -->
                                                        <li class="mb-2 mt-2">
                                                            <div class=" small fw-bold text-uppercase ps-2 mb-1" style="font-size: 0.75rem;">
                                                                <?php echo $part['title']; ?>
                                                            </div>
                                                            <ul class="list-unstyled ps-3 border-start border-secondary border-opacity-10">
                                                                <?php foreach ($part['scenes'] as $scene): 
                                                                    // Highlight if current scene
                                                                    $isSceneActive = ($scene['id'] === $currentSceneId && $part['id'] === $currentPartId);
                                                                    $sceneUrl = "{$bookData['base_path']}/{$book['id']}/{$chapter['id']}/{$part['id']}/{$scene['id']}";
                                                                ?>
                                                                    <li class="mb-1">
                                                                        <a href="<?php echo $sceneUrl; ?>" 
                                                                           class="text-decoration-none d-block py-1 px-2 rounded-1 <?php echo $isSceneActive ? 'bg-primary text-white' : 'text-body-secondary hover-bg-light'; ?>"
                                                                           style="font-size: 0.85rem;">
                                                                            <?php echo $scene['title']; ?>
                                                                        </a>
                                                                    
                                                                <?php endforeach; ?>
                                                            </div>
                                                        

                                                    <?php else: ?>
                                                        <!-- Render Single Scene directly as the Part Link -->
                                                        <?php 
                                                            $scene = $part['scenes'][0];
                                                            $isSceneActive = ($scene['id'] === $currentSceneId && $part['id'] === $currentPartId);
                                                            $sceneUrl = "{$bookData['base_path']}/{$book['id']}/{$chapter['id']}/{$part['id']}/{$scene['id']}";
                                                        ?>
                                                        <li class="mb-1">
                                                            <a href="<?php echo $sceneUrl; ?>" 
                                                               class="text-decoration-none d-block py-1 px-2 rounded-1 <?php echo $isSceneActive ? 'bg-primary text-white' : 'text-body-secondary hover-bg-light'; ?>"
                                                               style="font-size: 0.9rem;">
                                                                <?php echo $part['title']; ?>
                                                            </a>
                                                        
                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>