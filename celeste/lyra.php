<?php
// celeste/lyra.php - Primary Router

// Reach up into the Vault to securely grab Orion's secrets
$orionVault = '/var/www/nebulae-secrets/orion.php';

if (file_exists($orionVault)) {
    $secrets = require $orionVault;
} else {
    // Failsafe: Do not render the page if the vault is missing
    die("<h1>System Error</h1><p>Critical systems offline. Orion could not be reached.</p>");
}

$faKit = htmlspecialchars($secrets['FA_KIT_CODE']);
$waKit = htmlspecialchars($secrets['WA_KIT_ID']);
?>
<!DOCTYPE html>
<html lang="en" data-fa-kit-code="<?= $faKit ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nebulae Incubator</title>
    
    <!-- Theme + color palette -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/themes/default.css">
    <!-- Utility classes ("CSS Utilities") -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/utilities.css">
    <!-- CSS reset ("Native Styles") -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/native.css">
    <!-- Web Awesome autoloader -->
    <script type="module" src="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/webawesome.loader.js"></script>
    
    <style>
        body {
            background-color: var(--wa-color-neutral-subtlest);
        }
    </style>
</head>
<body>
    <wa-page>
        <div slot="header" class="wa-padding-m">
            <h2>raggiesoft-nebulae</h2>
        </div>
        
        <div slot="menu" class="wa-padding-m">
            <p>Navigation Module</p>
        </div>

        <div class="wa-padding-l">
            <h1>Mission Control Online.</h1>
            <p>Routing through Celeste & Lyra confirmed. Orion Vault active.</p>
        </div>
    </wa-page>
</body>
</html>