<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: A standardized card component utilizing Web Awesome (`<wa-card>`) syntax.
 * Architecture: Extracts `$props` passed from the parent script to populate image, title,
 * description, and a conditional footer button. Includes fallback placeholder logic if an
 * image fails to load.
 * Future Maintainers: Ensure any new slots align with Web Awesome documentation. Keep
 * the default fallback image generator (`placehold.co`) intact to prevent visual breakages.
 */
// Extract and sanitize variables passed from the parent template via $props array
// --- Component: card.php ---
// Updated: Web Awesome Components

$imgSrc = $props['imgSrc'] ?? null;
$imgAlt = $props['imgAlt'] ?? 'Card image';
$fallbackText = $props['fallbackText'] ?? 'Image';
$title = isset($props['title']) ? htmlspecialchars($props['title']) : 'Card Title';
$description = $props['description'] ?? 'Card description goes here.';
$buttonProps = $props['buttonProps'] ?? null;
$variant = $buttonProps['variant'] ?? 'secondary';

// Define placeholder background colors derived from brand variants for image fallbacks
$bgColor = '6c757d'; 
if ($variant === 'pact') $bgColor = '005A5A'; 
if ($variant === 'axiom') $bgColor = 'A8491A';
$textColor = 'FFFFFF';
$placeholderUrl = "https://placehold.co/600x400/{$bgColor}/{$textColor}?text=" . urlencode($fallbackText);
?>

<!-- Render the Web Awesome card element, structured to take up full available height -->
<wa-card style="height: 100%; display: flex; flex-direction: column;">
  <?php if ($imgSrc): ?>
    <div slot="media" style="position: relative; width: 100%; padding-top: 150%;">
      <img src="<?php echo htmlspecialchars($imgSrc); ?>"
           alt="<?php echo htmlspecialchars($imgAlt); ?>"
           onerror="this.onerror=null;this.src='<?php echo $placeholderUrl; ?>';"
           style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
      <?php if (strpos($imgSrc, 'book-placeholder.jpg') !== false): ?>
          <img src="<?php echo (isset($cdnBaseUrl) ? $cdnBaseUrl : ''); ?>/raggiesoft-books/images/logos/oceanview-archives.svg" 
               style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70%; height: auto; pointer-events: none; opacity: 0.85;">
      <?php endif; ?>
    </div>
  <?php else: ?>
    <div slot="media" style="position: relative; width: 100%; padding-top: 150%;">
      <img src="<?php echo $placeholderUrl; ?>" alt="<?php echo htmlspecialchars($imgAlt); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
    </div>
  <?php endif; ?>

  <h3 class="h5 mt-0 mb-2 fw-bold text-body">
    <?php echo $title; ?>
  </h3>
  <div class="text-body-secondary mb-0">
    <?php echo $description; ?>
  </div>

  <!-- Conditionally include the button sub-component if button properties were provided -->
  <?php if ($buttonProps): ?>
    <div slot="footer">
      <?php
        $props = $buttonProps;
        include __DIR__ . '/button.php';
      ?>
    </div>
  <?php endif; ?>
</wa-card>
