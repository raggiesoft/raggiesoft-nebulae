<?php
/**
 * ARCHITECTURE: Generic Button Component
 * 
 * A foundational UI element that normalizes standard button attributes 
 * (variants, sizes, icons, full-width) and maps them to the underlying 
 * Web Awesome implementation via the .rs-btn class/mixin.
 * 
 * COMPONENTS:
 * 1. Property Extraction: Safely extracts href, text, variant, icon, etc. from $props.
 * 2. Variant Mapping: Translates internal RaggieSoft semantic themes ('pact', 'axiom') 
 *    to standard Web Awesome variants ('brand', 'warning', etc.).
 * 3. Icon Injection: Dynamically constructs the HTML for an icon and assigns it to 
 *    either the 'prefix' or 'suffix' slot based on position preference.
 */

// --- Component: button.php ---
// Updated: Web Awesome Components

$href = $props['href'] ?? '#';
$text = isset($props['text']) ? htmlspecialchars($props['text']) : 'Button';
$variantRaw = $props['variant'] ?? 'secondary';
$icon = $props['icon'] ?? null;
$iconPosition = $props['iconPosition'] ?? 'after';
$fullWidth = $props['fullWidth'] ?? false;
$size = $props['size'] ?? 'medium';

// VARIANT NORMALIZATION
// Map proprietary RaggieSoft semantic variants to Web Awesome standards.
$waVariant = 'neutral';
if (in_array($variantRaw, ['pact', 'primary', 'brand'])) $waVariant = 'brand';
if (in_array($variantRaw, ['axiom', 'warning'])) $waVariant = 'warning';
if ($variantRaw === 'danger') $waVariant = 'danger';
if ($variantRaw === 'success') $waVariant = 'success';

$iconHtml = '';
if ($icon) {
    $slot = ($iconPosition === 'before') ? 'prefix' : 'suffix';
    $iconHtml = "<i slot=\"{$slot}\" class=\"" . htmlspecialchars($icon) . "\"></i>";
}

$widthClass = $fullWidth ? 'w-100' : '';
?>

<!-- RENDER BUTTON -->
<!-- Applies the mapped properties to the core UI element. -->
<button class="rs-btn" href="<?php echo htmlspecialchars($href); ?>" 
           variant="<?php echo $waVariant; ?>" 
           size="<?php echo htmlspecialchars($size); ?>"
           class="<?php echo $widthClass; ?>">
    <?php if ($iconPosition === 'before' && $icon) echo $iconHtml; ?>
    <?php echo $text; ?>
    <?php if ($iconPosition === 'after' && $icon) echo $iconHtml; ?>
</button>
