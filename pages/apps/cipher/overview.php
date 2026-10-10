<?php
/**
 * ARCHITECTURAL DOCBLOCK
 * 
 * File: pages/apps/cipher/overview.php
 * Path: /apps/cipher
 * 
 * CORE RESPONSIBILITY:
 * Renders the primary user interface for the "Signal Decryptor" (Cipher) mini-game.
 * Provides the configuration forms, game board, and results display for the Mastermind-style
 * logical deduction application.
 * 
 * LORE CONTEXT:
 * - Themed as a "Signal Decryptor" used to intercept and analyze rogue frequencies.
 * - Ties into the broader Stardust Engine "communications" aesthetic.
 * 
 * UI/UX & STYLING ARCHITECTURE:
 * - Uses Bootstrap 5 cards, forms, and grid layout.
 * - Implements custom CSS for `.card-radio` to create large, clickable difficulty selector cards.
 * - Utilizes HTML5 form validation (`inputmode="numeric"`, `pattern="[0-9]*"`) for mobile-friendly
 *   number inputs.
 * - Includes a Bootstrap Toast component (`#stealthToast`) for non-blocking notifications.
 * - Integrates Phosphor Icons for thematic control buttons.
 * 
 * DEPENDENCIES & INCLUSIONS:
 * - Requires a parent layout/router for the HTML shell.
 * - Dynamically loads the client-side game logic: `/apps/cipher/js/cipher.js`.
 * - Relies on `$cdnBaseUrl` (provided by the router) to load the JS file.
 * 
 * MAINTENANCE NOTES:
 * - This file primarily sets up the DOM structure and IDs required by `cipher.js`.
 * - Do not alter the IDs of forms or input elements (`#configForm`, `#cipherForm`,
 *   `#secretCode`, `#guessInput`, `#resultBox`, etc.) without updating the corresponding
 *   JavaScript controller.
 * - Ensure the inline CSS block for `.card-radio` is maintained if global stylesheets do not
 *   inherit it.
 */
?>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-5 fw-bold border-bottom pb-2 text-primary">
                <i class="ph ph-tower-broadcast me-2"></i>Signal Decryptor
            </h1>
            <p class="lead text-body-secondary">
                Configure the transmitter and intercept the signal.
            </p>
        </div>
    </div>

    <div class="card shadow-sm border-0 bg-body-tertiary mb-5">
        <div class="card-header bg-dark text-white d-flex align-items-center">
            <i class="ph ph-sliders-up me-2"></i>
            <strong class="text-uppercase">Mission Configuration</strong>
        </div>
        <div class="card-body">
            <form id="configForm">
                <div class="row g-4">
                    <div class="col-12 col-lg-8 border-end-lg">
                        <label class="form-label fw-bold text-uppercase small text-body-secondary mb-3">Signal Difficulty Tier</label>
                        <div class="d-flex flex-wrap gap-3">
                            
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="difficulty" id="diffCalibration" value="calibration" checked>
                                <label class="form-check-label" for="diffCalibration">
                                    <span class="d-block fw-bold text-success"><i class="ph ph-gauge me-1"></i> Calibration</span>
                                    <small class="text-body-secondary" style="font-size: 0.75rem;">1-5 • Unique</small>
                                </label>
                            </div>

                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="difficulty" id="diffOrbital" value="orbital">
                                <label class="form-check-label" for="diffOrbital">
                                    <span class="d-block fw-bold text-info"><i class="ph ph-satellite me-1"></i> Orbital</span>
                                    <small class="text-body-secondary" style="font-size: 0.75rem;">1-6 • Repeats</small>
                                </label>
                            </div>

                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="difficulty" id="diffDeep" value="deep">
                                <label class="form-check-label" for="diffDeep">
                                    <span class="d-block fw-bold text-warning"><i class="ph ph-planet-ringed me-1"></i> Deep Space</span>
                                    <small class="text-body-secondary" style="font-size: 0.75rem;">0-9 • Unique</small>
                                </label>
                            </div>

                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="difficulty" id="diffHorizon" value="horizon">
                                <label class="form-check-label" for="diffHorizon">
                                    <span class="d-block fw-bold text-danger"><i class="ph ph-galaxy me-1"></i> Horizon</span>
                                    <small class="text-body-secondary" style="font-size: 0.75rem;">0-9 • Repeats</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 d-flex align-items-center">
                        <div class="d-flex align-items-center p-3 bg-body rounded border w-100">
                            
                            <div class="form-check form-switch m-0 min-w-auto">
                                <input class="form-check-input fs-4 m-0" type="checkbox" role="switch" id="stealthMode">
                            </div>

                            <label class="form-check-label ms-3 cursor-pointer" for="stealthMode">
                                <strong class="d-block text-body-emphasis">Stealth Protocol</strong>
                                <small class="text-body-secondary">Hide Code &amp; Explain Logs</small>
                            </label>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 bg-body-tertiary">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="ph ph-gamepad-modern me-2"></i>Controls
                    </h5>
                    <span class="badge bg-white text-primary" id="rulesBadge">1-5 • Unique</span>
                </div>
                <div class="card-body">
                    <form id="cipherForm">
                        
                        <div class="mb-4">
                            <label for="secretCode" class="form-label fw-bold text-uppercase small text-body-secondary">Target Signal (Secret Code)</label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control form-control-lg font-monospace text-center letter-spacing-2" 
                                       id="secretCode" 
                                       placeholder="Wait..." 
                                       maxlength="4" 
                                       inputmode="numeric"
                                       pattern="[0-9]*"
                                       required 
                                       autocomplete="off">
                                <button class="btn btn-outline-secondary" type="button" id="toggleSecretVisibility">
                                    <i class="ph ph-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            <div class="form-text text-body-secondary" id="secretHint">Enter 4 unique digits (1-5).</div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="mb-3">
                            <label for="guessInput" class="form-label fw-bold text-uppercase small text-body-secondary">Incoming Frequency (Guess)</label>
                            <input type="tel" 
                                   class="form-control form-control-lg font-monospace text-center letter-spacing-2" 
                                   id="guessInput" 
                                   placeholder="----" 
                                   maxlength="4" 
                                   inputmode="numeric"
                                   pattern="[0-9]*"
                                   required
                                   autocomplete="off">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="ph ph-magnifying-glass me-2"></i>Analyze Signal
                            </button>
                            <button type="button" id="resetBtn" class="btn btn-outline-secondary">
                                <i class="ph ph-rotate-left me-2"></i>Reset Transmission
                            </button>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <a href="/apps/cipher/rules" class="text-decoration-none text-body-secondary small">
                                <i class="ph ph-book-open me-1"></i>Protocols
                            </a>
                            <span class="text-body-secondary small opacity-50">•</span>
                            <a href="/apps/cipher/history" class="text-decoration-none text-body-secondary small">
                                <i class="ph ph-scroll-old me-1"></i>Origins
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div id="resultBox" class="alert alert-dark text-center py-4 d-none mb-4 border-2">
                <h6 class="text-uppercase text-body-secondary letter-spacing-1 mb-3">Decryption Result</h6>
                <div class="display-1 fw-bold text-body-emphasis" id="resultSymbols" style="letter-spacing: 0.2em;">
                    </div>
            </div>

            <div id="explanationBox" class="card border-primary d-none">
                <div class="card-header bg-primary text-white">
                    <strong class="small text-uppercase">
                        <i class="ph ph-microchip me-2"></i>Logic Analysis Log
                    </strong>
                </div>
                <div class="card-body bg-body-tertiary">
                    <ul id="logList" class="list-group list-group-flush bg-transparent">
                        </ul>
                </div>
            </div>

            <div id="placeholderState" class="text-center text-body-secondary py-5">
                <i class="ph ph-shield-keyhole fa-4x opacity-50 mb-3"></i>
                <p>Waiting for input...</p>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="stealthToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-dark text-white">
            <i class="ph ph-user-secret me-2"></i>
            <strong class="me-auto">System Notification</strong>
            <small class="text-white-50">Just now</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-body-tertiary">
            Stealth Protocol updated. <br>
            <span class="text-body-secondary small">Changes will apply on next analysis.</span>
        </div>
    </div>
</div>

<script src="<?php echo $cdnBaseUrl; ?>/apps/cipher/js/cipher.js?v=<?php echo time(); ?>"></script>

<style>
.card-radio {
    position: relative;
    padding-left: 0;
}
.card-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
.card-radio label {
    display: block;
    padding: 0.75rem 1rem;
    border: 2px solid var(--bs-border-color);
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s;
    background: var(--bs-body-bg); 
    color: var(--bs-body-color);    
}
.card-radio input:checked + label {
    border-color: var(--bs-primary);
    background-color: var(--bs-primary-bg-subtle);
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
</style>