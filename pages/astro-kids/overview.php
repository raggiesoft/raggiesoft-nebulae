<?php
// pages/astro-kids/overview.php
// The Starling Family Landing Page
// Web Awesome Edition

$pageTitle = "The Starling Family | Nebulae Incubator";
?>

<style>
    /* --- Astro-Kids Landing Page Styles --- */
    
    .astro-hero {
        position: relative;
        border-radius: var(--wa-border-radius-l);
        overflow: hidden;
        padding: var(--wa-space-3xl) var(--wa-space-xl);
        margin-bottom: var(--wa-space-xl);
        border: 1px solid var(--wa-color-neutral-border-quiet);
        background-color: var(--wa-color-surface-sunken);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        min-height: 40vh;
        justify-content: center;
    }
    
    .astro-hero-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        /* Utilizing the Stardust Nebula asset to match the cosmic theme */
        background-image: url('https://assets.raggiesoft.com/stardust-engine/images/stardust-nebula.jpg');
        background-size: cover;
        background-position: center;
        opacity: 0.3;
        z-index: 0;
        mix-blend-mode: screen;
    }
    
    .astro-hero-content {
        position: relative;
        z-index: 1;
    }
    
    .character-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--wa-space-l);
        margin-bottom: var(--wa-space-2xl);
    }
    
    .char-card {
        --wa-card-border-radius: var(--wa-border-radius-l);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: var(--wa-color-surface-default);
    }
    
    .char-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    }
    
    .char-card::part(base) {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .char-card::part(body) {
        flex-grow: 1;
        padding: var(--wa-space-l);
    }
    
    .char-header {
        display: flex;
        align-items: center;
        gap: var(--wa-space-m);
        margin-bottom: var(--wa-space-m);
        padding-bottom: var(--wa-space-s);
        border-bottom: 1px solid var(--wa-color-neutral-border-quiet);
    }
    
    .char-icon {
        font-size: 2.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background-color: var(--wa-color-surface-sunken);
        border: 2px solid;
        flex-shrink: 0;
    }
    
    .lore-section {
        background-color: var(--wa-color-surface-sunken);
        border: 1px solid var(--wa-color-neutral-border-quiet);
        border-radius: var(--wa-border-radius-l);
        padding: var(--wa-space-xl);
        margin-bottom: var(--wa-space-xl);
    }
</style>

<div class="astro-hero shadow-glow">
    <div class="astro-hero-bg"></div>
    <div class="astro-hero-content">
        <h1 class="wa-font-size-4xl wa-font-bold wa-text-uppercase brand-font wa-margin-bottom-xs" style="text-shadow: 0 4px 15px rgba(0,0,0,0.9); color: var(--wa-color-text-default);">
            The Starling Quad
        </h1>
        <h2 class="wa-font-size-l wa-font-light wa-text-uppercase wa-margin-bottom-l" style="color: var(--wa-color-brand-text); letter-spacing: 2px; text-shadow: 0 2px 8px rgba(0,0,0,0.8);">
            Bound by Gravity. Forged in the Cosmos.
        </h2>
        <p class="wa-font-size-m" style="max-width: 750px; color: rgba(255,255,255,0.85); line-height: 1.6; margin: 0 auto;">
            A fiercely devoted family unit navigating the shift from scraping by in a mountain cabin to managing a $2.4 billion legacy, communicating effortlessly through a symphony of non-verbal frequencies.
        </p>
    </div>
</div>

<!-- Character Profiles Grid -->
<div class="character-grid">

    <!-- Valerie (The Anchor) -->
    <wa-card class="char-card shadow-glow">
        <div class="char-header">
            <div class="char-icon" style="color: var(--wa-color-primary-text); border-color: var(--wa-color-primary-border);">
                <i class="fa-duotone fa-anchor"></i>
            </div>
            <div>
                <h3 class="wa-font-size-xl wa-font-bold wa-margin-0 brand-font">Valerie</h3>
                <div class="wa-font-size-s wa-text-uppercase wa-font-bold" style="color: var(--wa-color-primary-text); letter-spacing: 1px;">The Anchor</div>
            </div>
        </div>
        
        <div class="wa-flex wa-gap-2xs wa-flex-wrap wa-margin-bottom-m">
            <wa-badge variant="neutral" pill>Age 22</wa-badge>
            <wa-badge variant="primary" pill>Legal Proxy & Caregiver</wa-badge>
            <wa-badge variant="neutral" pill>Neurotypical</wa-badge>
        </div>
        
        <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
            The pragmatic, sharp-eyed eldest cousin who stepped in when the triplets were abandoned. She speaks their non-verbal physical and vocal language fluently, transforming from a quiet protector in thrift-store flannels into a relentless force against hostile bureaucracy.
        </p>
    </wa-card>
    
    <!-- Lyra (The Architect) -->
    <wa-card class="char-card shadow-glow">
        <div class="char-header">
            <div class="char-icon" style="color: var(--wa-color-success-text); border-color: var(--wa-color-success-border);">
                <i class="fa-duotone fa-compass-drafting"></i>
            </div>
            <div>
                <h3 class="wa-font-size-xl wa-font-bold wa-margin-0 brand-font">Lyra</h3>
                <div class="wa-font-size-s wa-text-uppercase wa-font-bold" style="color: var(--wa-color-success-text); letter-spacing: 1px;">The Architect</div>
            </div>
        </div>
        
        <div class="wa-flex wa-gap-2xs wa-flex-wrap wa-margin-bottom-m">
            <wa-badge variant="neutral" pill>Age 18 (Eldest)</wa-badge>
            <wa-badge variant="success" pill>Autistic</wa-badge>
            <wa-badge variant="warning" pill>Ambulatory CP</wa-badge>
        </div>
        
        <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
            Fiercely protective and hyper-vigilant, Lyra channels her passion into structural organization and star charts. Communicating through sharp, staccato hums and rhythmic clicks, she uses her limited mobility to direct transfers and physically brace her brother during transit.
        </p>
    </wa-card>
    
    <!-- Orion (The Core) -->
    <wa-card class="char-card shadow-glow">
        <div class="char-header">
            <div class="char-icon" style="color: var(--wa-color-warning-text); border-color: var(--wa-color-warning-border);">
                <i class="fa-duotone fa-planet-ringed"></i>
            </div>
            <div>
                <h3 class="wa-font-size-xl wa-font-bold wa-margin-0 brand-font">Orion</h3>
                <div class="wa-font-size-s wa-text-uppercase wa-font-bold" style="color: var(--wa-color-warning-text); letter-spacing: 1px;">The Core</div>
            </div>
        </div>
        
        <div class="wa-flex wa-gap-2xs wa-flex-wrap wa-margin-bottom-m">
            <wa-badge variant="neutral" pill>Age 18 (Middle)</wa-badge>
            <wa-badge variant="success" pill>Autistic</wa-badge>
            <wa-badge variant="danger" pill>Full-time Wheelchair</wa-badge>
        </div>
        
        <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
            The quiet, deeply analytical center of gravity for the family. Reliant on a specialized liquid diet and his sisters for physical positioning, his steady, resonant chest rumbles provide the acoustic foundation that regulates the household’s emotional baseline.
        </p>
    </wa-card>
    
    <!-- Celeste (The Symphony) -->
    <wa-card class="char-card shadow-glow">
        <div class="char-header">
            <div class="char-icon" style="color: var(--wa-color-info-text); border-color: var(--wa-color-info-border);">
                <i class="fa-duotone fa-waveform-lines"></i>
            </div>
            <div>
                <h3 class="wa-font-size-xl wa-font-bold wa-margin-0 brand-font">Celeste</h3>
                <div class="wa-font-size-s wa-text-uppercase wa-font-bold" style="color: var(--wa-color-info-text); letter-spacing: 1px;">The Symphony</div>
            </div>
        </div>
        
        <div class="wa-flex wa-gap-2xs wa-flex-wrap wa-margin-bottom-m">
            <wa-badge variant="neutral" pill>Age 18 (Youngest)</wa-badge>
            <wa-badge variant="success" pill>Autistic</wa-badge>
            <wa-badge variant="danger" pill>Full-time Wheelchair</wa-badge>
        </div>
        
        <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
            Deeply intuitive and constantly attuned to environmental shifts. Celeste processes the world through fluid, melodic pitches. She frequently neutralizes sensory triggers—like the sound of the kitchenette blender—by harmonizing with the mechanical noise, turning stress into a shared ritual.
        </p>
    </wa-card>

</div>

<!-- Shared Dynamics / World Lore -->
<div class="lore-section shadow-glow">
    <h2 class="wa-font-size-2xl wa-font-bold wa-text-uppercase brand-font wa-margin-bottom-m" style="border-bottom: 1px solid var(--wa-color-neutral-border-quiet); padding-bottom: var(--wa-space-s);">
        <i class="fa-duotone fa-users-viewfinder wa-margin-right-2xs" style="color: var(--wa-color-brand-text);"></i> Shared Dynamics
    </h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--wa-space-l);">
        
        <div>
            <h4 class="wa-font-bold wa-margin-bottom-xs" style="color: var(--wa-color-text-default);">
                <i class="fa-duotone fa-bed-front wa-margin-right-2xs" style="color: var(--wa-color-primary-text);"></i> The Quad Bond
            </h4>
            <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
                Operating as an indivisible unit, the four completely reject the concept of separate bedrooms. They share a massive, custom <strong>Alaska King mattress</strong> placed directly on the floor of the master suite. Frequent three- and four-way cuddles serve as their primary method for deep-pressure therapy and emotional grounding.
            </p>
        </div>
        
        <div>
            <h4 class="wa-font-bold wa-margin-bottom-xs" style="color: var(--wa-color-text-default);">
                <i class="fa-duotone fa-tower-broadcast wa-margin-right-2xs" style="color: var(--wa-color-info-text);"></i> A Non-Verbal Ecosystem
            </h4>
            <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
                Without the need for traditional AAC devices within the home, they have cultivated a seamless auditory language. Lyra provides the staccato rhythm, Celeste carries the sweeping melodic harmonies, and Orion sustains the deep acoustic bass—all of which Valerie translates and responds to with flawless intuition.
            </p>
        </div>
        
        <div>
            <h4 class="wa-font-bold wa-margin-bottom-xs" style="color: var(--wa-color-text-default);">
                <i class="fa-duotone fa-file-invoice-dollar wa-margin-right-2xs" style="color: var(--wa-color-warning-text);"></i> The Financial Reality
            </h4>
            <p class="wa-font-size-s" style="color: var(--wa-color-neutral-text-quiet); line-height: 1.6;">
                The triplets are equal co-heirs to a <strong>$2.4+ billion</strong> Texas oil royalty trust originating from their great-grandfather. After surviving years of grueling poverty on Medicaid and SNAP benefits in a cabin near Big Island, VA, the family is currently navigating the extreme culture shock of boundless financial freedom.
            </p>
        </div>
        
    </div>
</div>