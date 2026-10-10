<?php
/**
 * ARCHITECTURE: Crimson Node - Story Archive Sidebar Component
 * 
 * DESCRIPTION:
 * This component provides contextual navigation for the Crimson Node "Story" section 
 * (the Archives Index) within the Engine Room. It includes links to chapters and dynamically 
 * displays chapter sub-parts (anchors) based on the current `$request_uri`.
 *
 * STRUCTURE:
 * - Quick Access / Recent Section: The top list-group containing the main "Archives Index" link 
 *   and quick access to recent or featured chapters (e.g., Chapter 5).
 * - Book Index Section: A comprehensive list of chapters grouped under book headings (e.g., "Book 1: The Illusion").
 * - Dynamic Sub-navigation: PHP `if` blocks that check `$request_uri` to selectively render 
 *   sub-parts for the active chapter.
 *
 * USAGE:
 * - Included dynamically in the sidebar area of Crimson Node story pages.
 * - Extracts `$request_uri` from `$_SERVER` (defaulting to `/`) to determine active states.
 * - Utilizes Bootstrap 5 utility classes (`list-group`, `active`, `ps-4`).
 *
 * MAINTENANCE NOTES:
 * - The logic relies on exact string matches for `$request_uri`. If URL structures change 
 *   (e.g., removing trailing slashes or moving paths), these checks must be updated.
 * - Sub-part links use hash anchors (`#part-1`), implying scroll-based navigation on the target page.
 * - Note: There appears to be duplicate entries for "Chapter 5" in the Book Index Section that 
 *   may need pruning in future updates.
 */

// includes/components/sidebars/engine-room/artists/crimson-node/sidebar-story.php
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
?>
<!-- Section: Quick Access / Featured Links -->
<div class="list-group list-group-flush border-bottom mb-4">
    <a href="/engine-room/artists/crimson-node/story" class="list-group-item list-group-item-action <?= ($request_uri == '/engine-room/artists/crimson-node/story') ? 'active' : '' ?>">
        <i slot="start" class="ph ph-book-atlas"></i> Archives Index
    </a>

    <!-- Chapter 5 -->
    <a href="/raggiesoft-books/books/crimson-node/book-01/chapter-05" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/raggiesoft-books/books/crimson-node/book-01/chapter-05') ? 'active' : '' ?>">
        Chapter 5: Interlude
    </a>
    <?php if ($request_uri == '/raggiesoft-books/books/crimson-node/book-01/chapter-05'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: The New Hierarchy
        </a>
        <a href="#part-2" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 2: The Empathy Drill
        </a>
        <a href="#part-3" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 3: The Ghost Letter
        </a>
        <a href="#part-4" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 4: The Empty Frame
        </a>
        <a href="#part-5" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 5: The Thunderstorm
        </a>
    <?php endif; ?>
</div>

<!-- Section: Book Index Header -->
<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1  text-uppercase">
    <span>Book 1: The Illusion</span>
</h6>
<!-- Section: Book Chapters Navigation -->
<div class="list-group list-group-flush">
    <!-- Chapter 1 -->
    <a href="/engine-room/artists/crimson-node/story/book-1/chapter-01" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-01') ? 'active' : '' ?>">
        Chapter 1: The Approach
    </a>
    <?php if ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-01'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: Anomalies
        </a>
    <?php endif; ?>

    <!-- Chapter 2 -->
    <a href="/engine-room/artists/crimson-node/story/book-1/chapter-02" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-02') ? 'active' : '' ?>">
        Chapter 2: The Core Ecosystem
    </a>
    <?php if ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-02'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: The Commons
        </a>
        <a href="#part-2" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 2: 6th Period Lunch
        </a>
        <a href="#part-3" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 3: The Omni-Q Incident
        </a>
        <a href="#part-4" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 4: The Fallout
        </a>
    <?php endif; ?>

    <!-- Chapter 3 -->
    <a href="/engine-room/artists/crimson-node/story/book-1/chapter-03" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-03') ? 'active' : '' ?>">
        Chapter 3: The Triple Birthday
    </a>
    <?php if ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-03'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: The Morning Routine
        </a>
        <a href="#part-2" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 2: The Breakfast Spread
        </a>
        <a href="#part-3" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 3: The Stadium Seating
        </a>
        <a href="#part-4" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 4: The Majesty Express
        </a>
        <a href="#part-5" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 5: The Simulation
        </a>
        <a href="#part-6" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 6: Player Two
        </a>
        <a href="#part-7" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 7: The Legal Baseline
        </a>
        <a href="#part-8" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 8: The Triad
        </a>
    <?php endif; ?>

    <!-- Chapter 4 -->
    <a href="/engine-room/artists/crimson-node/story/book-1/chapter-04" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-04') ? 'active' : '' ?>">
        Chapter 4: The Failed Apology
    </a>
    <?php if ($request_uri == '/engine-room/artists/crimson-node/story/book-1/chapter-04'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: The Band Room Hallway
        </a>
        <a href="#part-2" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 2: The Principal's Office
        </a>
        <a href="#part-3" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 3: Interlude - The Phone Call
        </a>
        <a href="#part-4" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 4: The Rumor Mill
        </a>
        <a href="#part-5" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 5: The ISS Trailer
        </a>
        <a href="#part-6" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 6: The Charlottesville Plan
        </a>
    <?php endif; ?>

    <!-- Chapter 5 -->
    <a href="/raggiesoft-books/books/crimson-node/book-01/chapter-05" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/raggiesoft-books/books/crimson-node/book-01/chapter-05') ? 'active' : '' ?>">
        Chapter 5: Interlude
    </a>
    <?php if ($request_uri == '/raggiesoft-books/books/crimson-node/book-01/chapter-05'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: The New Hierarchy
        </a>
        <a href="#part-2" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 2: The Empathy Drill
        </a>
        <a href="#part-3" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 3: The Ghost Letter
        </a>
        <a href="#part-4" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 4: The Empty Frame
        </a>
        <a href="#part-5" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 5: The Thunderstorm
        </a>
    <?php endif; ?>

    <!-- Chapter 5 -->
    <a href="/raggiesoft-books/books/crimson-node/book-01/chapter-05" class="list-group-item list-group-item-action fw-bold <?= ($request_uri == '/raggiesoft-books/books/crimson-node/book-01/chapter-05') ? 'active' : '' ?>">
        Chapter 5: Interlude
    </a>
    <?php if ($request_uri == '/raggiesoft-books/books/crimson-node/book-01/chapter-05'): ?>
        <a href="#part-1" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 1: The New Hierarchy
        </a>
        <a href="#part-2" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 2: The Empathy Drill
        </a>
        <a href="#part-3" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 3: The Ghost Letter
        </a>
        <a href="#part-4" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 4: The Empty Frame
        </a>
        <a href="#part-5" class="list-group-item list-group-item-action ps-4 py-2 border-0 " style="font-size: 0.9em; background-color: rgba(0,0,0,0.02);">
            <i slot="start" class="ph ph-angle-right"></i> Part 5: The Thunderstorm
        </a>
    <?php endif; ?>
</div>