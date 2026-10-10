<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Standardizes the rendering of album cover art on discography/music pages.
 * Architecture: Resolves narrative variant classes (`pact`, `axiom`, `neutral`) into standard
 * Bootstrap contextual colors for the image border. Employs aggressive "Nuclear Cache Busting" 
 * by appending the current UNIX timestamp to the image URL to defeat browser caching.
 * Future Maintainers: Keep the cache-busting timestamp mechanism intact, as early CDN configurations 
 * caused critical desync issues with rapidly updated artwork.
 */
// --- Component: _album-art-header.php ---
// Standardizes the album art display on discography pages.

// 1. Get Data
// Safely pull image paths and descriptive metadata from the injected properties array.
$path = $props['path'] ?? '';
$alt = $props['alt'] ?? 'Album Art';
$variant = $props['variant'] ?? 'primary'; 

// 2. Map Narrative Variants to Bootstrap Colors
// Translate lore-specific labels into standardized UI theme colors for border rendering.
$borderColor = $variant;
if ($variant === 'pact') $borderColor = 'primary';   // Pink/Teal
if ($variant === 'axiom') $borderColor = 'warning';  // Cyan/Orange
if ($variant === 'neutral') $borderColor = 'secondary';

// 3. Build URL with NUCLEAR CACHE BUSTING
// Force browser cache invalidation to ensure the most recent asset is always loaded.
// We append time() so the URL changes every second. Chrome CANNOT cache this.
$imgSrc = $cdnBaseUrl . "" . $path . "/album-art.jpg?v=" . time();
?>

<div class="col-md-5 text-center text-md-start">
    <img src="<?php echo htmlspecialchars($imgSrc); ?>" 
         alt="<?php echo htmlspecialchars($alt); ?>" 
         class="img-fluid shadow-lg rounded border border-4 border-<?php echo $borderColor; ?>">
</div>