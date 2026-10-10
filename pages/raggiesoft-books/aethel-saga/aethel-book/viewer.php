<?php
/**
 * ============================================================================
 * RAGGIESOFT NEBULAE - AETHEL SAGA SCENE VIEWER
 * ============================================================================
 * 
 * ARCHITECTURE & PURPOSE:
 * This is the core reading interface for the Aethel Saga novels. It dynamically 
 * fetches raw Markdown content from the CDN based on the current URL route and 
 * parses it into styled HTML. It also handles chapter/scene pagination.
 * 
 * STRUCTURAL PATTERNS:
 * - Uses `$pageConfig['currentContext']` provided by `index.php` to determine 
 *   the exact book, chapter, part, and scene IDs.
 * - Implements a lightweight, custom `parseMarkdown()` function rather than 
 *   relying on heavy external libraries, keeping the reader extremely fast.
 * - Injects a script to trigger the mobile Table of Contents drawer (`<wa-drawer>`).
 * - Supports dynamic theming (e.g., `.chapter-gloom` vs `.aethel-theme`) based 
 *   on the scene's emotional context or setting.
 * 
 * MAINTENANCE NOTES:
 * - The `$mdUrl` structure is strictly `/content/{book}/{chapter}/{part}/{scene}.md`.
 *   If the underlying CDN folder structure changes, this must be updated.
 * - The regex in `cleanSlug()` is hardcoded to remove `chapter-\d+-` prefixes. 
 *   If naming conventions change, this parser will break.
 * - Do NOT remove the `e.stopPropagation()` in the JS block, or the Web Components 
 *   drawer will fail to open on mobile devices.
 * 
 * @package RaggieSoft_Nebulae
 * @subpackage Aethel_Saga
 * ============================================================================
 */

// 1. Determine Context from Router Config
// $pageConfig['currentContext'] is passed from index.php
$bookId = $pageConfig['currentContext'][0] ?? '';
$chapId = $pageConfig['currentContext'][1] ?? '';
$partId = $pageConfig['currentContext'][2] ?? '';
$sceneId = $pageConfig['currentContext'][3] ?? '';

// 2. Locate the Asset
// URL: .../content/{book}/{chapter}/{part}/{scene}.md
$mdUrl = $cdnBaseUrl . "/aethel/content/{$bookId}/{$chapId}/{$partId}/{$sceneId}.md";
$rawMarkdown = @file_get_contents($mdUrl);

if ($rawMarkdown === false) {
    echo "<div class='container py-5'><div class='alert alert-danger'>Error: The scroll for this scene is missing.<br><small class='text-muted'>$mdUrl</small></div></div>";
    return;
}

// 3. Simple Markdown Parser
/* 
 * ARCHITECTURE NOTE: Custom Markdown Parser
 * Strips top-level headers (handled by the PHP header block) and converts 
 * Markdown styling (bold, italic) into HTML tags. Explodes on double-newlines 
 * to create traditional `<p>` paragraphs.
 */
function parseMarkdown($text) {
    // Remove H1 headers (we handle title in PHP)
    $text = preg_replace('/^# (.*)$/m', '', $text); 
    // Remove H2 headers (often used for Scene Titles in docx)
    $text = preg_replace('/^## (.*)$/m', '<h3>$1</h3>', $text);

    // Styling
    $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
    
    // Paragraphs
    $paragraphs = explode("\n\n", $text);
    $html = "";
    foreach ($paragraphs as $p) {
        $p = trim($p);
        if (!empty($p)) {
            $html .= "<p>{$p}</p>\n";
        }
    }
    return $html;
}

$contentHtml = parseMarkdown($rawMarkdown);

// Helper to clean up slugs for display (e.g. "part-1-the-scholar" -> "The Scholar")
function cleanSlug($slug, $prefixToRemove) {
    // Removes "part-1-" from start
    $clean = preg_replace('/^' . $prefixToRemove . '-\d+-/', '', $slug);
    // Replace remaining dashes with spaces
    return ucwords(str_replace('-', ' ', $clean));
}
?>

<!-- 
  STRUCTURAL BLOCK: Reader Container
  Applies the dynamic theme based on the scene context. Uses Bootstrap utilities 
  to ensure the reading pane spans the full viewport height (`min-vh-100`).
-->
<div class="<?php echo ($currentPageTheme === 'gloom') ? 'chapter-gloom' : 'aethel-theme'; ?> py-5 min-vh-100">
    <div class="container tome-container">
        
        <div class="text-center mb-5 pb-3 border-bottom border-secondary">
            <p class="h6 text-uppercase text-muted mb-1" style="letter-spacing: 2px;">
                <?php echo cleanSlug($chapId, 'chapter'); ?>
            </p>
            <p class="h5 text-uppercase text-warning" style="letter-spacing: 2px; font-family: 'Cinzel', serif;">
                <?php echo cleanSlug($partId, 'part'); ?>
            </p>
            
            <h1 class="display-4 mt-3" style="font-family: 'Cinzel', serif;">
                <?php echo $pageTitle; // Set by Router from JSON ?>
            </h1>
        </div>

        <div class="chapter-content fs-5" style="line-height: 1.8;">
            <?php echo $contentHtml; ?>
        </div>

        <!-- 
          STRUCTURAL BLOCK: Pagination Navigation
          Retrieves the adjacent scenes from `nav-logic.php` and renders 
          Prev/Up/Next buttons to guide the reader through the linear narrative.
        -->
        <div class="d-flex justify-content-between mt-5 pt-4 border-top border-secondary">
             <?php 
                require_once ROOT_PATH . '/includes/utils/nav-logic.php';
                $nav = getBookNavigation($pageConfig['bookJsonUrl']);
             ?>
             
             <a href="<?php echo $nav['prevLink']; ?>" class="btn btn-outline-secondary <?php echo ($nav['currentIndex'] <= 0) ? 'disabled' : ''; ?>">
                &larr; Previous
             </a>
             
             <a href="<?php echo $nav['upLink']; ?>" class="btn btn-outline-secondary">
                 <i class="ph ph-arrow-up"></i>
             </a>

             <a href="<?php echo $nav['nextLink']; ?>" class="btn btn-outline-dark <?php echo ($nav['nextLink'] === '#') ? 'disabled' : ''; ?>">
                Next &rarr;
             </a>
        </div>

    </div>
</div>

<!-- 
  ARCHITECTURE NOTE: Mobile UX Script
  Hooks into the persistent mobile TOC button (likely in the sticky header) 
  to trigger the Web Awesome drawer.
-->
<script>
(function() {
    // Open Mobile TOC Drawer
    const tocBtns = document.querySelectorAll('#mobile-toc-toggle-btn');
    const tocBtn = tocBtns[tocBtns.length - 1];
    
    if (tocBtn) {
        tocBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation(); // VERY IMPORTANT: Prevents Web Awesome from immediately closing it due to outside click!
            const drawer = document.getElementById('mobileSidebarDrawer');
            if (drawer) {
                drawer.open = true;
                try { drawer.show(); } catch(err) {}
            }
        });
    }
})();
</script>

<style>
/* Story Typeography & Formatting */
.story-content {
}
.story-content p {
    margin-bottom: 1.5rem;
    text-indent: 2rem; /* Traditional book indentation */
}
</style>
