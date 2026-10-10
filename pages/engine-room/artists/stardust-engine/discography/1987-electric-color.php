<?php
/**
 * ARCHITECTURAL OVERVIEW:
 * This file represents the presentation layer for the 1987 "Electric Color" album page.
 * It integrates UI components (_album-art-header.php, _tracklist-downloader.php) and
 * renders the historical narrative of the album. The architecture relies on simple
 * PHP includes to maintain modularity and ease of maintenance.
 * 
 * Future Maintenance Notes:
 * - When modifying the narrative, ensure alignment with the overarching lore.
 * - Components like the tracklist downloader are globally shared; updates to them
 *   will affect all album pages.
 */
// pages/engine-room/artists/stardust-engine/1987-electric-color.php
// Page data
$pageTitle = "Electric Color (1987) - The Stardust Engine";
$album_path_web = '/engine-room-records/artists/the-stardust-engine/1987-electric-color';

?>

<div class="container py-5">
    
    <div class="row align-items-center mb-5">
        
        <?php 
        // Inline Logic: Define properties for the album art header component.
        // The 'variant' key controls stylistic variations (e.g., 'pact' for the Apex era pink border).
        $props = [
            'path' => $album_path_web, 
            'alt' => 'Electric Color Album Art',
            'variant' => 'pact' // Pink border for Apex era
        ]; include ROOT_PATH . '/includes/components/_album-art-header.php'; ?>

        <div class="col-md-7">
            <h1 class="display-3 fw-bold text-uppercase text-primary mb-0" style="font-family: 'Impact', sans-serif;">
                Electric Color
            </h1>
            <p class="h4 text-warning fw-bold mb-3">
                The 1987 Debut Album
            </p>
            <p class="lead text-secondary">
                The debut album from The Stardust Engine, released in 1987. While a commercial success, its creation was defined by the "cold war" between the band and their label, Apex Records.
            </p>
            <p class="text-muted">
                The album is a sonic battlefield. Apex Records wanted a polished "Stardust" synth-pop record to compete on the charts. The band wanted to unleash their "Engine" rock energy. The result is a fascinating mix of studio-mandated pop and the band's own "malicious compliance" tracks.
            </p>
        </div>
    </div>

    <hr class="border-secondary opacity-25 mb-5">

    <?php include ROOT_PATH . '/includes/components/_tracklist-downloader.php'; ?>

    <h3 class="h5 fw-bold text-uppercase text-muted mt-5 mb-3 border-bottom pb-2">
        <i class="ph ph-box-archive me-2"></i>Studio Archives
    </h3>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="alert alert-dark border-secondary h-100 mb-0">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="ph ph-cassette-tape text-secondary fs-3"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading h6 fw-bold text-secondary text-uppercase mb-1">The Rejected Demo: "Midnight Drivers"</h5>
                        <p class="mb-3 small text-muted">
                            Originally part of the band's early demo tape used to shop for labels, this darkwave track was flatly rejected by Apex executives for being "too melancholic" and "off-brand." Kept locked in the vault, the raw 1987 master eventually became the anchor for a massive retro-engineered concept album fourteen years later.
                        </p>
                        <a href="/engine-room/artists/stardust-engine/discography/2001-midnight-drivers" class="btn btn-sm btn-outline-secondary text-uppercase fw-bold">Explore the 2001 Album</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="alert alert-dark border-secondary h-100 mb-0">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="ph ph-record-vinyl text-secondary fs-3"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading h6 fw-bold text-secondary text-uppercase mb-1">The Vinyl Cut: "Out of Time"</h5>
                        <p class="mb-0 small text-muted">
                            While included on the cassette and CD releases, Apex Records gleefully cut Ryan's 1:35 punk-inspired track from the physical LP, citing that Side B was "too long." They subsequently mastered the remaining rock tracks quietly to neuter their energy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>