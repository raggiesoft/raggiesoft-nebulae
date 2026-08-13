<?php
// includes/components/footers/footer-default.php
// UPDATED: Web Awesome Edition
?>
<div class="wa-padding-block-xl wa-padding-inline-m" style="background-color: var(--wa-color-surface-default);">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 3rem;">
        
        <!-- Branding & Info -->
        <div>
            <a href="/" class="wa-flex wa-align-center wa-text-decoration-none wa-text-default wa-margin-bottom-m">
                <img src="https://assets.raggiesoft.com/raggiesoft-corporate/images/logo/raggiesoft-logo.png" 
                     alt="RaggieSoft Logo" width="40" height="40" class="wa-margin-right-s navbar-brand-corporate-img">
                <span class="wa-font-size-l wa-font-bold wa-text-uppercase brand-font">RaggieSoft<sup>&trade;</sup></span>
            </a>
            <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.5;">
                Digital craftsmanship since 1997.<br> Specializing in narrative-driven experiences and database-free systems architecture.
            </p>
            <div class="wa-font-size-s wa-margin-top-m" style="color: var(--wa-color-neutral-text-quiet);">
                <i class="fa-solid fa-location-dot wa-margin-right-2xs"></i> Ocean View &bull; Norfolk, VA &bull; Est. 2008
            </div>
        </div>

        <!-- Projects -->
        <div>
            <h6 class="wa-font-bold wa-margin-bottom-m">Projects</h6>
            <div class="wa-flex wa-flex-col wa-gap-s wa-font-size-s">
                <a href="/engine-room" class="wa-text-decoration-none wa-text-default" style="opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">Engine Room Records</a>
                <a href="/family" class="wa-text-decoration-none wa-text-default" style="opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">Family</a>
                <a href="/raggiesoft-books/aethel" class="wa-text-decoration-none wa-text-default" style="opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">Silver Gauntlet of Aethel</a>
            </div>
        </div>

        <!-- Built With -->
        <div>
            <h6 class="wa-font-bold wa-margin-bottom-m">Built With</h6>
            <div class="wa-flex wa-flex-col wa-gap-s wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet);">
                <span>Native PHP 8.5</span>
                <span>Web Awesome Pro 3.10</span>
                <span>Vanilla JavaScript</span>
                <span>FontAwesome Pro</span>
            </div>
        </div>

        <!-- Connect -->
        <div>
            <h6 class="wa-font-bold wa-margin-bottom-m">Connect</h6>
            <div class="wa-flex wa-gap-m">
                <a href="https://github.com/raggiesoft" class="wa-text-default wa-font-size-xl" style="opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                <a href="https://linkedin.com/in/michael-ragsdale-raggiesoft" class="wa-text-default wa-font-size-xl" style="opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                <a href="mailto:hireme@michaelpragsdale.com" class="wa-text-default wa-font-size-xl" style="opacity: 0.8; transition: opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
            </div>
        </div>

    </div>
</div>

<?php
// Web Awesome Konami Configuration
$konami_config = [
    'title'      => 'System Admin Access',
    'icon'       => 'fa-solid fa-terminal',
    'theme'      => 'var(--wa-color-brand-fill-loud)', 
    'text_color' => 'var(--wa-color-text-default)',
    'image'      => '',        
    'body'       => '
        <h4 class="wa-font-mono">> ACCESS GRANTED</h4>
        <p class="wa-font-mono wa-margin-top-s" style="color: var(--wa-color-success-text);">
            Debug privileges have been elevated.<br>
            Welcome back, Administrator.
        </p>',
    'btn_text'   => 'Enter Dashboard',
    'btn_link'   => '/admin/dashboard',
    'btn_style'  => 'brand' 
];

include ROOT_PATH . '/includes/components/easter-eggs/konami.php';
?>