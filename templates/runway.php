<?php
/**
 * ARCHITECTURE: Runway Component Template
 * 
 * DESCRIPTION:
 * This file serves as a baseline HTML snippet (or "runway") used for generating horizontal 
 * scrolling sections (like carousels or card tracks) across the site. It acts as a structural 
 * blueprint rather than a functional, dynamically executed PHP component.
 *
 * STRUCTURE:
 * - Header Row (`d-flex`): Contains the category title on the left and a "View All" link on the right.
 * - Horizontal Wrapper (`.horizontal-scroll-wrapper`): The container intended to house the 
 *   items (e.g., cards, images) that will scroll horizontally.
 *
 * USAGE:
 * - Typically copied and pasted into other layout files, or populated dynamically via backend templating.
 * - Placeholders like `[Insert Category Title]` and `[Insert Category Hub URL]` must be 
 *   replaced with actual content or dynamic variables.
 *
 * MAINTENANCE NOTES:
 * - This file contains no PHP logic. It is purely presentational markup.
 * - The `.horizontal-scroll-wrapper` relies on external CSS to manage the overflow-x and snap behavior.
 */
?>
<div class="mb-5">
    <!-- Section: Header (Title & Call to Action) -->
    <div class="d-flex justify-content-between align-items-end mb-3 px-4 px-xxl-5">
        
        <!-- Category Title Placeholder -->
        <h3 class="h5 fw-bold text-uppercase text-secondary mb-0">
            [Insert Category Title]
        </h3>
        
        <!-- "View All" Link Placeholder -->
        <a href="[Insert Category Hub URL]" class="text-decoration-none text-muted small text-uppercase font-monospace fw-bold hover-primary">
            View All <i class="ph ph-arrow-right ms-1"></i>
        </a>
    </div>
    
    <!-- Section: Track Container (Items go here) -->
    <div class="horizontal-scroll-wrapper">
        </div>
</div>