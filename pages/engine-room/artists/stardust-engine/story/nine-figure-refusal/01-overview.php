<?php
/**
 * STARDUST ENGINE: THE NINE FIGURE REFUSAL (OVERVIEW / INDEX)
 * ---------------------------------------------------------
 * ARCHITECTURAL CONTEXT:
 * This is the primary index/landing page for the entire "Nine Figure Refusal" arc.
 * It acts as a table of contents, directing users to the various chapters of the story.
 * 
 * LORE:
 * Organizes the complex corporate warfare narrative into 5 distinct chapters 
 * plus an epilogue, outlining the journey from the initial approach to the legacy.
 * 
 * DESIGN:
 * - A straightforward vertical list of chapters using Bootstrap cards and list-groups.
 * - Employs iconography and bold typography to differentiate story sections.
 * - Provides bottom navigation to begin the case file or return to the main History Hub.
 */

// pages/engine-room/artists/stardust-engine/story/nine-figure-refusal/overview.php
// The Index Page for the "Nine Figure Refusal" Arc.
// Acts as the landing page/table of contents for this specific story.
// UPDATED: Added Chapters 4, 5, and Epilogue based on route list.

$pageTitle = "Case File: OGM-2018 (The $150M Refusal)";
?>

<div class="container py-5">
    <!-- 
      LAYOUT ARCHITECTURE:
      A vertical list of Bootstrap cards, each representing a "Chapter". 
      Inside each card is a list-group with custom-styled list-group-item-actions 
      that act as clickable navigational links to specific story pages.
    -->
    
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
            <span class="badge bg-danger rounded-pill px-3 py-2 mb-3 text-uppercase letter-spacing-1 shadow-sm">
                <i class="ph ph-folder-open me-2"></i>Case File: OGM-2018
            </span>
            <h1 class="display-4 fw-bold text-body-emphasis mb-2" style="font-family: 'Impact', sans-serif;">
                THE NINE FIGURE REFUSAL
            </h1>
            <p class="lead text-body-secondary font-monospace">
                How a $150 million hostile takeover attempt resulted in the total liquidation of the acquirer.
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-body-tertiary border-bottom border-secondary py-3">
                    <h5 class="mb-0 text-body-emphasis fw-bold text-uppercase"><i class="ph ph-chess-pawn me-2 text-secondary"></i>Chapter 1: The Setup</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-approach" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-plane-arrival fa-2x text-info"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Approach Vector</h6>
                            <p class="mb-0 small text-body-secondary">The family arrives in LA. The secret visit to the Landlord's office.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/target-profile" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-crosshairs fa-2x text-danger"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">Target Profile</h6>
                            <p class="mb-0 small text-body-secondary">The Omni-Global dossier. The algorithm vs. Jameson Frost.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/ucc-search-report" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-file-certificate fa-2x text-secondary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">UCC Search Report</h6>
                            <p class="mb-0 small text-body-secondary">Evidence of Zero Debt. The clue Frost missed.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-bus-memo" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-envelope-open-text fa-2x text-warning"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Bus Memo</h6>
                            <p class="mb-0 small text-body-secondary">The internal email that proved predatory intent (Malice).</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-body-tertiary border-bottom border-secondary py-3">
                    <h5 class="mb-0 text-body-emphasis fw-bold text-uppercase"><i class="ph ph-chess-knight me-2 text-secondary"></i>Chapter 2: The Trap</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/forensic-audit" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-magnifying-glass-dollar fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Forensic Audit</h6>
                            <p class="mb-0 small text-body-secondary">Tracing the shell companies behind the acquisition attempt.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-smoking-gun" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-envelope fa-2x text-danger"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Smoking Gun</h6>
                            <p class="mb-0 small text-body-secondary">The "Postage Due" letter that triggered Federal Jurisdiction.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-offer-letter" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-file-contract fa-2x text-dark"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Offer Letter</h6>
                            <p class="mb-0 small text-body-secondary">The $150M Lie. The hidden LBO clause.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-counter-offer" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-envelope-circle-check fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Counter-Offer</h6>
                            <p class="mb-0 small text-body-secondary">The "Kill Switch." Holly's legendary one-page rejection.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-body-tertiary border-bottom border-secondary py-3">
                    <h5 class="mb-0 text-body-emphasis fw-bold text-uppercase"><i class="ph ph-chess-queen me-2 text-secondary"></i>Chapter 3: The Event</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-trigger" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-bolt fa-2x text-danger"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Trigger</h6>
                            <p class="mb-0 small text-body-secondary">The catalyst for the legal battle. Slide 14.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-autopsy" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-laptop-code fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Autopsy</h6>
                            <p class="mb-0 small text-body-secondary">Holly commandeers the screen. The Eviction Notice.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-extraction" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-person-to-door fa-2x text-info"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Extraction</h6>
                            <p class="mb-0 small text-body-secondary">Protocol Safe Harbor. Leaving the building.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-body-tertiary border-bottom border-secondary py-3">
                    <h5 class="mb-0 text-body-emphasis fw-bold text-uppercase"><i class="ph ph-chess-king me-2 text-secondary"></i>Chapter 4: The Fallout</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/zenith-report/omni-global-chapter-11" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-newspaper fa-2x text-dark"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">Market Alert: Ch. 11</h6>
                            <p class="mb-0 small text-body-secondary">Omni-Global files for bankruptcy protection.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/liquidation-auction" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-gavel fa-2x text-danger"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">Asset Liquidation: Case 18-11492</h6>
                            <p class="mb-0 small text-body-secondary">The yard sale. Selling the corporate ego to pay the creditors.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/zenith-report/stardust-bus-ride" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-bus fa-2x text-warning"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Bus Ride Article</h6>
                            <p class="mb-0 small text-body-secondary">The Zenith Report on how a bus ride altered corporate history.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-body-tertiary border-bottom border-secondary py-3">
                    <h5 class="mb-0 text-body-emphasis fw-bold text-uppercase"><i class="ph ph-chess-rook me-2 text-secondary"></i>Chapter 5: The Legacy</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-jessica-miller-center" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-building-columns fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Jessica Miller Center</h6>
                            <p class="mb-0 small text-body-secondary">How the acquisition fallout led to the founding of the Center.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-non-profit-model" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-hand-holding-heart fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Non-Profit Model</h6>
                            <p class="mb-0 small text-body-secondary">How Engine Room Records transitioned to a non-profit organization.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-body-tertiary border-bottom border-secondary py-3">
                    <h5 class="mb-0 text-body-emphasis fw-bold text-uppercase"><i class="ph ph-book-bookmark me-2 text-secondary"></i>Epilogue</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/frost-interview" class="list-group-item list-group-item-action p-4 d-flex align-items-center">
                        <div class="me-4 text-center" style="width: 50px;">
                            <i class="ph ph-clipboard-question fa-2x text-info"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-body-emphasis">The Interview with Frost</h6>
                            <p class="mb-0 small text-body-secondary">The interview with the former VP of Acquisitions of Omni-Global.</p>
                        </div>
                        <i class="ph ph-chevron-right ms-auto text-body-tertiary"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-5 pt-4 border-top border-secondary border-opacity-25 align-items-center">
        <div class="col-4">
            <a href="/engine-room/history" class="btn btn-outline-secondary rounded-pill">
                <i class="ph ph-arrow-left me-2"></i>History Hub
            </a>
        </div>
        <div class="col-4 text-center">
            </div>
        <div class="col-4 text-end">
            <a href="/engine-room/artists/stardust-engine/story/nine-figure-refusal/the-approach" class="btn btn-primary rounded-pill shadow-sm px-4">
                Begin Case File <i class="ph ph-arrow-right ms-2"></i>
            </a>
        </div>
    </div>

</div>