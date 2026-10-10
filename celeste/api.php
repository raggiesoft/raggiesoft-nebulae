<?php
/**
 * ARCHITECTURE & MAINTENANCE (LEGACY)
 *
 * This file acts as the primary API endpoint (Headless CMS Gatekeeper) for the Celeste subsystem, serving JSON data from static files.
 * 
 * DESIGN INTENT:
 * - Employs a "Ghost Protocol" to deflect direct human/browser access, redirecting them to a visual 404 page, while strictly serving JSON to API consumers.
 * - Uses `RecursiveDirectoryIterator` to perform deep searches within the `/data/routes` directory, allowing nested routing without complex database structures.
 * 
 * MAINTENANCE NOTES:
 * - Security relies on a strict allow-list (`$allowed_zones`). Any new data folders must be explicitly added here to prevent path traversal attacks.
 * - The recursive search is O(N) based on file count. If the `data/routes` directory grows exponentially, this may become a performance bottleneck requiring caching.
 * - Ensure file permissions on the `data/` directory are read-only for the web user.
 */
// celeste/api.php
// The Headless CMS Gatekeeper (Recursive Edition v2)
// Updated: Case-Insensitive Search & Auto-Extension Stripping

// 1. GHOST PROTOCOL: Handling Direct Access
// We check if the request is missing the required "keys" (zone/file)
// LEGACY SECURITY GATE: Validates presence of required parameters before any further processing or disk access.
if (empty($_GET['zone']) || empty($_GET['file'])) {
    
    // A. Is this a Human? (Browser requesting HTML)
    // If so, redirect them to the visual "Signal Lost" page.
    if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'text/html') !== false) {
        http_response_code(404);
        header("Location: /signal-lost"); 
        exit;
    }

    // B. Is this a Bot/App? (Expecting JSON)
    // Give them a strict, unhelpful 404.
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode([
        'error' => 'Uplink connection refused.',
        'code' => 404
    ]);
    exit;
}

// --- If we survive the check, proceed as normal ---
header('Content-Type: application/json');

// Define Root relative to this file (assuming /celeste/api.php)
define('ROOT_PATH', dirname(__DIR__));

// 1. SECURITY: Strict Allow-List
$allowed_zones = ['routes', 'settings'];

// 2. INPUT VALIDATION
$zone = $_GET['zone'] ?? ''; 
$file = $_GET['file'] ?? ''; 

if (!in_array($zone, $allowed_zones)) {
    http_response_code(403);
    echo json_encode(['error' => 'Restricted Data Zone']);
    exit;
}

// TWEAK 1: Extension & Path Sanitization
// basename($file, '.json') will strip '.json' IF it exists, 
// but leave the string alone if it's already just a slug.
$safeFileSlug = basename($file, '.json'); 

// 3. RECURSIVE SEARCH LOGIC
$targetPath = '';

if ($zone === 'settings') {
    // Settings is a fixed location
    $targetPath = ROOT_PATH . '/data/settings.json';
} 
elseif ($zone === 'routes') {
    // We start at /data/routes and drill down into ALL subfolders
    // LEGACY SEARCH ALGORITHM: Instantiates a deep traversal iterator to find matching JSON slugs regardless of directory depth.
    $directory = new RecursiveDirectoryIterator(ROOT_PATH . '/data/routes');
    $iterator = new RecursiveIteratorIterator($directory);
    
    // We look for any file that matches "slug.json"
    foreach ($iterator as $info) {
        // TWEAK 2: Case-Insensitive Comparison
        // strcasecmp returns 0 if strings match regardless of case.
        // This handles "Aethel.json" on disk vs "aethel" in request.
        if ($info->isFile() && strcasecmp($info->getFilename(), $safeFileSlug . '.json') === 0) {
            $targetPath = $info->getPathname();
            break; // Found it! Stop searching.
        }
    }
}

// 4. SERVE CONTENT
if ($targetPath && file_exists($targetPath)) {
    // Success: We found the file
    readfile($targetPath);
} else {
    http_response_code(404);
    echo json_encode([
        'error' => 'Resource not found',
        'searched_for' => $safeFileSlug
    ]);
}