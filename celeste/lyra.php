<?php
ob_start(); 
// RaggieSoft Lyra Router v1.0 (Web Awesome Edition)
// Intelligent Routing & Orion Vault Integration

define('ROOT_PATH', dirname(__DIR__));
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalize trailing slashes
if (strlen($request_uri) > 1) {
    $request_uri = rtrim($request_uri, '/');
}

// --- 1. CONNECT TO ORION VAULT ---
$orionVault = '/var/www/nebulae-secrets/orion.php';

if (file_exists($orionVault)) {
    $secrets = require $orionVault;
} else {
    // Failsafe: Do not render the page if the vault is missing
    die("<h1>System Error</h1><p>Critical systems offline. Orion Vault could not be reached.</p>");
}

$faKit = htmlspecialchars($secrets['FA_KIT_CODE'] ?? '');
$waKit = htmlspecialchars($secrets['WA_KIT_ID'] ?? '');
$googleTag = htmlspecialchars($secrets['GOOGLE_TAG_ID'] ?? '');

// --- 2. LOAD GLOBAL SETTINGS ---
$settingsFile = ROOT_PATH . '/data/settings.json';

if (file_exists($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Critical Error: Invalid JSON in settings.json');
    }
} else {
    // Fallback if settings aren't built yet
    $settings = [
        'siteName' => 'Nebulae Incubator',
        'defaultTheme' => 'dark-aero', 
        'defaults' => []
    ];
}

$siteName = $settings['siteName'];
$defaultTheme = $settings['defaultTheme'];

// Build Defaults Array
$defaults = array_merge($settings['defaults'], [
    'title' => $siteName, 
    'theme' => $defaultTheme,
]);

// --- 3. LOAD & MERGE ROUTE FILES (RECURSIVE) ---
$masterRoutes = [];
$routesDir = ROOT_PATH . '/data/routes';

if (is_dir($routesDir)) {
    $directory = new RecursiveDirectoryIterator($routesDir);
    $iterator = new RecursiveIteratorIterator($directory);
    $regex = new RegexIterator($iterator, '/^.+\.json$/i', RecursiveRegexIterator::GET_MATCH);

    foreach ($regex as $file) {
        $jsonContent = file_get_contents($file[0]);
        $fileData = json_decode($jsonContent, true);

        // Log JSON errors so they aren't silent
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Lyra Error: Invalid JSON in " . basename($file[0]) . " - " . json_last_error_msg());
            continue; 
        }

        if (is_array($fileData)) {
            // INHERITANCE LOGIC (The "DRY" Fix)
            if (isset($fileData['common'])) {
                $commonConfig = $fileData['common'];
                unset($fileData['common']);

                foreach ($fileData as $routeKey => $routeConfig) {
                    $fileData[$routeKey] = array_merge($commonConfig, $routeConfig);
                }
            }
            $masterRoutes = array_merge($masterRoutes, $fileData);
        }
    }
}

// --- HELPER: RESOLVE ASSET INHERITANCE ---
function resolveAsset($map, $currentUri) {
    $path = rtrim(parse_url($currentUri, PHP_URL_PATH), '/');
    while ($path !== '' && $path !== '.' && $path !== '/') {
        if (isset($map[$path])) return $map[$path];
        $path = dirname($path);
        $path = str_replace('\\', '/', $path);
    }
    if (isset($map['/'])) return $map['/'];
    return null;
}

// --- 4. SMART ROUTER LOGIC ---

// A. Check for Explicit Configuration
$pageConfig = $masterRoutes[$request_uri] ?? [];

// B. Auto-Discovery Logic
if (!isset($pageConfig['view'])) {
    $potentialPath = 'pages' . $request_uri;
    if (file_exists(ROOT_PATH . '/' . $potentialPath . '.php')) {
        $pageConfig['view'] = $potentialPath;
    } elseif (is_dir(ROOT_PATH . '/' . $potentialPath)) {
        if (file_exists(ROOT_PATH . '/' . $potentialPath . '/overview.php')) {
            $pageConfig['view'] = $potentialPath . '/overview';
            $isIndexPage = true;
        } elseif (file_exists(ROOT_PATH . '/' . $potentialPath . '/home.php')) {
            $pageConfig['view'] = $potentialPath . '/home';
            $isIndexPage = true;
        }
    }
}

// C. Sidebar Intelligence
if (isset($pageConfig['view'])) {
    $sidebarMap = $settings['sidebarMap'] ?? [];
    
    if (!isset($pageConfig['sidebar'])) {
        $resolvedSidebar = resolveAsset($sidebarMap, $request_uri);
        if ($resolvedSidebar) $pageConfig['sidebar'] = $resolvedSidebar;
    }

    if (!isset($pageConfig['showSidebar'])) {
        if (isset($pageConfig['sidebar']) && $pageConfig['sidebar'] !== 'sidebar-default') {
             $pageConfig['showSidebar'] = true;
        } elseif (isset($isIndexPage) && $isIndexPage) {
            $pageConfig['showSidebar'] = false;
        }
    }

    // Auto-Title
    if (!isset($pageConfig['title'])) {
        $slug = basename($request_uri);
        $pageConfig['title'] = ($slug === '' || $slug === 'index.php') ? 'Home - ' . $siteName : ucwords(str_replace('-', ' ', $slug)) . ' - ' . $siteName;
    }
}

// --- 5. RENDER WEB AWESOME UI ---
$config = array_merge($defaults, $pageConfig);

if (isset($config['view'])) {
    if ($config['view'] === 'errors/500') {
        http_response_code(500);
    } elseif ($config['view'] === 'errors/404') {
        http_response_code(404);
    }
}

// Extract variables for View
$pageTitle = $config['title'] ?? 'Nebulae Incubator';
$showSidebar = $config['showSidebar'] ?? true;

// HEADER RESOLUTION
$headerMap = $settings['headerMap'] ?? [];
$headerFile = resolveAsset($headerMap, $request_uri) ?? 'header-default';
$currentHeaderMenu = ROOT_PATH . '/includes/components/headers/' . $headerFile . '.php';

// SIDEBAR RESOLUTION
$currentSidebar = '';
if (isset($config['sidebar'])) {
    $currentSidebar = ROOT_PATH . '/includes/components/sidebars/' . $config['sidebar'] . '.php';
}

?>
<!DOCTYPE html>
<html lang="en" data-fa-kit-code="<?= $faKit ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    
    <!-- Theme + color palette -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/themes/default.css">
    <!-- Utility classes ("CSS Utilities") -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/utilities.css">
    <!-- CSS reset ("Native Styles") -->
    <link rel="stylesheet" href="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/styles/native.css">
    <!-- Web Awesome autoloader -->
    <script type="module" src="https://ka-p.webawesome.com/kit/<?= $waKit ?>/webawesome@3.10.0/webawesome.loader.js"></script>
    
    <style>
        /* Base styles bridging Web Awesome into the view */
        body {
            background-color: var(--wa-color-neutral-subtlest);
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <wa-page>
        <!-- HEADER REGION -->
        <div slot="header">
            <?php
            if (file_exists($currentHeaderMenu)) {
                require_once $currentHeaderMenu;
            } else {
                echo '<header class="wa-padding-m"><h2>Nebulae Incubator</h2></header>';
            }
            ?>
        </div>

        <!-- SIDEBAR / MENU REGION -->
        <?php if ($showSidebar && file_exists($currentSidebar)): ?>
        <div slot="menu" class="wa-padding-s border-end">
            <?php require_once $currentSidebar; ?>
        </div>
        <?php endif; ?>

        <!-- MAIN CONTENT REGION -->
        <div class="wa-padding-l">
            <?php
            if (isset($config['view']) && file_exists(ROOT_PATH . '/' . $config['view'] . '.php')) {
                require_once ROOT_PATH . '/' . $config['view'] . '.php';
            } else {
                http_response_code(404);
                if (file_exists(ROOT_PATH . '/pages/errors/404.php')) {
                    require_once ROOT_PATH . '/pages/errors/404.php';
                } else {
                    echo "<h1>404 Not Found</h1><p>The requested trajectory could not be plotted.</p>";
                }
            }
            ?>
        </div>

        <!-- FOOTER REGION -->
        <?php 
        $footerFile = ROOT_PATH . '/includes/footer.php';
        if (file_exists($footerFile)): 
        ?>
        <div slot="footer">
            <?php require_once $footerFile; ?>
        </div>
        <?php endif; ?>
    </wa-page>
</body>
</html>
<?php
ob_end_flush();
?>