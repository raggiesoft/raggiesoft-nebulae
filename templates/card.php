<?php
/**
 * ARCHITECTURE & PURPOSE:
 * This file provides a structural template for rendering a standardized "scroll card"
 * within horizontal runway layouts. It outlines the required `$props` array structure 
 * needed to correctly feed data into the underlying `components/card.php` partial.
 * 
 * MAINTENANCE NOTES:
 * - This is NOT the card component itself. This is meant to be copied/pasted by developers 
 *   when creating new scrollable lists.
 * - Ensure `$props` match exactly what `components/card.php` expects to avoid undefined index warnings.
 */
?>
<div class="scroll-card">
        <?php
          $props = [
            'imgSrc' => '[Image URL]',
            'imgAlt' => '[Image Alt Text]',
            'fallbackText' => '[Short Text if Image Fails]',
            'title' => '[Item Title]',
            'description' => '[Brief Description]',
            'buttonProps' => [
              'href' => '[Destination URL]',
              'text' => '[Button Text]',
              'variant' => 'primary', /* options: primary, secondary, success, danger, warning, info, light, dark */
              'icon' => 'fa-duotone fa-star', /* FontAwesome Icon */
              'fullWidth' => true
            ]
          ];
          include __DIR__ . '/../includes/components/card.php';
        ?>
      </div>