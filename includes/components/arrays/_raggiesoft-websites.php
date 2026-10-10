<?php
/**
 * ARCHITECTURE & PURPOSE:
 * This file acts as the central source of truth for the RaggieSoft Network navigation.
 * It defines an array of interconnected sites within the RaggieSoft ecosystem, 
 * which can be iterated over to generate network navigation menus or footers.
 *
 * MAINTENANCE NOTES:
 * - Data structure includes a key (slug), title, absolute URL, FontAwesome icon class, and a brief description.
 * - If you update an icon, ensure the chosen FontAwesome class (e.g., 'fa-duotone') is loaded by the consuming site.
 * - Add new sub-sites here to have them automatically appear in any network cross-linking components.
 */
// /includes/components/arrays/_raggiesoft-websites.php
// Central source of truth for the RaggieSoft Network navigation.

// Define the core network properties. Each key serves as a unique identifier.
$raggiesoftSites = [
    'network_home' => [
        'title' => 'RaggieSoft.com',
        'url' => 'https://raggiesoft.com/',
        'icon' => 'fa-duotone fa-layer-group',
        'description' => 'The Main Hub'
    ],
    'stardust' => [
        'title' => 'The Stardust Engine',
        'url' => 'https://thestardustengine.com/',
        'icon' => 'fa-duotone fa-rocket-launch',
        'description' => 'Fictional 80s Synth-Rock Band'
    ],
    'knox' => [
        'title' => 'Project: KNOX',
        'url' => 'https://raggiesoftknox.com/',
        'icon' => 'fa-duotone fa-leaf', // Or fa-leaf depending on the vibe
        'description' => 'Sci-Fi Narrative Universe'
    ],
    'portfolio' => [
        'title' => 'MichaelPRagsdale.com',
        'url' => 'https://michaelpragsdale.com/',
        'icon' => 'fa-duotone fa-briefcase',
        'description' => 'Digital Portfolio & Resume'
    ]
];
?>