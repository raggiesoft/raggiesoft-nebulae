<?php
/**
 * ============================================================================
 * RAGGIESOFT NEBULAE - DEPRECATED LICENSING PORTAL
 * ============================================================================
 * 
 * ARCHITECTURE & PURPOSE:
 * This page serves as a graceful fallback/tombstone for the old `/about/license` 
 * route. Since all licensing and copyright operations have been centralized under
 * the `RaggieSoft Media` division, this page acts purely as an informative 
 * redirect node.
 * 
 * STRUCTURAL PATTERNS:
 * - Uses Bootstrap utility classes to create a centered, min-height layout.
 * - Displays a clear "Portal Relocated" message with a prominent CTA button.
 * - Implements a client-side JavaScript redirect (5 seconds) as a fallback mechanism.
 * 
 * MAINTENANCE NOTES:
 * - Do NOT remove this file as long as old external links or archived assets 
 *   might still point to `/about/license`.
 * - The JavaScript timeout forces a hard browser navigation (`window.location.href`)
 *   to ensure it bypasses any Elara CMS interception if necessary.
 * 
 * @package RaggieSoft_Nebulae
 * @subpackage About
 * @deprecated Use /pages/raggiesoft-media/licensing/overview.php instead.
 * ============================================================================
 */

// pages/about/license.php
// DEPRECATED: Notice page for the old licensing URL.
// All traffic should now route to the centralized RaggieSoft Media portal.

$pageTitle = "Licensing Portal Moved | RaggieSoft";
?>

<!-- 
  STRUCTURAL BLOCK: Main Content Area
  Uses Bootstrap Flexbox classes (`min-vh-50`, `d-flex`, `justify-content-center`) 
  to vertically and horizontally center the relocation notice.
-->
<div class="container py-5 min-vh-50 d-flex flex-column justify-content-center">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            
            <div class="mb-4">
                <i class="ph ph-signs-post fa-5x text-warning opacity-75" aria-hidden="true"></i>
            </div>
            
            <h1 class="display-5 fw-bold mb-3 text-body-emphasis">Portal Relocated</h1>
            
            <p class="lead text-body-secondary mb-5">
                The RaggieSoft licensing and copyright documentation has been centralized. All open-source (MIT), creative (CC BY-SA 4.0), and commercial synchronization clearances are now managed through the <strong>RaggieSoft Media&trade;</strong> B2B portal.
            </p>

            <!-- 
              STRUCTURAL BLOCK: Call-To-Action (CTA) Card
              Highlights the primary action (navigating to the new portal) using 
              warning colors to grab attention and indicate a redirect state.
            -->
            <div class="card border-warning bg-warning-subtle shadow-sm mb-4">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h4 fw-bold text-warning-emphasis mb-3">Please update your bookmarks.</h2>
                    <a href="/raggiesoft-media/licensing" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-sm text-dark text-uppercase" style="letter-spacing: 1px;">
                        Go to the New Licensing Portal <i class="ph ph-arrow-right ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <p class="small text-muted font-monospace mt-4">
                <i class="ph ph-circle-info me-1" aria-hidden="true"></i> System Note: You reached this page from an outdated link in the archives. Redirecting automatically...
            </p>

        </div>
    </div>
</div>

<script>
    // Automatically route the user to the new portal after 5 seconds.
    // Because Elara intercepts standard clicks, we use a standard window.location 
    // here to force the browser to navigate if they sit idle.
    setTimeout(function() {
        window.location.href = '/raggiesoft-media/licensing';
    }, 5000);
</script>