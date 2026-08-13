<?php
// pages/home.php
// Nebulae Incubator: Mission Control

$pageTitle = "Nebulae Incubator | Mission Control";
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "https://nebulae.raggiesoft.com/#website",
      "url": "https://nebulae.raggiesoft.com/",
      "name": "Nebulae Incubator",
      "description": "The front-end sandbox and native PHP component incubator for RaggieSoft.",
      "publisher": {
        "@type": "Organization",
        "name": "RaggieSoft",
        "logo": "https://assets.raggiesoft.com/common/logos/raggiesoft-logo.png"
      }
    }
  ]
}
</script>

<style>
    /* --- THE Y-JUNCTION SPLIT HERO (Web Awesome Edition) --- */
    .split-hero-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        width: 100%;
        border-radius: var(--wa-border-radius-l);
        overflow: hidden;
        margin-bottom: var(--wa-space-xl);
        border: 1px solid var(--wa-color-neutral-border-quiet);
    }
    
    .split-pane {
        position: relative;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        background-color: var(--wa-color-surface-sunken);
    }

    .pane-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.8s ease;
        z-index: 0;
    }

    .pane-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        transition: background-color 0.5s ease;
        z-index: 1;
    }

    .pane-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #ffffff !important;
        padding: 3rem 1.5rem;
        max-width: 600px;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: center;
    }

    /* Avatar Styling */
    .pane-avatar {
        width: 130px;
        height: 130px;
        object-fit: cover;
        box-shadow: 0 8px 20px rgba(0,0,0,0.8);
        border-radius: 50%;
        margin-bottom: var(--wa-space-m);
    }

    /* Desktop Hover Dynamics */
    @media (min-width: 992px) {
        .split-hero-container { flex-direction: row; }
        .split-pane { border-bottom: none; border-right: 1px solid rgba(255, 255, 255, 0.1); }
        .split-pane:last-child { border-right: none; }
        
        .split-pane:hover { flex: 1.25; }
        .split-pane:hover .pane-overlay { background-color: rgba(0, 0, 0, 0.5); }
        .split-pane:hover .pane-bg { transform: scale(1.05); }
    }

    /* Accessibility: Reduced Motion Override */
    @media (prefers-reduced-motion: reduce) {
        .split-pane, .pane-bg, .pane-overlay {
            transition: none !important;
            transform: none !important;
        }
        @media (min-width: 992px) {
            .split-pane:hover { flex: 1 !important; }
            .split-pane:hover .pane-bg { transform: none !important; }
        }
    }

    .hero-title { text-shadow: 0px 4px 15px rgba(0,0,0,0.9), 0px 1px 3px rgba(0,0,0,1); }
    .hero-text { text-shadow: 0px 2px 8px rgba(0,0,0,0.9); }

    /* --- HORIZONTAL SCROLL CAROUSEL (The Netflix UI) --- */
    .horizontal-scroll-wrapper {
        display: flex;
        overflow-x: auto;
        gap: 1.5rem;
        padding-bottom: 2rem;
        padding-left: 1rem;
        padding-right: 1rem;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; 
    }
    
    .horizontal-scroll-wrapper::-webkit-scrollbar {
        display: none; 
    }

    .scroll-card {
        flex: 0 0 85%; 
        scroll-snap-align: center;
        max-width: 400px;
        --wa-card-border-radius: var(--wa-border-radius-l);
    }
    
    /* Ensure card images fit beautifully */
    .scroll-card::part(image) {
        border-bottom: 1px solid var(--wa-color-neutral-border-quiet);
        background-color: var(--wa-color-surface-sunken);
        padding: var(--wa-space-m);
        display: flex;
        justify-content: center;
    }
    .scroll-card img {
        max-height: 120px;
        object-fit: contain;
    }

    @media (min-width: 768px) {
        .scroll-card { flex: 0 0 45%; }
    }

    @media (min-width: 992px) {
        .scroll-card { flex: 0 0 30%; }
        .horizontal-scroll-wrapper { padding-left: 0; padding-right: 0; justify-content: center; } 
    }
</style>

<section class="split-hero-container" aria-label="Main Navigation Routing">
    
    <div class="split-pane">
        <div class="pane-bg" style="background-image: url('https://assets.raggiesoft.com/common/patterns/stars-transparent.png'); background-color: #0a0e14; background-size: auto;"></div>
        <div class="pane-overlay"></div>
        
        <div class="pane-content">
            <img src="https://assets.raggiesoft.com/raggiesoft-corporate/images/logos/logo-michael.png" alt="The Sandbox" class="pane-avatar" style="border: 3px solid var(--wa-color-brand-border);">
            <h1 class="wa-font-size-3xl wa-font-bold wa-text-uppercase brand-font hero-title wa-margin-bottom-xs">The Sandbox</h1>
            <h2 class="wa-font-size-l wa-font-light hero-text wa-text-uppercase wa-margin-bottom-m" style="color: var(--wa-color-brand-text); letter-spacing: 1px;">UI Components & Layouts</h2>
            <p class="wa-font-size-m hero-text wa-margin-bottom-l" style="color: rgba(255,255,255,0.75);">
                Experimenting with Web Awesome Pro components, Dark Aero aesthetics, and database-free styling.
            </p>
            <div class="wa-flex wa-flex-wrap wa-gap-m wa-justify-center mt-auto">
                <wa-button href="/sandbox/buttons" variant="brand" size="large" class="wa-font-bold wa-text-uppercase">
                    <i slot="start" class="fa-duotone fa-game-board-simple"></i> UI Elements
                </wa-button>
                <wa-button href="/sandbox/cards" variant="neutral" size="large" class="wa-font-bold wa-text-uppercase">
                    <i slot="start" class="fa-duotone fa-objects-column"></i> Layouts
                </wa-button>
            </div>
        </div>
    </div>

    <div class="split-pane">
        <div class="pane-bg" style="background-image: url('https://assets.raggiesoft.com/stardust-engine/images/stardust-nebula.jpg');"></div>
        <div class="pane-overlay"></div>
        
        <div class="pane-content">
            <div class="pane-avatar wa-flex wa-align-center wa-justify-center" style="border: 3px solid var(--wa-color-warning-border); background-color: var(--wa-color-surface-sunken);">
                <i class="fa-duotone fa-server wa-font-size-4xl" style="color: var(--wa-color-warning-text);"></i>
            </div>
            <h1 class="wa-font-size-3xl wa-font-bold wa-text-uppercase brand-font hero-title wa-margin-bottom-xs">The Architecture</h1>
            <h2 class="wa-font-size-l wa-font-light hero-text wa-text-uppercase wa-margin-bottom-m" style="color: var(--wa-color-warning-text); letter-spacing: 1px;">Lyra Router & Orion Vault</h2>
            <p class="wa-font-size-m hero-text wa-margin-bottom-l" style="color: rgba(255,255,255,0.75);">
                Native PHP 8.5 routing, Git Bash deployment protocols, and heavily optimized infrastructure.
            </p>
            <div class="wa-flex wa-flex-wrap wa-gap-m wa-justify-center mt-auto">
                <wa-button href="/settings" variant="warning" size="large" class="wa-font-bold wa-text-uppercase">
                    <i slot="start" class="fa-duotone fa-vault"></i> Orion Vault
                </wa-button>
                <wa-button href="/projects/stardust-engine-cms" variant="neutral" size="large" class="wa-font-bold wa-text-uppercase">
                    <i slot="start" class="fa-brands fa-rocket-launch"></i> Core CMS
                </wa-button>
            </div>
        </div>
    </div>

</section>

<!-- AI Transparency Notice (Native WA Alert) -->
<wa-alert variant="neutral" open class="wa-margin-bottom-xl shadow-sm">
    <i slot="icon" class="fa-duotone fa-robot-astromech wa-font-size-2xl" style="color: var(--wa-color-brand-text);"></i>
    <div class="wa-font-bold wa-text-uppercase" style="letter-spacing: 1px;">Transparency Notice</div>
    <div class="wa-font-size-s wa-margin-top-2xs">
        RaggieSoft&trade; is a multimedia storytelling and world-building project. Certain music, artwork, and narrative elements across this network are created with the assistance of Artificial Intelligence. 
        <a href="/about/ai-disclaimer" style="color: var(--wa-color-brand-text); text-decoration: none; border-bottom: 1px solid currentColor;" class="wa-font-bold">Read the full AI Disclaimer.</a>
    </div>
</wa-alert>

<section id="network-spokes" aria-labelledby="spokes-title">
  
    <div class="wa-text-center wa-padding-bottom-m wa-margin-bottom-xl wa-padding-inline-l" style="border-bottom: 1px solid var(--wa-color-neutral-border-quiet);">
        <h2 id="spokes-title" class="wa-font-size-xl wa-font-bold wa-text-uppercase" style="color: var(--wa-color-neutral-text-quiet); letter-spacing: 1px;">
            <i class="fa-duotone fa-network-wired wa-margin-right-2xs"></i> Active Modules
        </h2>
    </div>

    <div class="horizontal-scroll-wrapper">
      
      <!-- Card 1: CMS -->
      <wa-card class="scroll-card shadow-glow">
        <img slot="image" src="https://assets.raggiesoft.com/raggiesoft-corporate/images/logos/logo-michael.png" alt="Stardust Engine CMS">
        <div class="wa-font-bold wa-font-size-l wa-margin-bottom-xs">Stardust Engine CMS</div>
        <div class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet);">
            The primary, database-free architecture driving the global routing network. Built entirely in native PHP.
        </div>
        <div slot="footer">
            <wa-button href="/projects/stardust-engine-cms" variant="brand" style="width: 100%;">
                <i slot="start" class="fa-duotone fa-server"></i> Inspect Architecture
            </wa-button>
        </div>
      </wa-card>

      <!-- Card 2: Narratives -->
      <wa-card class="scroll-card shadow-glow">
        <img slot="image" src="https://assets.raggiesoft.com/raggiesoft-books/images/logos/oceanview-archives.svg" alt="Ocean View Archives" class="theme-invert">
        <div class="wa-font-bold wa-font-size-l wa-margin-bottom-xs">Narratives Archive</div>
        <div class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet);">
            Expansive, multi-generational fictional narratives, character profiles, and lore documentation.
        </div>
        <div slot="footer">
            <wa-button href="/projects/narratives" variant="warning" style="width: 100%;">
                <i slot="start" class="fa-duotone fa-books"></i> Open Archives
            </wa-button>
        </div>
      </wa-card>    

      <!-- Card 3: UI Sandbox -->
      <wa-card class="scroll-card shadow-glow">
        <div slot="image" class="wa-flex wa-align-center wa-justify-center" style="height: 120px;">
            <i class="fa-duotone fa-brush wa-font-size-4xl" style="color: var(--wa-color-success-text);"></i>
        </div>
        <div class="wa-font-bold wa-font-size-l wa-margin-bottom-xs">UI Sandbox</div>
        <div class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet);">
            Developing Web Awesome components and testing custom aesthetics (including Dark Aero themes).
        </div>
        <div slot="footer">
            <wa-button href="/sandbox" variant="success" style="width: 100%;">
                <i slot="start" class="fa-duotone fa-flask"></i> Enter Sandbox
            </wa-button>
        </div>
      </wa-card>

       <!-- Card 4: The Hub -->
       <wa-card class="scroll-card shadow-glow">
        <img slot="image" src="https://assets.raggiesoft.com/family/images/logos/logo-family.png" alt="RaggieSoft Hub">
        <div class="wa-font-bold wa-font-size-l wa-margin-bottom-xs">RaggieSoft Hub</div>
        <div class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet);">
            The main staging ground and deployment interface managed through Git Bash and automated syncs.
        </div>
        <div slot="footer">
            <wa-button href="/projects/hub" variant="info" style="width: 100%;">
                <i slot="start" class="fa-duotone fa-network-wired"></i> View Hub
            </wa-button>
        </div>
      </wa-card>

    </div>

</section>