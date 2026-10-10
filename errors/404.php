<?php
/**
 * ARCHITECTURE: 404 Error Page Component
 * 
 * DESCRIPTION:
 * This component renders the default "404 Page Not Found" view when a requested route 
 * cannot be resolved by the server/router.
 *
 * STRUCTURE:
 * - Layout Wrapper: Uses Tailwind CSS utility classes (e.g., `max-w-3xl`, `px-4`, `py-20`, `text-center`)
 *   to center the content horizontally and vertically.
 * - Error Heading (`h1`): Displays the large "404" status code.
 * - Error Messages (`p`): Provides a human-readable explanation of the error.
 * - Action Area (`.mt-8`): A PHP block that dynamically includes and renders the standard 
 *   RaggieSoft button component to offer a "Return Home" escape route.
 *
 * USAGE:
 * - Typically required/included by a central router or error handler when a requested URI 
 *   does not match any valid endpoints.
 *
 * MAINTENANCE NOTES:
 * - This file mixes Tailwind CSS utility classes with custom semantic color variables 
 *   (`text-heading`, `text-body`, `text-body-muted`). Ensure these variables are defined 
 *   in the global stylesheet.
 * - The included component path `__DIR__ . '/../includes/components/button.php'` relies on 
 *   this file residing directly within the `/errors` directory. If moved, the relative path 
 *   must be updated.
 */
?>
<!-- Section: Error Page Container (Tailwind Centered Layout) -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    
    <!-- Error Status Code -->
    <h1 class="text-5xl font-extrabold text-heading">404</h1>
    
    <!-- Error Title -->
    <p class="mt-4 text-2xl font-semibold text-body">
      Page Not Found
    </p>
    
    <!-- Error Description -->
    <p class="mt-2 text-lg text-body-muted">
      The page you were looking for could not be found.
    </p>
    
    <!-- Action Area: Return Home Button -->
    <div class="mt-8">
      <?php
        // --- Use the button component ---
        $props = [
          'href' => '/',
          'text' => 'Return Home',
          'variant' => 'pact', // Assuming 'pact' is a specific thematic variant defined in button.php
          'icon' => 'fa-solid fa-home',
          'iconPosition' => 'before',
          'size' => 'large'
        ];
        // Note: Ensure the button component file exists at this path relative to the errors directory.
        include __DIR__ . '/../includes/components/button.php';
      ?>
    </div>
</div>

