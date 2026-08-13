<?php
// includes/components/easter-eggs/konami.php
// A reusable "Loot Box" dialog triggered by the Konami Code.
// UPDATED: Web Awesome Native Edition

// 1. Set Defaults (Safety Net)
$k_title     = $konami_config['title']     ?? 'Secret Unlocked';
$k_icon      = $konami_config['icon']      ?? 'fa-duotone fa-unlock';
$k_theme     = $konami_config['theme']     ?? 'var(--wa-color-brand-fill-loud)'; 
$k_text_clr  = $konami_config['text_color']?? 'var(--wa-color-warning-text)'; 
$k_image     = $konami_config['image']     ?? '';
$k_body      = $konami_config['body']      ?? 'You have found a secret area.';
$k_btn_text  = $konami_config['btn_text']  ?? 'Proceed';
$k_btn_link  = $konami_config['btn_link']  ?? '#';
$k_btn_style = $konami_config['btn_style'] ?? 'brand'; // WA variant: brand, neutral, success, etc.
?>

<wa-dialog id="konamiDialog">
    <!-- Header / Label -->
    <span slot="label" style="color: <?php echo $k_text_clr; ?>;">
        <i class="<?php echo $k_icon; ?> wa-margin-right-2xs"></i> <?php echo $k_title; ?>
    </span>

    <!-- Body Content -->
    <div class="wa-text-center wa-padding-m">
        
        <?php if($k_image): ?>
        <img src="<?php echo $k_image; ?>" 
             alt="Secret Reward"
             style="max-height: 300px; border-radius: var(--wa-border-radius-m); border: 2px solid var(--wa-color-neutral-border);" 
             class="wa-margin-bottom-m shadow-glow">
        <?php endif; ?>
        
        <div style="color: var(--wa-color-neutral-text-quiet);">
            <?php echo $k_body; ?>
        </div>
        
    </div>

    <!-- Footer Action -->
    <div slot="footer">
        <wa-button href="<?php echo $k_btn_link; ?>" variant="<?php echo $k_btn_style; ?>" style="width: 100%;">
            <?php echo $k_btn_text; ?>
        </wa-button>
    </div>
</wa-dialog>

<!-- Native Vanilla JS Konami Listener -->
<script>
(function() {
    // The Sequence: Up, Up, Down, Down, Left, Right, Left, Right, B, A
    const konamiSequence = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a'];
    let konamiPosition = 0;
    
    document.addEventListener('keydown', function(event) {
        // Check if the pressed key matches the required sequence position
        if (event.key === konamiSequence[konamiPosition] || event.key === konamiSequence[konamiPosition].toUpperCase()) {
            konamiPosition++;
            
            // Sequence completed
            if (konamiPosition === konamiSequence.length) {
                const dialog = document.getElementById('konamiDialog');
                if (dialog) {
                    dialog.show(); // Trigger native WA Dialog
                }
                konamiPosition = 0; // Reset for future inputs
            }
        } else {
            // Sequence broken, reset position
            konamiPosition = 0;
        }
    });
})();
</script>