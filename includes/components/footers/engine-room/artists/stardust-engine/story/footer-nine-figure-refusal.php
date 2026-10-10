<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: The "Evidence File" footer for the Nine Figure Refusal story arc.
 * Architecture: Introduces scoped CSS (`<!-- Embedded Style Block: Custom overrides to simulate physical legal documents -->
<style>`) to override standard layouts, generating a 
 * simulated legal document (off-white background, red "sealed" borders, and CSS-based redactions).
 * Future Maintainers: Ensure the `.redacted-text` class retains its black-on-black styling and 
 * `user-select: none` to prevent easy highlighting/copying. Any new 'Exhibits' added to the unordered 
 * list must maintain the `ph-file-contract` or equivalent icon vocabulary.
 */
?>
<style>
    /* Scoped Styles for the Redacted Footer */
    .footer-evidence {
        background-color: #f8f9fa; /* File Folder Off-White */
        border-top: 5px solid #dc3545; /* Red "Sealed" Border */
        font-family: 'Courier New', Courier, monospace;
        color: #212529; /* Darker Grey for AA Compliance */
        position: relative;
        overflow: hidden;
    }
    
    .evidence-stamp {
        border: 3px solid #dc3545;
        color: #dc3545;
        font-weight: bold;
        padding: 5px 10px;
        text-transform: uppercase;
        display: inline-block;
        transform: rotate(-5deg);
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .redacted-text {
        background-color: #000;
        color: #000; /* Text hidden visually */
        padding: 0 4px;
        user-select: none; 
    }
    
    .redacted-text:hover {
        cursor: help; 
    }
</style>

<!-- Footer Container: Applies the off-white paper background and red border -->
<footer class="mt-auto footer-evidence py-5">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-15deg); 
                font-size: 6rem; color: rgba(0,0,0,0.05); font-weight: bold; white-space: nowrap; pointer-events: none;">
        EVIDENCE #492-B
    </div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center gy-4">
            
            <div class="col-md-4 text-center text-md-start">
                <!-- Simulated Rubber Stamp using CSS rotation and border properties -->
                <div class="evidence-stamp mb-3">CONFIDENTIAL</div>
                <div class="small">
                    <strong>CASE ID:</strong> TSE-1995-CIV-001<br>
                    <strong>PLAINTIFF:</strong> Global Media Corp<br>
                    <strong>DEFENDANT:</strong> <span class="redacted-text" aria-label="Redacted: Stardust Engine">Stardust Eng</span><br>
                    <strong>STATUS:</strong> <span class="text-danger fw-bold">SEALED BY COURT ORDER</span>
                </div>
            </div>

            <!-- Center Column: Direct navigation to related lore modules disguised as legal exhibits -->
            <div class="col-md-4 text-center">
                <h6 class="fw-bold text-uppercase border-bottom border-dark d-inline-block pb-1 mb-3">
                    Related Exhibits
                </h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/engine-room/history/friction" class="text-decoration-none text-danger hover-underline">
                            <i class="ph ph-file-contract me-2"></i>Exhibit A: The Friction Catastrophe
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/engine-room/artists/stardust-engine/discography/1995-the-warehouse-tapes" class="text-decoration-none text-dark hover-underline">
                            <i class="ph ph-compact-disc me-2"></i>Exhibit B: The Warehouse Tapes
                        </a>
                    </li>
                    <li class="mb-2">
                        <span class=" text-decoration-line-through">
                            <i class="ph ph-user-secret me-2"></i>Witness Testimony: A. Wright
                        </span> 
                        <span class="badge bg-secondary ms-1">REDACTED</span>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 text-center text-md-end small">
                <p class="mb-2">
                    <strong>WARNING:</strong> Possession of this document without clearance level 
                    <span class="redacted-text" aria-label="Redacted Level">ZZ-9</span> is a federal offense.
                </p>
                <div class="text-dark ">
                    <i class="ph ph-fingerprint fa-2x mb-2"></i><br>
                    Digitized by RaggieSoft Archival Division<br>
                    <a href="/" class="text-dark text-decoration-underline">Return to Surface Web</a>
                </div>
            </div>
        </div>
    </div>
</footer>