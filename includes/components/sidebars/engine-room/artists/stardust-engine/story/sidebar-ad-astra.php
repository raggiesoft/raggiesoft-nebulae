<?php
/**
 * ARCHITECTURE: Ad Astra Sidebar Navigation
 * 
 * A static sidebar component for the 'Ad Astra' mission logs.
 * 
 * COMPONENTS:
 * 1. Sticky Navigation Menu: A list-group containing static anchor links 
 *    to different sections of the page.
 * 2. Visual Enhancements: Utilizes specific CSS variables (e.g., --astra-warning)
 *    to theme the icons according to the Stardust Engine aesthetic.
 */
?>
<div class="mb-3">
    <h6 class="text-uppercase fw-bold  small mb-2">Detailed Logs</h6>
    <!-- STATIC NAVIGATION LINKS -->
    <!-- Anchor links to page sections. CSS classes determine the visual state. -->
    <div class="list-group list-group-flush border-start border-secondary ps-2">
        <a href="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-01" class="list-group-item list-group-item-action bg-transparent py-1 border-0 text-uppercase small" style="color: var(--astra-warning);">
            Day 01: Ignition
        </a>
        <a href="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-02" class="list-group-item list-group-item-action bg-transparent py-1 border-0 text-uppercase small" style="color: var(--astra-success);">
            Day 02: Stabilization
        </a>
        <a href="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-03" class="list-group-item list-group-item-action bg-transparent py-1 border-0 text-uppercase small" style="color: var(--astra-text);">
            Day 03: Ship's Time
        </a>
        <a href="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-10" class="list-group-item list-group-item-action bg-transparent py-1 border-0 text-uppercase small" style="color: var(--astra-info);">
            Day 10: The Drift
        </a>
        <a href="/engine-room/artists/stardust-engine/story/ad-astra/voyage/day-21" class="list-group-item list-group-item-action bg-transparent py-1 border-0 text-uppercase small" style="color: var(--astra-danger);">
            Day 21: The Drop
        </a>
    </div>
</div>