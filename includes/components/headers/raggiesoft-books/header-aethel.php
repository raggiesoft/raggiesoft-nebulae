<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: AETHEL SAGA NARRATIVE HEADER
 * ============================================================================
 * 
 * This header is specialized for "The Silver Gauntlet of Aethel" lore sub-site. 
 * It introduces high-fantasy theming (Gold accents, text shadows) and routes 
 * directly to saga-specific endpoints like Characters, Locations, and Soundtrack.
 * 
 * MAINTENANCE NOTES:
 * - Employs `str_contains` for active state routing across deeply nested pages.
 * - Contains a static "Locked" Map link as a narrative teaser.
 * ============================================================================
 */
// includes/components/headers/raggiesoft-books/header-aethel.php
// THE SAGA NAVIGATION: "The Tome's Index"
// Theme: Cinzel, Gold Accents, High Fantasy

// 1. Determine Active States
// We check the URL to see which "chapter" the user is currently reading.
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';

// Exact match for the overview/home of the saga
$isOverview = ($request_uri === '/raggiesoft-books/aethel-saga' || $request_uri === '/raggiesoft-books/aethel-saga/');

// Sub-sections
$isLore       = str_contains($request_uri, '/lore');
$isSoundtrack = str_contains($request_uri, '/soundtrack');
$isMap        = str_contains($request_uri, '/map');
?>

<div class="d-flex flex-wrap align-items-center gap-2 ms-auto" style="letter-spacing: 1px;">
  
  
    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/aethel-saga" class="px-3 <?php echo $isOverview ? 'active text-warning fw-bold' : ' hover-text-white'; ?>">
       <i slot="prefix" class="ph ph-book-sparkles me-2"></i>Overview
    </button>
  
    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/books/aethel" class="px-3 hover-text-white">
       <i slot="prefix" class="ph ph-book-open-cover me-2"></i>Read The Book
    </button>

    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/aethel-saga/lore/characters" class="px-3 <?php echo $isLore && !str_contains($request_uri, '/locations') ? 'active text-warning fw-bold' : ' hover-text-white'; ?>">
       <i slot="prefix" class="ph ph-users-crown me-2"></i>Characters
    </button>

    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/aethel-saga/lore/locations" class="px-3 <?php echo str_contains($request_uri, '/locations') ? 'active text-warning fw-bold' : ' hover-text-white'; ?>">
       <i slot="prefix" class="ph ph-map-location-dot me-2"></i>Locations
    </button>

    <button class="rs-btn" appearance="plain" href="/raggiesoft-books/aethel-saga/soundtrack" class="px-3 <?php echo $isSoundtrack ? 'active text-warning fw-bold' : ' hover-text-white'; ?>">
       <i slot="prefix" class="ph ph-compact-disc me-2"></i>Soundtrack
    </button>

    <span class="nav-link px-3" style="cursor: not-allowed;" title="The Cartographer is still working...">
       <i class="ph ph-map me-2"></i>Map <small class="ms-1" style="font-size: 0.6em; vertical-align: middle;">(LOCKED)</small>
    </span>
  

  
      <button class="rs-btn" appearance="plain" href="/raggiesoft-books" class=" hover-text-warning small">
        <i slot="prefix" class="ph ph-arrow-right-from-bracket"></i>
      </button>
  

</div>

<style>
    /* Aethel Specific Nav Micro-Interactions */
    .hover-text-white:hover { color: #fff !important; transition: color 0.3s ease; }
    
    /* Make the active link glow slightly in Gold */
    .nav-link.active {
        text-shadow: 0 0 10px rgba(212, 175, 55, 0.4);
    }
</style>