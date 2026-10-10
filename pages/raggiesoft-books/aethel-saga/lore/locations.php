<?php
/**
 * AETHEL SAGA LORE: LOCATIONS
 * 
 * ARCHITECTURAL CONTEXT:
 * This file renders the fantasy locations for "The Silver Gauntlet of Aethel" lore.
 * It is part of the raggiesoft-books/aethel-saga subdirectory and leverages
 * a custom fantasy/tome aesthetic (`aethel-theme`).
 *
 * KEY FEATURES:
 * - Thematic Styling: Uses the `aethel-theme` and `tome-container` classes
 *   to provide a parchment/fantasy look.
 * - Typography: Utilizes the `cinzel-font` class for stylized, cinematic headers.
 * - Responsive Layout: Employs Bootstrap grids (e.g., `col-md-12`) to structure
 *   the lore entries.
 *
 * MAINTENANCE NOTES:
 * - Make sure that breadcrumb links accurately reflect the directory structure.
 * - If new locations are added, replicate the existing card structures for consistency.
 */
$pageTitle = "Lore: The Realms of Aethel";
?>

<div class="aethel-theme min-vh-100 py-5">
    <div class="container tome-container">
        
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/raggiesoft-books/aethel-saga" class="text-warning text-decoration-none">Aethel Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Locations</li>
            </ol>
        </nav>

        <h1 class="display-4 mb-5 cinzel-font border-bottom border-warning pb-3 d-inline-block">Locations of Aethel</h1>

        <div class="row g-5 mb-5">
            <!-- Sunstead -->
            <div class="col-md-12">
                <div class="card bg-transparent border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-5 mb-4 mb-lg-0">
                                <img src="<?php echo $cdnBaseUrl; ?>/aethel/images/sunstead-village.jpg" class="img-fluid rounded shadow-lg border border-secondary border-opacity-50" alt="The Village of Sunstead">
                            </div>
                            <div class="col-lg-7">
                                <h2 class="h2 text-warning mb-2 cinzel-font">Sunstead</h2>
                                <h5 class="text-muted fst-italic mb-4">"The Independent Crossroads"</h5>
                                <p class="fs-5">
                                    The village of Sunstead bows to no king. It happens to be situated precisely at the crossroads of a couple of major trade routes, making it a bustling and critical waypoint for merchants, wanderers, and adventurers. 
                                </p>
                                <p class="fs-5">
                                    It is a great spot for weary travelers to rest their feet, swap rumors of the encroaching Gloom, and spend the night safely at the local Inn. Because of its constant influx of strangers and its fierce independence, it is the perfect hiding spot for two celestial twins to grow up unnoticed by Lord Malakor's spies.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 border-secondary opacity-25">

        <div class="row g-5 mb-5">
            <!-- The Twins' Hut -->
            <div class="col-md-12">
                <div class="card bg-transparent border border-warning border-opacity-50">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-7 mb-4 mb-lg-0">
                                <h3 class="h3 text-light mb-2 cinzel-font">The Twins' Hut</h3>
                                <h5 class="text-muted fst-italic mb-3">A Cramped Sanctuary</h5>
                                <p class="fs-5">
                                    Located on the outskirts of Sunstead, the Twins' Hut is a very small, remarkably modest dwelling. It is really only meant for one person. 
                                </p>
                                <p class="fs-5">
                                    Despite the cramped quarters, Kaelan and Kaela make it work. They are completely comfortable getting changed in front of each other and sharing the hut's single bed to sleep. This extreme closeness highlights not only their profound bond as twins, but their subconscious draw to one another as the literal avatars of the binary stars—two halves of a single celestial system forced into a tiny, singular orbit on earth.
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <img src="<?php echo $cdnBaseUrl; ?>/aethel/images/twins-hut.jpg" class="img-fluid rounded shadow-lg border border-warning border-opacity-25" alt="Inside The Twins' Hut">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 border-secondary opacity-25">

        <div class="row g-5 mb-5">
            <div class="col-md-12 text-center text-muted">
                <i class="ph ph-compass fa-3x mb-3 opacity-25"></i>
                <p class="fst-italic">More locations of the realm will be mapped here soon by the Cartographer...</p>
            </div>
        </div>

    </div>
</div>

