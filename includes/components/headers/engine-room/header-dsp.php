<?php
/**
 * ARCHITECTURE & PURPOSE:
 * This component provides a sterile, administrative navigation header designed 
 * specifically for DSP (Digital Service Provider) verifiers.
 * It purposely omits standard lore, discography, or fan-facing links to maintain 
 * a professional, strictly-business B2B context.
 *
 * MAINTENANCE NOTES:
 * - The header currently hardcodes "active" styling (fw-bold text-info) for the Master Directory.
 * - The contact link directs straight to the DSP operations email alias.
 * - Ensure the DSP verification route (/engine-room/dsp-verification) matches the application's router.
 */
// includes/components/headers/engine-room/header-dsp.php
// Sterile, administrative header for DSP verifiers. No lore links.
?>
<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-auto py-3 py-md-0 w-100 mobile-nav-menu">
  
  
    <button class="rs-btn" appearance="plain" href="/engine-room/dsp-verification" class="active fw-bold text-info">
        <i slot="start" class="ph ph-folder-open me-2" aria-hidden="true"></i>Master Directory
    </button>
  

  
      <button class="rs-btn" appearance="plain" href="mailto:dsp.operations@engineroom-records.com" class="text-body-secondary hover-text-info">
        <i slot="start" class="ph ph-envelope me-2" aria-hidden="true"></i><span class="small">Contact DSP Support</span>
      </button>
  

</div>