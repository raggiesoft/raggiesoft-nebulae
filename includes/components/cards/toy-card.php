<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Generates a responsive card component to display "Toys" (Axiom artifacts) within the lore.
 * Architecture: Utilizes Web Awesome/Bootstrap styling with custom CSS overrides for dark mode. 
 * Extracts variables from an injected `$props` array (or local scope variables) to render the card content.
 * Future Maintainers: If adding new data fields (e.g. Danger Level), inject them into the `.card-body` 
 * and ensure they fall back gracefully if the variable is not provided. Keep the custom CSS block at the bottom
 * intact for thematic integrity.
 */
// Safely extract properties with fallback defaults if parent template omits them
// Props: $name, $type, $effect, $axiom_designation
$toyName = $name ?? "Unknown Toy";
$toyType = $type ?? "Kinetic";
$toyEffect = $effect ?? "Makes a small boom.";
$axiomCode = $axiom_designation ?? "ANOMALY-UNKNOWN";
?>

<!-- Main Card Container: Uses h-100 to align evenly in grid layouts -->
<div class="card h-100 toy-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="font-monospace fw-bold text-uppercase d-none d-md-inline" data-bs-theme-value="light">
            <i class="ph ph-pencil me-2"></i>Schematic: <?php echo $toyName; ?>
        </span>
        <span class="font-monospace fw-bold text-danger text-uppercase d-none d-md-inline" data-bs-theme-value="dark">
            <i class="ph ph-triangle-exclamation me-2"></i>Evidence: <?php echo $axiomCode; ?>
        </span>
    </div>
    
    <div class="card-body position-relative overflow-hidden">
        <div class="text-center py-4 text-body-secondary opacity-50">
            <i class="ph ph-microchip fa-4x"></i>
        </div>

        <h4 class="card-title mt-3 font-monospace"><?php echo $toyName; ?></h4>
        
        <div class="mb-3">
            <span class="skill-pill border-primary text-primary"><?php echo $toyType; ?></span>
            <span class="skill-pill border-secondary text-body-secondary">Kael-Made</span>
        </div>

        <p class="card-text small font-monospace">
            <?php echo $toyEffect; ?>
        </p>
    </div>

    <!-- Footer: Context-sensitive text that changes based on the user's active light/dark theme -->
    <div class="card-footer bg-transparent border-top border-secondary small text-muted font-monospace">
        <span class="d-dark-none">
            <i class="ph ph-leaf me-1"></i> Origin: Scavenged / Organic
        </span>
        <span class="d-light-none text-danger">
            <i class="ph ph-crosshairs me-1"></i> Origin: MILITARY GRADE (Assumed)
        </span>
    </div>
</div>

<style>
/* Custom Data Theme overrides to display different lore perspectives (civilian vs military) */
/* CSS to handle the content switching based on theme */
[data-bs-theme="light"] .d-light-none { display: none !important; }
[data-bs-theme="dark"] .d-dark-none { display: none !important; }

[data-bs-theme="dark"] .toy-card {
    border-color: var(--bs-danger) !important;
    background-image: linear-gradient(45deg, rgba(220, 53, 69, 0.05) 25%, transparent 25%, transparent 50%, rgba(220, 53, 69, 0.05) 50%, rgba(220, 53, 69, 0.05) 75%, transparent 75%, transparent);
    background-size: 20px 20px;
}
</style>