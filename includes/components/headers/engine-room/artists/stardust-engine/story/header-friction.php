<?php
/**
 * ARCHITECTURE: "Friction" Story Header Component
 * 
 * DESCRIPTION:
 * This component provides dedicated navigation for the "Friction Catastrophe" story section 
 * (The 1992 Cold War Era) within the Stardust Engine artist profile. It sets a specific mood 
 * (red/danger themes) for navigating restricted assets.
 *
 * STRUCTURE:
 * - PHP Routing Logic: Evaluates `$uri` to determine the active state for the Overview 
 *   (`$isOverview`) and Evidence (`$isEvidence`) links.
 * - Mobile Nav Container: A flexbox layout wrapper.
 * - Home Link: Global exit point.
 * - Overview Link: Points to the main story landing page. Conditionally styled with `.text-danger` if active.
 * - Evidence Dropdown: A `wa-dropdown` containing links to specific story beats (e.g., "The Lost Title Track") 
 *   and related discography.
 * - Return Link: An escape hatch back to the main band history timeline.
 *
 * USAGE:
 * - Included dynamically on pages within the `story/friction` directory structure.
 *
 * MAINTENANCE NOTES:
 * - The Home link has a malformed inner HTML tag `<i>></i>`. The extra `>` should be 
 *   removed in a future pass.
 * - The `.text-danger` class is used to emphasize the "Cold War/Restricted" thematic elements.
 */

// includes/components/headers/engine-room/artists/stardust-engine/story/header-friction.php
// Dedicated navigation for the "Friction Catastrophe" (1992)
// Context: The "Cold War" Era.

$uri = $_SERVER['REQUEST_URI'] ?? '';
$isOverview = ($uri === '/engine-room/artists/stardust-engine/story/friction');
$isEvidence = str_contains($uri, '/the-lost-title-track');
?>

<!-- Section: Navigation Container -->
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">

    
        <!-- Link: Global Home (Note: contains malformed <i> tag) -->
        <button class="rs-btn" appearance="plain" href="/"><i class="ph ph-house me-2">></i> Home</button>
    

    
        <!-- Link: Story Overview (Thematic Danger Styling if Active) -->
        <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/story/friction" class="<?php echo $isOverview ? 'active fw-bold text-danger' : ''; ?>">
            <i slot="start" class="ph ph-file-contract me-2"></i>Overview
        </button>
    

    
  <!-- Dropdown: Evidence & Assets -->
  <wa-dropdown placement="bottom-start">
    <button class="rs-btn" class="nav-link  <?php echo $isEvidence ? 'active fw-bold text-danger' : ''; ?>" slot="trigger" appearance="plain">
            <i class="ph ph-folder-magnifying-glass me-2"></i>Evidence
         <i slot="end" class="ph ph-circle-caret-down ms-2 opacity-50" aria-hidden="true"></i>
        </button>
    <wa-menu>
      <!-- Sub-category: Restricted Story Beats -->
      <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase text-danger fw-bold">Restricted Assets</div>
            <wa-dropdown-item value="/engine-room/artists/stardust-engine/story/friction/the-lost-title-track">
                    <i class="ph ph-ban me-2 text-danger"></i>The Lost Title Track
                </wa-dropdown-item>
            <wa-divider></wa-divider>
            
            <!-- Sub-category: Contextual Links -->
            <div class="px-3 py-2 small text-uppercase  fw-bold text-uppercase ">Related Archives</div>
            <wa-dropdown-item value="/engine-room/artists/stardust-engine/discography/1992-friction">
                    <i class="ph ph-compact-disc me-2"></i>The Canceled Album
                </wa-dropdown-item>
    </wa-menu>
  </wa-dropdown>


    
        <!-- Link: Return to History Timeline -->
        <button class="rs-btn" appearance="plain" href="/engine-room/artists/stardust-engine/band/history">
            <i slot="start" class="ph ph-arrow-turn-up me-2 "></i><span class=" small">Return to Timeline</span>
        </button>
    

</div>