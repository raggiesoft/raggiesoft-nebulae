<?php
/**
 * ============================================================================
 * Architectural Block: celeste/lyra.php — The RaggieSoft Nebulae Observatory
 * ============================================================================
 * Serves the static Master Cosmic Observatory & Complete Network Sitemap
 * (`index.html`) for `nebulae.raggiesoft.com`.
 * ============================================================================
 */
header('Content-Type: text/html; charset=utf-8');
readfile(dirname(__DIR__) . '/index.html');