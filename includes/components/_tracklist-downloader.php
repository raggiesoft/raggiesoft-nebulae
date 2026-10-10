<?php
/**
 * ARCHITECTURE: Tracklist Downloader Component
 * 
 * This robust component orchestrates the dynamic rendering of artist discographies,
 * lyrics retrieval, DSP stream mapping, and storefront integration based on
 * external JSON data files stored on the CDN.
 * 
 * COMPONENTS:
 * 1. Data Ingestion: Fetches tracks.json, album.json, and albums.json from the CDN.
 * 2. Schema Translation: Maps internal metadata attributes to Schema.org standards
 *    and human-readable formats (e.g., Narrative Era vs. DSP Release Date).
 * 3. DSP Integration: Evaluates DSP IDs to dynamically build or disable Spotify,
 *    Apple Music, Amazon, and YouTube links.
 * 4. UI Rendering: Generates tracklist UI, incorporating lore badges (Legacy Tiers),
 *    durations, and interactive play/lyrics/download buttons.
 * 5. JavaScript Interop: Dispatches a custom 'stardust:playlist-update' event to
 *    sync the client-side audio player with the rendered tracks.
 */

/**
 * COMPONENT: _tracklist-downloader.php
 * VERSION: 10.4 (Fourthwall Integration & Free Web Archive Routing)
 *
 * LICENSE:
 * The architecture and code of this file are licensed under the MIT License.
 * Copyright (c) 2026 Michael P. Ragsdale / RaggieSoft
 * The underlying narrative, lore, and music tracks delivered by this component 
 * are licensed under Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0),
 * except where commercial distribution exemptions apply (e.g., DSP streaming links).
 */

$base_web_path = $cdnBaseUrl . $album_path_web;
$tracks_json_url = $base_web_path . '/tracks.json?v=' . time();
$album_json_url = $base_web_path . '/album.json?v=' . time();

$tracks_json_content = @file_get_contents($tracks_json_url);
$album_json_content = @file_get_contents($album_json_url);

if ($tracks_json_content === false || $album_json_content === false) {
    echo '<div class="alert alert-danger"><strong>Error:</strong> Tracklist data not found on CDN.</div>';
    return;
}

$tracks_data = json_decode($tracks_json_content, true);
$album_data = json_decode($album_json_content, true);
$raw_tracks = $tracks_data['tracks'];

if (!function_exists('get_web_safe_title')) {
    function get_web_safe_title($title) {
        $title = strtolower($title);
        $title = preg_replace('/[^\w\s-]/', '', $title);
        $title = preg_replace('/[\s_]+/', '-', $title);
        return preg_replace('/-+/', '-', $title);
    }
}

if (!function_exists('get_archive_name')) {
    function get_archive_name($album_name, $year) {
        $safe_name = get_web_safe_title($album_name);
        return $year . '-' . $safe_name;
    }
}

// --- TIMELINE LOGIC (SCHEMA.ORG INTEGRATION) ---
// Extracts and transforms dates to support both the fictional universe timeline
// and the real-world copyright release parameters.
$narrative_date = !empty($album_data['temporalCoverage']) ? $album_data['temporalCoverage'] : '1900-01-01';
$real_release_date = !empty($album_data['datePublished']) ? $album_data['datePublished'] : 'TBA';

$narrative_year = substr($narrative_date, 0, 4);
$real_release_year = $real_release_date !== 'TBA' ? substr(trim($real_release_date), -4) : 'TBA';

$album_name = isset($album_data['name']) ? $album_data['name'] : 'Unknown Album';
$archive_base_name = get_archive_name($album_name, $narrative_year);

// Define the Artist Name for UI rendering, defaulting to the label
$display_artist = !empty($album_data['byArtist']['name']) ? $album_data['byArtist']['name'] : 'Engine Room Records';

// The Auto-Generated Free Archive ZIP Path
$free_archive_zip = $base_web_path . '/web-mp3/' . $archive_base_name . '-free-archive.zip';

// --- METADATA TRANSLATION (SCHEMA.ORG INTEGRATION) ---
// Maps raw JSON schema tags into friendly UI strings for release and production types.
$raw_release_type = isset($album_data['albumReleaseType']) ? basename($album_data['albumReleaseType']) : 'AlbumRelease';
$raw_production_type = isset($album_data['albumProductionType']) ? basename($album_data['albumProductionType']) : 'StudioAlbum';
$album_upc = !empty($album_data['gtin12']) ? $album_data['gtin12'] : (!empty($album_data['identifier']) ? $album_data['identifier'] : null);

$release_map = [
    'EPRelease' => 'EP',
    'SingleRelease' => 'Single',
    'BroadcastRelease' => 'Broadcast',
    'AlbumRelease' => 'Full Length'
];

$production_map = [
    'LiveAlbum' => 'Live Album',
    'CompilationAlbum' => 'Compilation',
    'SoundtrackAlbum' => 'Soundtrack',
    'MixtapeAlbum' => 'Mixtape',
    'RemixAlbum' => 'Remix Album',
    'StudioAlbum' => 'Studio Album'
];

$friendly_release = isset($release_map[$raw_release_type]) ? $release_map[$raw_release_type] : 'Full Length';
$friendly_production = isset($production_map[$raw_production_type]) ? $production_map[$raw_production_type] : 'Studio Album';

// --- DSP STREAMING IDS & STORE LINKS (SINGLE SOURCE OF TRUTH) ---
$stream_spotify_id = '';
$stream_apple_id   = '';
$stream_amazon_id  = '';
$stream_youtube_id = '';
$store_standard_url = '';
$store_audiophile_url = '';
$dsp_exempt = false;
$dsp_notice = '';

// --- ALBUM AGGREGATION & COMMERCE RESOLUTION ---
// Step up one directory from the album path to target the artist's root folder
// to cross-reference global configurations like DSP IDs and store URLs.
$artist_path_web = dirname($album_path_web);
$albums_master_url = $cdnBaseUrl . $artist_path_web . '/albums.json?v=' . time();
$albums_master_content = @file_get_contents($albums_master_url);

if ($albums_master_content !== false) {
    $master_data = json_decode($albums_master_content, true);
    $current_slug = basename($album_path_web);
    
    foreach ($master_data as $era) {
        if (!empty($era['albums'])) {
            foreach ($era['albums'] as $master_album) {
                // Match by explicitly defined folder, URL slug, or exact Album Name
                $check_slug = isset($master_album['folder']) ? $master_album['folder'] : basename($master_album['url']);
                
                if ($check_slug === $current_slug || $master_album['title'] === $album_name) {
                    $stream_spotify_id = $master_album['spotifyId'] ?? '';
                    $stream_apple_id   = $master_album['appleId'] ?? '';
                    $stream_amazon_id  = $master_album['amazonId'] ?? '';
                    $stream_youtube_id = $master_album['youtubeId'] ?? '';
                    
                    // Pull the Fourthwall Store URLs
                    $store_standard_url = $master_album['storeStandardUrl'] ?? '';
                    $store_audiophile_url = $master_album['storeAudiophileUrl'] ?? '';
                    
                    // Check for DSP exemptions
                    $dsp_exempt = $master_album['dspExempt'] ?? false;
                    $dsp_notice = $master_album['dspNotice'] ?? 'This release is intentionally withheld from commercial streaming algorithms.';
                    break 2; // Match found, break out of both loops
                }
            }
        }
    }
}

$has_active_streams = !empty($stream_spotify_id) || !empty($stream_apple_id) || !empty($stream_amazon_id) || !empty($stream_youtube_id);
// ----------------------

$album_art_url = $base_web_path . "/album-art.jpg?v=" . time();
$js_playlist = []; 
?>
<script type="application/ld+json">
    <?php echo $album_json_content; ?>
</script>
<wa-card class="mb-5 w-100">
    <div class="p-3">
        
        <div class="row g-2 align-items-center border-bottom border-secondary-subtle pb-3 mb-3">
            <div class="col-12 col-md-6">
                <div class="text-body fs-6 mb-2">
                    <i class="ph ph-timeline me-2 text-info"></i> <strong>Narrative Era:</strong> <span class="rs-badge" variant="brand" class="ms-1"><?php echo htmlspecialchars($narrative_year); ?></span>
                </div>
                <div class="text-body fs-6">
                    <i class="ph ph-record-vinyl me-2 text-warning"></i> <strong>Format:</strong> <span class="rs-badge" variant="warning" appearance="outline" class="ms-1"><?php echo htmlspecialchars($friendly_production); ?></span>
                </div>
            </div>
            
            <div class="col-12 col-md-6 text-md-end">
                <div class="text-body fs-6 mb-2">
                    <i class="ph ph-calendar-check me-2 text-success"></i> <strong>DSP Release:</strong> <span class="rs-badge" variant="success" class="ms-1"><?php echo htmlspecialchars($real_release_date); ?></span>
                </div>
                <div class="text-body fs-6">
                    <i class="ph ph-music me-2 text-primary"></i> <strong>Length:</strong> <span class="rs-badge" variant="primary" class="ms-1 me-2"><?php echo htmlspecialchars($friendly_release); ?></span>
                    <?php if ($album_upc): ?>
                        <span class="rs-badge" variant="neutral" title="Universal Product Code">UPC: <?php echo htmlspecialchars($album_upc); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php if (!empty($album_data['description'])): ?>
        <div class="mt-3 mb-2 px-3 py-2 border-start border-3 border-primary bg-body rounded-end">
            <p class="mb-0 fst-italic text-body-secondary small">
                <?php echo htmlspecialchars($album_data['description']); ?>
            </p>
        </div>
        <?php endif; ?>

        <div class="d-flex align-items-start mt-3">
            <i class="ph ph-circle-info text-secondary mt-1 me-3 fs-5"></i>
            <p class="small text-body-secondary mb-0 lh-sm">
                <strong>ARCHIVIST NOTE:</strong> <em><?php echo htmlspecialchars($display_artist); ?></em> is a narrative-driven musical universe. The <strong>Narrative Era</strong> denotes when the album was recorded within the fictional history of the band. The <strong>DSP Release</strong> reflects the legal copyright date when the audio files were officially pressed and distributed to global streaming platforms.
            </p>
        </div>
</wa-card>

<wa-card class="mb-4 w-100">
    <div slot="header" class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-uppercase"><i class="ph ph-headphones me-2"></i>Stream the Album</h5>
    </div>
        <?php if ($dsp_exempt): ?>
            <wa-alert variant="warning" open>
                <i class="ph ph-triangle-exclamation me-2"></i><strong>VAULT EXCLUSIVE:</strong> <?php echo htmlspecialchars($dsp_notice); ?>
            </wa-alert>
        <?php else: ?>
            <?php if ($has_active_streams): ?>
                <p class="text-success small mb-3"><strong>Support the band!</strong> Listen to the official release on your favorite streaming platform below.</p>
            <?php else: ?>
                <p class="text-muted small mb-3">Links will become active once the album clears the global distribution network.</p>
            <?php endif; ?>

            <div class="d-flex gap-2 flex-wrap">
                <?php if (!empty($stream_spotify_id)): ?>
                    <button class="rs-btn" href="https://open.spotify.com/album/<?php echo htmlspecialchars($stream_spotify_id); ?>" variant="success" appearance="outline" target="_blank"><i slot="start" class="fa-brands fa-spotify me-2"></i>Spotify</button>
                <?php else: ?>
                    <button class="rs-btn" href="#" variant="success" appearance="outline" disabled><i slot="start" class="fa-brands fa-spotify me-2"></i>Spotify</button>
                <?php endif; ?>
                
                <?php if (!empty($stream_apple_id)): ?>
                    <button class="rs-btn" href="https://music.apple.com/us/album/<?php echo htmlspecialchars($stream_apple_id); ?>" variant="danger" appearance="outline" target="_blank"><i slot="start" class="fa-brands fa-apple me-2"></i>Apple Music</button>
                <?php else: ?>
                    <button class="rs-btn" href="#" variant="danger" appearance="outline" disabled><i slot="start" class="fa-brands fa-apple me-2"></i>Apple Music</button>
                <?php endif; ?>

                <?php if (!empty($stream_amazon_id)): ?>
                    <button class="rs-btn" href="https://music.amazon.com/albums/<?php echo htmlspecialchars($stream_amazon_id); ?>" variant="brand" appearance="outline" target="_blank"><i slot="start" class="fa-brands fa-amazon me-2"></i>Amazon Music</button>
                <?php else: ?>
                    <button class="rs-btn" href="#" variant="brand" appearance="outline" disabled><i slot="start" class="fa-brands fa-amazon me-2"></i>Amazon Music</button>
                <?php endif; ?>

                <?php if (!empty($stream_youtube_id)): ?>
                    <button class="rs-btn" href="https://music.youtube.com/playlist?list=<?php echo htmlspecialchars($stream_youtube_id); ?>" variant="danger" appearance="outline" target="_blank"><i slot="start" class="fa-brands fa-youtube me-2"></i>YouTube Music</button>
                <?php else: ?>
                    <button class="rs-btn" href="#" variant="danger" appearance="outline" disabled><i slot="start" class="fa-brands fa-youtube me-2"></i>YouTube Music</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
</wa-card>

<wa-card class="mb-5 w-100">
    <div slot="header" class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-uppercase"><i class="ph ph-vault me-2"></i>Digital Archives & Studio Masters</h5>
        <div>
            <span class="rs-badge" variant="neutral" class="me-2" title="Creative Commons Attribution-ShareAlike 4.0 International">CC BY-SA 4.0</span>
        </div>
    </div>
        <p class="text-muted small mb-3">Support the band and own the master tapes. High-fidelity payloads are available directly from the Engine Room storefront.</p>
        
        <div class="d-flex gap-2 flex-wrap">
            <button class="rs-btn" href="<?php echo htmlspecialchars($free_archive_zip); ?>" download variant="success" appearance="outline">
                <i slot="start" class="ph ph-file-zipper"></i> Free Archive (128kbps)
            </button>
            
            <?php if (!empty($store_standard_url)): ?>
                <button class="rs-btn" href="<?php echo htmlspecialchars($store_standard_url); ?>" variant="brand" appearance="outline" target="_blank">
                    <i slot="start" class="ph ph-compact-disc me-2"></i>Standard Archive (V0 MP3/OGG)
                </button>
            <?php endif; ?>
            
            <?php if (!empty($store_audiophile_url)): ?>
                <button class="rs-btn" href="<?php echo htmlspecialchars($store_audiophile_url); ?>" variant="warning" appearance="outline" target="_blank">
                    <i slot="start" class="ph ph-waveform-lines me-2"></i>Audiophile Vault (FLAC/WAV)
                </button>
            <?php endif; ?>
        </div>
</wa-card>

<h3 class="h4 fw-bold text-uppercase text-muted mb-3">
    <i class="ph ph-list-music me-2"></i>Tracklist & Lyrics
</h3>

<div class="tracklist-wrapper mb-5">
    <?php 
    $current_disc = null;
    $current_suite = null;
    $is_list_open = false;

    foreach ($raw_tracks as $index => $track): 
        
        $disc = isset($track['disc']) ? $track['disc'] : 1;
        $disc_name = isset($track['discName']) ? $track['discName'] : '';
        $suite_name = isset($track['suiteName']) ? $track['suiteName'] : '';
        $isrc_code = isset($track['isrc']) ? $track['isrc'] : '';

        // ==========================================
        // DISC HEADER LOGIC
        // Detects when the disc number increments to close the previous list
        // and render a new sub-header for multi-disc releases.
        // ==========================================
        if ($disc !== $current_disc) {
            if ($is_list_open) {
                echo '</div>'; // Close previous list-group
            }
            $current_disc = $disc;
            $current_suite = null; // Reset suite on new disc
            
            $display_disc_name = !empty($disc_name) ? " — <span class='text-body-secondary fs-5'>" . htmlspecialchars($disc_name) . "</span>" : "";
            
            echo '<div class="mt-4 mb-3 pb-2 border-bottom border-secondary-subtle">';
            echo '<h4 class="text-info-emphasis fw-bold mb-0"><i class="ph ph-compact-disc me-2"></i>Disc ' . $disc . $display_disc_name . '</h4>';
            echo '</div>';
            
            echo '<div class="d-flex flex-column gap-2">';
            $is_list_open = true;
        }

        // ==========================================
        // SUITE HEADER LOGIC
        // Groups related tracks visually (e.g., a continuous movement or medley).
        // ==========================================
        if (!empty($suite_name) && $suite_name !== $current_suite) {
            $current_suite = $suite_name;
            echo '<div class="bg-secondary bg-opacity-10 border-start border-3 border-info py-2 mt-3 mb-1 px-3 rounded-end">';
            echo '<h6 class="text-uppercase text-secondary mb-0 fw-bold"><i class="ph ph-layer-group me-2"></i>' . htmlspecialchars($suite_name) . '</h6>';
            echo '</div>';
        } elseif (empty($suite_name) && $current_suite !== null) {
            $current_suite = null; // We've exited a suite
        }

        // ==========================================
        // TRACK ROW GENERATION
        // ==========================================
        $base_name = $track['fileName'];
        $version_string = "?v=" . time(); 
        $lyrics_url = $base_web_path . '/lyrics/' . $base_name . '.md' . $version_string;
        $dl_web_mp3 = $base_web_path . '/web-mp3/' . $base_name . '.mp3' . $version_string;

        $player_src = $dl_web_mp3;

        $legacy_tier = isset($track['legacyTier']) ? $track['legacyTier'] : null;
        $lore_note = isset($track['loreNote']) ? $track['loreNote'] : '';
        $duration = isset($track['duration']) ? $track['duration'] : '';

        // Add to JS Playlist (SCHEMA.ORG INTEGRATION)
        $artist_name = isset($album_data['byArtist']['name']) ? $album_data['byArtist']['name'] : 'Unknown Artist';
        
        $js_playlist[] = [
            'title' => $track['title'],
            'artist' => $artist_name,
            'album' => $album_name,
            'src' => $player_src,
            'artwork' => $album_art_url,
            'lyrics' => $lyrics_url,
            'legacyTier' => $legacy_tier,
            'loreNote' => $lore_note,
            'duration' => $duration
        ];

        $indent_class = !empty($current_suite) ? "ms-4 border-start-0 ps-3" : "";
        ?>
        
        <wa-card class="track-row w-100 <?php echo $indent_class; ?>" id="track-row-<?php echo $index; ?>" data-isrc="<?php echo htmlspecialchars($isrc_code); ?>">
            <div class="row align-items-center">
                <div class="col-md-8 mb-2 mb-md-0">
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="text-secondary fw-bold me-3" style="width: 25px;"><?php echo $track['track']; ?>.</span>
                        <div>
                            <strong class="text-body fs-5 d-inline-block me-2"><?php echo htmlspecialchars($track['title']); ?></strong>
                            
                            <?php if (!empty($duration)): ?>
                                <span class="text-secondary small fw-medium me-2" title="Track Length">
                                    <i class="ph ph-clock me-1" style="--fa-primary-opacity: 0.4;"></i><?php echo htmlspecialchars($duration); ?>
                                </span>
                            <?php endif; ?>

                            <?php 
                            if ($legacy_tier): 
                                $badge_variant = 'neutral';
                                $badge_appearance = 'filled';
                                
                                if ($legacy_tier === 'Chart Smash') $badge_variant = 'success';
                                if ($legacy_tier === 'Fan Anthem') $badge_variant = 'warning';
                                if ($legacy_tier === 'Deep Cut') $badge_variant = 'brand'; // Brand usually maps to info/primary
                                if ($legacy_tier === 'The Dud' || $legacy_tier === 'Studio Filler') $badge_variant = 'danger';
                                if ($legacy_tier === 'Vault Track') {
                                    $badge_variant = 'warning';
                                    $badge_appearance = 'outline';
                                }
                                
                                $safe_lore_attr = htmlspecialchars($lore_note, ENT_QUOTES);
                                $wcag_attrs = $lore_note 
                                    ? 'title="' . $safe_lore_attr . '" aria-label="Legacy Tier: ' . htmlspecialchars($legacy_tier) . '. Lore Note: ' . $safe_lore_attr . '" tabindex="0"'
                                    : 'aria-label="Legacy Tier: ' . htmlspecialchars($legacy_tier) . '" tabindex="0"';
                            ?>
                                <span class="rs-badge" variant="<?php echo $badge_variant; ?>" appearance="<?php echo $badge_appearance; ?>" class="align-text-bottom" style="cursor: help;" <?php echo $wcag_attrs; ?>>
                                    <?php echo strtoupper($legacy_tier); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-end mt-2 mt-md-0">
                    <div class="d-flex gap-2 justify-content-md-end" aria-label="Track Actions">
                        <button class="rs-btn" variant="primary" size="small" class="btn-play-index" data-index="<?php echo $index; ?>" title="Play Track">
                            <i slot="start" class="ph ph-play me-2"></i>Play
                        </button>
                        <button class="rs-btn" variant="brand" appearance="outline" size="small" class="btn-view-lyrics" data-title="<?php echo htmlspecialchars($track['title']); ?>" data-url="<?php echo $lyrics_url; ?>" title="View Lyrics">
                            <i slot="start" class="ph ph-book-open me-2"></i>Lyrics
                        </button>
                        <button class="rs-btn" href="<?php echo $dl_web_mp3; ?>" download variant="neutral" appearance="outline" size="small" class="license-gate" title="Download Free MP3">
                            <i class="ph ph-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </wa-card>
    <?php endforeach; ?>
    
    <?php if ($is_list_open) echo '</div>'; // Close final list-group ?>
</div>

<script>
    (function() {
        const newPlaylist = <?php echo json_encode($js_playlist); ?>;
        window.STARDUST_PLAYLIST = newPlaylist;
        const event = new CustomEvent('stardust:playlist-update', { detail: { playlist: newPlaylist } });
        document.dispatchEvent(event);
    })();
</script>