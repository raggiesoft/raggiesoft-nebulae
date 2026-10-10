<?php
/**
 * CASE STUDY: PHYS-100 ALIEN COMMUNICATION SIMULATOR
 * 
 * ARCHITECTURAL CONTEXT:
 * This file acts as an interactive simulation calculating round-trip communication
 * times to various exoplanets using data from the NASA Exoplanet Archive.
 *
 * KEY FEATURES:
 * - Data Integration: Utilizes `nasa-bridge.php` to fetch and parse external data.
 * - Dynamic Calculations: Computes the return year (`$replyYear`) and a 
 *   visual progress bar percentage based on distance in light-years.
 * - Live UI: Bootstrap list-groups and progress bars map data dynamically.
 *
 * MAINTENANCE NOTES:
 * - Dependency: `includes/utils/nasa-bridge.php` must exist and return an array 
 *   with keys `name`, `distance_ly`, and `round_trip_time`.
 * - The `$percent` calculation (100 / distance) is a simplified visual representation.
 *   Adjust the formula if a more accurate logarithmic scale is desired.
 */

// Include the bridge utility for external data access
include('includes/utils/nasa-bridge.php');

// Fetch the targeted exoplanet data array
$alienTargets = fetch_nasa_distance();

// Store the current year for dynamic time calculations
$currentYear = date("Y");
?>

<div class="card border-primary mb-4">
    <div class="card-header bg-primary text-white">
        Live Signal Simulation (Data Source: NASA Exoplanet Archive)
    </div>
    <div class="list-group list-group-flush">
        <?php foreach($alienTargets as $target): ?>
            <?php $replyYear = $currentYear + $target['round_trip_time']; ?>
            
            <div class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?php echo $target['name']; ?></h5>
                    <small class="text-muted"><?php echo $target['distance_ly']; ?> Light Years away</small>
                </div>
                <p class="mb-1">
                    If we broadcast "Hello" today, a reply cannot reach Earth until the year 
                    <strong><?php echo $replyYear; ?></strong>.
                </p>
                <div class="progress" style="height: 5px;">
                    <?php $percent = (100 / $target['distance_ly']) * 100; ?>
                    <div class="progress-bar bg-warning" role="progressbar" 
                         style="width: <?php echo $percent; ?>%"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>