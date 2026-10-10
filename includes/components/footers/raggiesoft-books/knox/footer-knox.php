<?php
/**
 * ARCHITECTURE BLOCK COMMENT
 * 
 * Purpose: Generates a terminal-style, adaptive footer for the K.N.O.X. narrative landing page.
 * Architecture: Adopts a minimal, monospace layout relying on standard bootstrap tertiary-body colors
 * to emulate a low-fidelity computer terminal or dossier.
 * Future Maintainers: Keep the HTML structure extremely barebones. The K.N.O.X. aesthetic
 * relies on brutalism, so avoid adding decorative borders, icons, or complex flex layouts here.
 */
// includes/components/footers/raggiesoft-books/footer-knox.php
// Stripped down brutalist design specifically mapped to K.N.O.X.'s visual identity.
// Adaptive Footer for Knox Landing Page
?>
<footer class="mt-auto bg-body-tertiary text-body border-top border-secondary py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            
            <!-- Left Column: Primary K.N.O.X. Designation using Courier New -->
            <div class="col-md-4 text-center text-md-start">
                <div class="text-uppercase fw-bold text-body" style="font-family: 'Courier New', monospace; letter-spacing: -1px; font-size: 1.5rem;">
                    K.N.O.X.
                </div>
                <div class="small text-body-secondary mt-2">
                    Kinetic Null Operative: X
                </div>
            </div>

            <!-- Right Column: Standardized Terminal Navigation Menu -->
            <div class="col-md-4 text-center">
                <ul class="list-unstyled mb-0" style="font-family: 'Courier New', monospace;">
                    <li class="mb-2">
                        <a href="/raggiesoft-books/knox/chapters" class="text-decoration-none text-body hover-underline">
                            > START READING
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/raggiesoft-books/knox/lore" class="text-decoration-none text-body hover-underline">
                            > WORLD DATA
                        </a>
                    </li>
                    <li class="mb-0">
                        <a href="/raggiesoft-books/knox/characters" class="text-decoration-none text-body hover-underline">
                            > OPERATIVES
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>