<?php
/**
 * ============================================================================
 * ARCHITECTURAL OVERVIEW: EXOPLANET ARCHIVE BRIDGE
 * ============================================================================
 * 
 * This utility acts as a bridge to the NASA Exoplanet Archive API (TAP Sync). 
 * It handles the execution of remote SQL queries against planetary data tables, 
 * processes distance metrics, and converts Parsecs into Light Years.
 * 
 * MAINTENANCE NOTES:
 * - Relies on the public Caltech/NASA TAP API endpoint. Ensure it is accessible
 *   and keep the timeout short to prevent the host site from stalling if the 
 *   endpoint goes down.
 * ============================================================================
 */
// includes/utils/nasa-bridge.php

function fetch_nasa_distance() {
    // 1. Define the Stars we want to check (adding more is easy)
    $targets = "'Kepler-452 b', 'Proxima Cen b', 'TRAPPIST-1 e', 'Kepler-186 f'";
    
    // 2. Build the API Query
    // 'ps' = Planetary Systems table
    // 'sy_dist' = System Distance in Parsecs
    $query = "select pl_name, sy_dist from ps where pl_name in ($targets)";
    $url = "https://exoplanetarchive.ipac.caltech.edu/TAP/sync?query=" . urlencode($query) . "&format=json";

    // 3. Fetch Data (with a timeout so your site doesn't hang if NASA is down)
    $context = stream_context_create(['http' => ['timeout' => 3]]);
    $json = @file_get_contents($url, false, $context);

    if ($json === false) return [];

    $data = json_decode($json, true);
    
    // 4. Process & Convert (The Physics Part)
    $results = [];
    foreach ($data as $star) {
        $parsecs = floatval($star['sy_dist']);
        $lightYears = $parsecs * 3.26156; // High-precision conversion
        
        $results[] = [
            'name' => $star['pl_name'],
            'distance_pc' => round($parsecs, 2),
            'distance_ly' => round($lightYears, 2),
            'round_trip_time' => round($lightYears * 2) // Signal there + Signal back
        ];
    }
    
    return $results;
}
?>