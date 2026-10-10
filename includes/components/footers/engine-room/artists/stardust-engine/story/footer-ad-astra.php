<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Extremely minimal, terminal-style footer for the Ad Astra Mission Archive lore page.
 * Architecture: Omits traditional navigation to maintain the immersive feel of an isolated, 
 * archived database interface. Employs inline monospace styling and a planetary ring icon 
 * linked to the 'Stardust Engine' narrative arc.
 * Future Maintainers: Do not add typical global site links (e.g., Privacy Policy, Terms) here. 
 * This component is designed exclusively for closed-loop narrative immersion.
 */
?>
<!-- Minimalist Footer Container: Stripped of global navigation to emulate a closed archive system -->
<footer class="mt-auto py-4 border-top" style="background-color: #000; border-color: var(--astra-primary) !important;">
    <div class="container font-monospace small">
        <div class="row align-items-center">
            
            <!-- Left Column: Primary Narrative Identification Tags -->
            <div class="col-md-6 text-center text-md-start">
                <span class="text-uppercase" style="color: var(--astra-primary); letter-spacing: 1px;">
                    <i class="ph ph-planet-ringed me-2"></i>The Stardust Engine
                </span>
                <span class="mx-2 ">|</span>
                <span style="color: var(--astra-text);">Ad Astra Mission Archive</span>
            </div>
            
        </div>
    </div>
</footer>