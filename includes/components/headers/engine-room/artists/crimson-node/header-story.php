<?php
/**
 * ARCHITECTURE: Crimson Node Story Archives Header
 * 
 * This component acts as a specialized navigation bar for sequential reading 
 * of the Crimson Node archives.
 * 
 * COMPONENTS:
 * 1. Breadcrumb/Up-Navigation: Links to return to the main Node or top-level Archives.
 * 2. Sequential Logic: PHP logic explicitly checks the current chapter URI to calculate
 *    the previous and next chapter URLs, disabling buttons if at the start or end.
 * 3. Playback Controls: UI buttons mapping to the computed prev/next links.
 */

// includes/components/headers/engine-room/artists/crimson-node/header-story.php
// Custom Header for The Archives (Story Mode)

$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$isArchives = $request_uri === '/raggiesoft-books/books/crimson-node';

// SEQUENTIAL ROUTING LOGIC
// Determines pagination state based on the exact current chapter URI.
// (This can be expanded as more chapters are added)
$prevLink = "#";
$prevDisabled = "disabled";
$nextLink = "#";
$nextDisabled = "disabled";

if ($request_uri === '/engine-room/artists/crimson-node/story/chapter-01') {
    $prevDisabled = "disabled";
    $nextLink = "/engine-room/artists/crimson-node/story/chapter-02";
    $nextDisabled = "";
} elseif ($request_uri === '/engine-room/artists/crimson-node/story/chapter-02') {
    $prevLink = "/engine-room/artists/crimson-node/story/chapter-01";
    $prevDisabled = "";
    $nextLink = "/engine-room/artists/crimson-node/story/chapter-03";
    $nextDisabled = "";
} elseif ($request_uri === '/engine-room/artists/crimson-node/story/chapter-03') {
    $prevLink = "/engine-room/artists/crimson-node/story/chapter-02";
    $prevDisabled = "";
    $nextDisabled = "disabled";
}
?>

<!-- STORY NAVIGATION CONTAINER -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/artists/crimson-node">
        <i slot="start" class="ph ph-house-chimney-blank me-1" aria-hidden="true"></i> Node
    </button>
  

  <li class="nav-item border-start border-secondary mx-2 d-none d-md-block" style="height: 24px;">

  <!-- Archives Up -->
  
    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/books/crimson-node" class="<?= $isArchives ? 'active' : '' ?>">
        <i slot="start" class="ph ph-book-atlas me-1" aria-hidden="true"></i> Archives
    </button>
  

  <li class="nav-item border-start border-secondary mx-2 d-none d-md-block" style="height: 24px;">

  <!-- PLAYBACK CONTROLS -->
  <!-- Next/Prev buttons driven by the PHP sequential routing logic. -->
  
    <button class="rs-btn" appearance="plain" href="<?= $prevLink ?>" class="<?= $prevDisabled ?>">">
        <i slot="start" class="ph ph-backward-step" aria-hidden="true"></i>
    </button>
  
  
    <button class="rs-btn" appearance="plain" href="<?= $nextLink ?>" class="<?= $nextDisabled ?>">">
        <i slot="start" class="ph ph-forward-step" aria-hidden="true"></i>
    </button>
  

</div>
