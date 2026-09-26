<?php
// includes/components/headers/raggiesoft-books/header-books.php
// Global navigation for the Ocean View Archives imprint.
// Updated: Web Awesome Components

$request_uri = $_SERVER['REQUEST_URI'] ?? '/raggiesoft-books';
$isHub = ($request_uri === '/raggiesoft-books');
$isKnox = (str_starts_with($request_uri, '/raggiesoft-books/knox'));
$isAethel = (str_starts_with($request_uri, '/raggiesoft-books/aethel-saga'));
$isBooks = (str_starts_with($request_uri, '/raggiesoft-books/books'));
?>

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  <button class="rs-btn" appearance="plain" href="/raggiesoft-books" style="<?php echo $isHub ? 'color: #E3B27C !important; font-weight: bold;' : ''; ?>" class="<?php echo $isHub ? '' : 'text-body-secondary'; ?>">
    <i slot="start" class="ph ph-landmark"></i> The Archive
  </button>

  <button class="rs-btn" appearance="plain" href="/raggiesoft-books/books" class="<?php echo $isBooks ? 'text-info fw-bold' : 'text-body-secondary'; ?>">
    <i slot="start" class="ph ph-books"></i> Contemporary Library
  </button>

  <button class="rs-btn" appearance="plain" href="/raggiesoft-books/knox" class="<?php echo $isKnox ? 'text-success fw-bold' : 'text-body-secondary'; ?>">
    <i slot="start" class="ph ph-planet-ringed"></i> Project: KNOX
  </button>

  <button class="rs-btn" appearance="plain" href="/raggiesoft-books/aethel-saga" class="<?php echo $isAethel ? 'text-primary fw-bold' : 'text-body-secondary'; ?>">
    <i slot="start" class="ph ph-sword"></i> Aethel Saga
  </button>

  <div class="ms-2 ps-2 border-start border-secondary border-">
      <button class="rs-btn" appearance="plain" variant="neutral" href="/raggiesoft-media" class="text-body-secondary">
        <i slot="start" class="ph ph-arrow-right-from-bracket"></i> RaggieSoft Media
      </button>
  </div>

</div>
