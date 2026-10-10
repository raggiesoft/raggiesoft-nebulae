<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Standardizes the "Back / Up / Next" footer navigation for story chapters.
 * Architecture: Evaluates an injected `$nav` array to generate responsive bootstrap buttons. 
 * Handles edge cases like the first or last chapter by displaying disabled placeholder buttons 
 * to maintain consistent grid alignment.
 * Future Maintainers: When modifying the grid layout, ensure all three columns remain evenly 
 * spaced (`col-4`) so the buttons do not jump around as users click through chapters.
 */
/**
 * COMPONENT: Narrative Stepper (History Navigation)
 * PURPOSE: Standardizes the "Back / Up / Next" footer navigation for story chapters.
 * * USAGE:
 * $nav = [
 * 'prev' => ['url' => '/path', 'label' => 'Previous'],
 * 'overview' => ['url' => '/path/root', 'label' => 'Overview'],
 * 'next' => ['url' => '/path/next', 'label' => 'Next Chapter']
 * ];
 * include ROOT_PATH . '/includes/components/navigation/narrative-stepper.php';
 */

// Safely evaluate the navigation array and assign fallback values if omitted
// Defaults
$prev = $nav['prev'] ?? null;
$next = $nav['next'] ?? null;
$overview = $nav['overview'] ?? ['url' => '/engine-room/history', 'label' => 'History Hub'];
?>

<div class="row mt-5 pt-4 border-top border-secondary border-opacity-25 align-items-center">
    
    <!-- Left Column: Previous Chapter Button or Invisible Placeholder for layout stability -->
    <div class="col-4">
        <?php if ($prev): ?>
            <a href="<?php echo $prev['url']; ?>" class="btn btn-outline-secondary rounded-pill">
                <i class="ph ph-arrow-left me-2"></i>
                <span class="d-none d-md-inline"><?php echo $prev['label']; ?></span>
                <span class="d-md-none">Back</span>
            </a>
        <?php else: ?>
            <span class="btn btn-outline-secondary rounded-pill disabled opacity-0">
                <i class="ph ph-arrow-left me-2"></i>Placeholder
            </span>
        <?php endif; ?>
    </div>

    <!-- Center Column: Global Hub/Overview Return Button -->
    <div class="col-4 text-center">
        <a href="<?php echo $overview['url']; ?>" class="btn btn-outline-primary rounded-pill">
            <i class="ph ph-list-tree me-2"></i>
            <span class="d-none d-md-inline"><?php echo $overview['label']; ?></span>
            <span class="d-md-none">Hub</span>
        </a>
    </div>

    <!-- Right Column: Next Chapter Button or Disabled End State -->
    <div class="col-4 text-end">
        <?php if ($next): ?>
            <a href="<?php echo $next['url']; ?>" class="btn btn-primary rounded-pill shadow-sm">
                <span class="d-none d-md-inline"><?php echo $next['label']; ?></span>
                <span class="d-md-none">Next</span>
                <i class="ph ph-arrow-right ms-2"></i>
            </a>
        <?php else: ?>
            <a href="<?php echo $overview['url']; ?>" class="btn btn-outline-light rounded-pill disabled" aria-disabled="true">
                End <i class="ph ph-stop ms-2"></i>
            </a>
        <?php endif; ?>
    </div>

</div>