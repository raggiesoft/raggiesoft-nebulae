<?php
/**
 * CRIMSON NODE LORE: ELISE PELLETIER
 * 
 * ARCHITECTURAL CONTEXT:
 * This file serves as the character dossier for "Elise Pelletier" (Guest Vocals / 
 * The Safe Variable) within the Crimson Node / Family faction. It acts as a 
 * structural partial, meant to be injected into a parent routing wrapper.
 *
 * KEY FEATURES:
 * - Thematic Typography: Uses the `Impact` font family and `display-4` classes for a
 *   bold, industrial character header.
 * - Sidebar Layout: Employs a Bootstrap `col-lg-4` sidebar for quick stats, accented
 *   with a custom top border color (`#212529` - dark/slate).
 * - CDN Integration: Pulls both a thumbnail and full-res portrait from `$cdnBaseUrl`.
 *
 * MAINTENANCE NOTES:
 * - This file lacks a `$pageTitle` declaration at the top; it relies on a parent 
 *   controller/wrapper to set meta data. Ensure the parent view injects necessary globals.
 * - Maintain the specific top border color (`#212529`) to preserve character color coding.
 */
?>
<div class="row">
    <div class="col-12 mb-4">
        <h1 class="display-4 fw-bold" style="font-family: 'Impact', sans-serif; letter-spacing: 2px;">
            ELISE <span class="opacity-75">PELLETIER</span>
        </h1>
        <h4 class="text-muted">Guest Vocals / The Safe Variable</h4>
        <hr class="mt-4 mb-0">
    </div>

    <!-- Quick Stats Sidebar Area -->
    <div class="col-lg-4 mb-4 mb-lg-0">
        <!-- Portrait Image -->
        <a href="<?php echo $cdnBaseUrl; ?>/shiloh/images/family/elise-pelletier.jpg" target="_blank" class="d-block mb-4">
            <img src="<?php echo $cdnBaseUrl; ?>/shiloh/images/family/elise-pelletier-thumb.jpg" alt="Portrait of Elise Pelletier" class="img-fluid rounded shadow-sm  w-100">
        </a>
        <div class="card border-0 shadow-sm" style="border-top: 5px solid #212529;">
            <div class="card-body bg-body-tertiary">
                <h5 class="fw-bold mb-3 text-uppercase border-bottom pb-2">Profile Data</h5>
                <ul class="list-unstyled mb-0" style="line-height: 1.8;">
                    <li><strong>Band Role:</strong> Guest Vocals</li>
                    <li><strong>Status:</strong> Honorary Flock / Cleared Proxy</li>
                    <li><strong>Milestone:</strong> First physical contact post-DTS</li>
                    <li><strong>Tactical Specialty:</strong> Holding space without pity</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Biography Content -->
    <div class="col-lg-8">
        <div class="mb-5">
            <h3 class="fw-bold border-bottom pb-2 mb-3">The Safe Variable</h3>
            <p>
                After the toxic ableism of past outsiders and the devastating system failures of previous social attempts, the Albemarle County compound was fiercely guarded. Elise Pelletier bypassed those defensive firewalls not with force, but with an unwavering, quiet consistency. Starting at the tables of the Charlottesville Community College cafeteria, Elise proved that she could exist in Matt's space without bringing pity, noise, or pressure. She learned the tactile "double-tap" language, respected the boundaries of the Vanguard LogicPad, and ultimately earned the unprecedented "Pelletier Clearance Protocol."
            </p>
        </div>

        <div class="mb-5">
            <h3 class="fw-bold border-bottom pb-2 mb-3">The First Embrace</h3>
            <p>
                Elise holds a monumental, sacred distinction within the Miller and Brooks ecosystem. Following the catastrophic "Unhandled Exception" at the Downtown Transit Station (DTS)—where Heather and Hailey abandoned Matt without a word—Matt's physical and emotional defensive perimeters were absolutely locked down. Elise became the very first non-family member granted clearance to break that barrier. Receiving the tactile green light for a hug, she provided a steady, grounding physical anchor that proved to Matt the outside world could still be safe.
            </p>
        </div>

        <div class="mb-4">
            <h3 class="fw-bold border-bottom pb-2 mb-3">The Stadium Anthem</h3>
            <p>
                To officially immortalize her hard-earned status in the flock, Matt and the family invited Elise (alongside her twin sister, Elodie) into the garage studio. Providing soaring guest vocals on the triumphant 1980s arena rock track "The Clearance Protocol," Elise helped bridge the gap between an exclusive family support network and a successfully integrated external friendship. She stands shoulder-to-shoulder with the Phalanx, forever written into the system.
            </p>
        </div>
    </div>
</div>