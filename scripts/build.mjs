/**
 * @license MIT
 * ============================================================================
 * scripts/build.mjs — The RaggieSoft Nebulae (nebulae.raggiesoft.com)
 * ============================================================================
 * Architectural Overview:
 * Static Site Generation (SSG) compiler for `nebulae.raggiesoft.com` —
 * **The Master Cosmic Observatory & Complete Network Sitemap** of the entire
 * 9-property RaggieSoft ecosystem:
 * 1. `raggiesoft.com` (RaggieSoft Hub — PHP 8.5 + Stardust Engine CMS / Elara + Web Awesome Pro)
 * 2. `music.raggiesoft.com` (The Listening Room — SvelteKit 2 + Svelte 5 Runes)
 * 3. `books.raggiesoft.com` (RaggieSoft Book Reader — PHP 8.5 + Stardust Engine Library SPA)
 * 4. `lore.raggiesoft.com` (Lore Omnibus & Runebreaker — Next.js 16 + React 19 + Tailwind v4)
 * 5. `engineroom.raggiesoft.com` (Engine Room Records — Astro 6 Static SSG)
 * 6. `stardust.raggiesoft.com` (The Stardust Engine — Nuxt 4 + Vue 3 Static SSG)
 * 7. `corporate.raggiesoft.com` (RaggieSoft Media B2B — Bootstrap 5.3.8 Static SSG)
 * 8. `storetrainer.raggiesoft.com` (RaggieSoft StoreTrainer — Vanilla TS + Win98/Netscape 4 CSS)
 * 9. `michaelpragsdale.com` (Executive Architect Portfolio — Angular 19 Zoneless)
 *
 * Emits:
 * - `/index.html` (and `/dist/index.html`)
 * - `/sitemap.xml`
 * - `/robots.txt`
 * ============================================================================
 */

import fs from 'node:fs';
import path from 'node:path';
import http from 'node:http';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const projectRoot = path.resolve(__dirname, '..');
const subdomainsDir = path.resolve(projectRoot, '..');
const workspaceRoot = path.resolve(projectRoot, '../../..');

function escapeHtml(str) {
  return String(str ?? '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function loadJsonSafe(filePath, fallback = []) {
  try {
    if (fs.existsSync(filePath)) {
      return JSON.parse(fs.readFileSync(filePath, 'utf-8'));
    }
  } catch (e) {}
  return fallback;
}

function collectConstellations() {
  const catalog = loadJsonSafe(
    path.join(workspaceRoot, 'raggiesoft-assets/engine-room-records/catalog.json'),
    []
  );
  const stardustPorted = loadJsonSafe(
    path.join(subdomainsDir, 'stardust/src/data/ported-pages.json'),
    []
  );
  const engineroomPorted = loadJsonSafe(
    path.join(subdomainsDir, 'engineroom/src/data/ported-pages.json'),
    []
  );
  const corporatePorted = loadJsonSafe(
    path.join(subdomainsDir, 'corporate/src/data/ported-pages.json'),
    []
  );

  // 1. raggiesoft.com
  const hubRoutes = [
    { path: '/', title: 'RaggieSoft Hub — Network Gateway & CMS Showcase', category: 'Entrypoint' },
    { path: '/about', title: 'About the RaggieSoft Ecosystem & Architecture', category: 'About' },
    { path: '/about/accessibility', title: 'WCAG 2.1 AA & Section 508 Accessibility Statement', category: 'Compliance' },
    { path: '/about/privacy', title: 'Zero-Database Privacy Policy', category: 'Legal' },
    { path: '/about/terms', title: 'Terms of Service & Licensing Summary', category: 'Legal' }
  ];

  // 2. music.raggiesoft.com
  const musicRoutes = [
    { path: '/', title: 'The Listening Room — Complete Audio Streaming & CC BY-SA 4.0 Archive', category: 'Hub' },
    { path: '/radio', title: 'The Listening Room 24/7 Radio Broadcast Booth', category: 'Radio' },
    { path: '/playlists/cosmic-tidal-lock-sound', title: 'Playlist: The Cosmic Tidal Lock Sound™ (The Stardust Engine)', category: 'Playlist' },
    { path: '/playlists/john-and-erin', title: 'Playlist: Before the Distance — The Story of John & Erin', category: 'Playlist' }
  ];
  const seenArtists = new Set();
  for (const album of catalog) {
    if (!seenArtists.has(album.artistSlug)) {
      seenArtists.add(album.artistSlug);
      musicRoutes.push({
        path: `/${album.artistSlug}`,
        title: `${album.artistName} — Complete Artist Discography & Bio`,
        category: 'Artist'
      });
    }
    musicRoutes.push({
      path: `/${album.artistSlug}/${album.albumSlug}`,
      title: `${album.albumTitle} (${album.releaseYear}) — ${album.artistName}`,
      category: 'Album'
    });
  }

  // 3. books.raggiesoft.com
  const booksRoutes = [
    { path: '/', title: 'RaggieSoft Book Reader — Ocean View & Contemporary Literary Library', category: 'Library Hub' },
    { path: '/books/stardust-engine', title: 'The Stardust Engine: Band Novel & Chronicle', category: 'Novel' },
    { path: '/books/erin', title: 'Before the Distance: The Story of John & Erin', category: 'Novel' },
    { path: '/books/julian', title: "Upon This Winter's Night: The Story of Julian Rowlands", category: 'Novel' },
    { path: '/books/rachel', title: 'The Rachel Narrative (Contemporary Archive)', category: 'Novel' },
    { path: '/books/paige', title: 'The Paige Narrative (CPI Campus Chronicle)', category: 'Novel' },
    { path: '/books/runebreaker', title: 'Runebreaker: Chronicles of Aethelgard', category: 'Novel' }
  ];

  // 4. lore.raggiesoft.com
  const loreRoutes = [
    { path: '/', title: 'RaggieSoft Lore Omnibus & Interactive Compendium', category: 'Lore Hub' },
    { path: '/characters', title: 'Cross-Universe Character Directory & Profiles', category: 'Characters' },
    { path: '/compendium', title: 'Worldbuilding Compendium (CPI, Blacksburg, Aethelgard)', category: 'Worldbuilding' },
    { path: '/runebreaker', title: 'Runebreaker Dual-Layer Accessible HTML5 Canvas Engine', category: 'Interactive' }
  ];

  // 5. stardust.raggiesoft.com
  const stardustRouteMap = new Map([
    ['/', { path: '/', title: 'The Stardust Engine — Official Cosmic Portal', category: 'Cosmic Core' }],
    ['/band', { path: '/band', title: 'The Iron Five — Band Member Biographies', category: 'Cosmic Core' }],
    ['/discography', { path: '/discography', title: 'Chronological Discography & Curated Playlists', category: 'Cosmic Core' }],
    ['/lore', { path: '/lore', title: 'Deep Band Lore (1985–2016) & Master Exhibit Directory', category: 'Cosmic Core' }],
    ['/fleet', { path: '/fleet', title: 'Rolling Sanctuary Fleet (2002 Sainte-Claire 45H3 & 2004 Prairie Coachworks RLFD30)', category: 'Cosmic Core' }],
    ['/novel', { path: '/novel', title: 'Cosmic Novel Reader (The Stardust Engine & John & Erin)', category: 'Cosmic Core' }]
  ]);
  for (const p of stardustPorted) {
    if (!stardustRouteMap.has(p.route)) {
      stardustRouteMap.set(p.route, {
        path: p.route,
        title: p.title,
        category: p.route.startsWith('/story/nine-figure-refusal') ? 'Nine-Figure Refusal Exhibit' : 'Band Dossier'
      });
    }
  }

  // 6. engineroom.raggiesoft.com
  const engineroomRouteMap = new Map([
    ['/', { path: '/', title: 'Engine Room Records — Three-Pillar Imprint Hub', category: 'Imprint Core' }],
    ['/studio-engineering', { path: '/studio-engineering', title: 'Behind the Scenes: Human + AI Studio Engineering & 74% Cover Protocol', category: 'Studio Engineering' }],
    ['/corporate', { path: '/corporate', title: 'Corporate Architecture: Real-World Brand vs. In-Universe LLCs', category: 'Corporate Lore' }],
    ['/artists', { path: '/artists', title: 'Complete Roster Directory (All 7 Bands)', category: 'Artists' }],
    ['/commercial-licensing', { path: '/commercial-licensing', title: 'Commercial Synchronization & Master Use Licensing', category: 'Licensing' }],
    ['/dsp-verification', { path: '/dsp-verification', title: 'DSP Copyright & Catalog Verification Ledger', category: 'Verification' }],
    ['/artists/the-stardust-engine', { path: '/artists/the-stardust-engine', title: 'The Stardust Engine (ERR-001) Roster Dossier', category: 'Artists' }],
    ['/artists/fractured-prisms', { path: '/artists/fractured-prisms', title: 'Fractured Prisms (ERR-002) Roster Dossier', category: 'Artists' }],
    ['/artists/the-paper-wall', { path: '/artists/the-paper-wall', title: 'The Paper Wall / Mirage (ERR-003) Roster Dossier', category: 'Artists' }],
    ['/artists/crimson-node', { path: '/artists/crimson-node', title: 'Crimson Node (ERR-004) Roster Dossier', category: 'Artists' }],
    ['/artists/mana-canvas', { path: '/artists/mana-canvas', title: 'Mana Canvas (ERR-005) Roster Dossier', category: 'Artists' }],
    ['/artists/the-arctic-symphony-project', { path: '/artists/the-arctic-symphony-project', title: 'The Arctic Symphony Project (ERR-006) Roster Dossier', category: 'Artists' }],
    ['/artists/teller-county', { path: '/artists/teller-county', title: 'Teller County (ERR-007) Roster Dossier', category: 'Artists' }]
  ]);
  for (const p of engineroomPorted) {
    if (!engineroomRouteMap.has(p.route)) {
      engineroomRouteMap.set(p.route, {
        path: p.route,
        title: p.title,
        category: p.route.startsWith('/artists/') ? 'Artist & Character Dossier' : 'Corporate & Property Dossier'
      });
    }
  }

  // 7. corporate.raggiesoft.com
  const corporateRoutes = corporatePorted.map((p) => ({
    path: p.route,
    title: p.title,
    category: 'B2B & Licensing'
  }));

  // 8. storetrainer.raggiesoft.com
  const storetrainerRoutes = [
    { path: '/', title: 'RaggieSoft StoreTrainer v1.0 Portal & tssetup100.exe Download', category: 'Win32 Utility' },
    { path: '/source', title: 'Interactive VB6 (TStore.vbp) & VB.NET Source Code Inspector (18 Files)', category: 'Source Code' },
    { path: '/installer', title: 'NSIS Wizard95 Installer Scripts (TSSetup.nsi & TSSetup-Patch.nsi)', category: 'Installer' }
  ];

  // 9. michaelpragsdale.com
  const portfolioRoutes = [
    { path: '/', title: 'Michael P. Ragsdale — Executive Systems Architect & Section 508 Engineer Dossier', category: 'Executive Portfolio' }
  ];

  return [
    {
      id: 'hub',
      domain: 'raggiesoft.com',
      baseUrl: 'https://raggiesoft.com',
      name: 'RaggieSoft Hub (Network Entrypoint)',
      techStack: 'PHP 8.5 + Stardust Engine CMS (Elara) + Web Awesome Pro',
      vanityRedirects: 'Legacy deep routes 301-redirect to their dedicated *.raggiesoft.com subdomains',
      description: 'The lean central entrypoint of the RaggieSoft network showcasing the flat-file Elara router and Web Awesome design system.',
      routes: hubRoutes
    },
    {
      id: 'music',
      domain: 'music.raggiesoft.com',
      baseUrl: 'https://music.raggiesoft.com',
      name: 'The Listening Room (Audio & Lyrics Sanctuary)',
      techStack: 'SvelteKit 2 + Svelte 5 Runes + Web Audio API',
      vanityRedirects: 'raggiesoft.com/engine-room/radio -> music.raggiesoft.com/radio',
      description: 'Streams all 31 albums and 468+ tracks across 7 bands with synchronized lyrics, 24/7 radio, and free CC BY-SA 4.0 128kbps MP3 ZIP downloads.',
      routes: musicRoutes
    },
    {
      id: 'stardust',
      domain: 'stardust.raggiesoft.com',
      baseUrl: 'https://stardust.raggiesoft.com',
      name: 'The Stardust Engine (Cosmic Band Lore & Exhibits)',
      techStack: 'Nuxt 4 + Vue 3 Static SSG (Exoplanet Light / Deep Space Dark)',
      vanityRedirects: 'thestardustengine.com -> stardust.raggiesoft.com',
      description: 'Houses the 1986 Band Name Canon, The Iron Five biographies, accessible tour bus fleet, and all 64 deep story and Nine-Figure Refusal bankruptcy exhibits.',
      routes: Array.from(stardustRouteMap.values())
    },
    {
      id: 'engineroom',
      domain: 'engineroom.raggiesoft.com',
      baseUrl: 'https://engineroom.raggiesoft.com',
      name: 'Engine Room Records (Imprint, Studio & Corporate Lore)',
      techStack: 'Astro 6 Static SSG',
      vanityRedirects: 'engineroom-records.com -> engineroom.raggiesoft.com | fracturedprisms.com -> /artists/fractured-prisms',
      description: 'Documents the 3 core pillars: band roster directory, transparent human+AI studio engineering, and the dual-layer corporate structure (73 deep dossiers).',
      routes: Array.from(engineroomRouteMap.values())
    },
    {
      id: 'books',
      domain: 'books.raggiesoft.com',
      baseUrl: 'https://books.raggiesoft.com',
      name: 'RaggieSoft Book Reader (Literary Library)',
      techStack: 'PHP 8.5 + Stardust Engine Library SPA + EPUB 3.3 Pipeline',
      vanityRedirects: 'raggiesoft.com/raggiesoft-books/* -> books.raggiesoft.com',
      description: 'Zero-database literary reader housing the Ocean View Archives and Contemporary Novels with adjustable WCAG AAA typography.',
      routes: booksRoutes
    },
    {
      id: 'lore',
      domain: 'lore.raggiesoft.com',
      baseUrl: 'https://lore.raggiesoft.com',
      name: 'RaggieSoft Lore Omnibus & Runebreaker',
      techStack: 'Next.js 16 + React 19 + Tailwind CSS v4 + Accessible Canvas',
      vanityRedirects: 'runebreaker.raggiesoft.com & raggiesoft.com/encyclopedia/* -> lore.raggiesoft.com',
      description: 'Cross-universe character encyclopedia, worldbuilding compendium, and the Dual-Layer Section 508 Accessible HTML5 Canvas engine.',
      routes: loreRoutes
    },
    {
      id: 'corporate',
      domain: 'corporate.raggiesoft.com',
      baseUrl: 'https://corporate.raggiesoft.com',
      name: 'RaggieSoft Media ("Corporate Me" & B2B Licensing)',
      techStack: 'Bootstrap 5.3.8 Static SSG (Frutiger Aero / Dark Aero Glass)',
      vanityRedirects: 'raggiesoftmedia.com & stardustenginecms.com -> corporate.raggiesoft.com',
      description: 'Real-world B2B corporate hub for Master & Commercial Sync Licensing, Open-Source Projects, and Recruitment Fraud Alerts.',
      routes: corporateRoutes
    },
    {
      id: 'storetrainer',
      domain: 'storetrainer.raggiesoft.com',
      baseUrl: 'https://storetrainer.raggiesoft.com',
      name: 'RaggieSoft StoreTrainer (Win32 Retro PC Utility)',
      techStack: 'Vanilla TypeScript + Classic Win32 / Netscape Communicator 4.78 CSS',
      vanityRedirects: 'raggiesoft.com/products/storetrainer -> storetrainer.raggiesoft.com',
      description: 'Official download portal and 18-file VB6/.NET/NSIS source code inspector for the hand-written 2018–2020 Win32 game & trainer manager.',
      routes: storetrainerRoutes
    },
    {
      id: 'portfolio',
      domain: 'michaelpragsdale.com',
      baseUrl: 'https://michaelpragsdale.com',
      name: 'Michael P. Ragsdale (Executive Architect Dossier)',
      techStack: 'Angular 19 Zoneless Signals',
      vanityRedirects: 'raggiesoft.com/about/michael-ragsdale -> michaelpragsdale.com',
      description: 'Standalone executive systems architecture, DevOps automation fleet (Jenna, Sarah, Harper, Elara), and Section 508 compliance portfolio.',
      routes: portfolioRoutes
    }
  ];
}

function renderNebulaeCss() {
  return `/**
 * @license MIT
 * ============================================================================
 * assets/nebulae.css — The RaggieSoft Nebulae (nebulae.raggiesoft.com)
 * ============================================================================
 * Implements the "Star-Chart Parchment (Light Mode) vs. Deep-Space Nebulae
 * Observatory (Dark Mode)" design system with strict WCAG 2.1 AA contrast and
 * prefers-reduced-motion compliance.
 * ============================================================================
 */
:root,
[data-theme="light"] {
  color-scheme: light dark;
  --neb-bg: #f4f6fb;
  --neb-surface: rgba(255, 255, 255, 0.94);
  --neb-elevated: #e6ecf8;
  --neb-text: #0b132b;
  --neb-muted: #334155;
  --neb-border: #94a3b8;
  --neb-accent: #1d4ed8;
  --neb-gold: #9a5b00;
  --neb-badge-bg: #dbeafe;
  --neb-badge-text: #1e3a8a;
}

@media (prefers-color-scheme: dark) {
  :root:not([data-theme="light"]) {
    --neb-bg: #050814;
    --neb-surface: rgba(15, 23, 42, 0.92);
    --neb-elevated: #111c38;
    --neb-text: #f8fafc;
    --neb-muted: #cbd5e1;
    --neb-border: #334155;
    --neb-accent: #38bdf8;
    --neb-gold: #fbbf24;
    --neb-badge-bg: #1e293b;
    --neb-badge-text: #7dd3fc;
  }
}

[data-theme="dark"] {
  --neb-bg: #050814;
  --neb-surface: rgba(15, 23, 42, 0.92);
  --neb-elevated: #111c38;
  --neb-text: #f8fafc;
  --neb-muted: #cbd5e1;
  --neb-border: #334155;
  --neb-accent: #38bdf8;
  --neb-gold: #fbbf24;
  --neb-badge-bg: #1e293b;
  --neb-badge-text: #7dd3fc;
}

*, *::before, *::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  min-height: 100vh;
  background-color: var(--neb-bg);
  color: var(--neb-text);
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  line-height: 1.6;
  display: flex;
  flex-direction: column;
  overflow-x: hidden;
}

.nebulae-sky {
  position: fixed;
  inset: 0;
  z-index: 0;
  pointer-events: none;
  background:
    radial-gradient(circle at 18% 22%, rgba(56, 189, 248, 0.12), transparent 42%),
    radial-gradient(circle at 82% 28%, rgba(168, 85, 247, 0.12), transparent 45%),
    radial-gradient(circle at 50% 80%, rgba(251, 191, 36, 0.08), transparent 50%);
}

.skip-link {
  position: absolute;
  top: -100px;
  left: 1rem;
  z-index: 9999;
  padding: 0.6rem 1.1rem;
  background: var(--neb-accent);
  color: var(--neb-bg);
  font-weight: 800;
  border-radius: 0.5rem;
  text-decoration: none;
}
.skip-link:focus {
  top: 1rem;
}

:focus-visible {
  outline: 3px solid var(--neb-accent);
  outline-offset: 2px;
}

.container {
  position: relative;
  z-index: 1;
  width: 100%;
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 1.25rem;
}

/* Compact Sticky Observatory Header (michaelpragsdale.com pattern) */
.site-header {
  position: sticky;
  top: 0;
  z-index: 50;
  background-color: var(--neb-surface);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--neb-border);
}

.header-inner {
  display: flex;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: space-between;
  gap: 0.75rem;
  padding: 0.55rem 0;
}

.brand-title {
  font-size: 0.96rem;
  font-weight: 900;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--neb-text);
  text-decoration: none;
  white-space: nowrap;
}

.mobile-menu-toggle {
  display: none;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  padding: 0;
  border-radius: 0.5rem;
  border: 1px solid var(--neb-border);
  background-color: var(--neb-elevated);
  color: var(--neb-text);
  cursor: pointer;
  flex-shrink: 0;
}

.control-bar {
  display: flex;
  flex-wrap: nowrap;
  gap: 0.45rem;
  align-items: center;
}

@media (max-width: 900px) {
  .header-inner {
    flex-wrap: wrap;
  }
  .mobile-menu-toggle {
    display: inline-flex;
  }
  .control-bar {
    display: none;
    width: 100%;
    flex-direction: column;
    align-items: stretch;
    padding-top: 0.5rem;
    border-top: 1px solid var(--neb-border);
  }
  .control-bar.is-open {
    display: flex;
  }
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.38rem 0.75rem;
  border-radius: 0.45rem;
  border: 1px solid var(--neb-border);
  background-color: var(--neb-elevated);
  color: var(--neb-text);
  font-size: 0.8rem;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  white-space: nowrap;
}

.btn[aria-pressed="true"],
.btn-active {
  background-color: var(--neb-accent);
  color: var(--neb-bg);
  border-color: transparent;
}

.hero-panel {
  background-color: var(--neb-surface);
  border: 1px solid var(--neb-border);
  border-radius: 1rem;
  padding: 2rem;
  margin: 2rem 0 1.5rem;
  min-width: 0;
  max-width: 100%;
  overflow: hidden;
}

.search-input {
  width: 100%;
  padding: 0.85rem 1.1rem;
  font-size: 1rem;
  border-radius: 0.65rem;
  border: 2px solid var(--neb-border);
  background-color: var(--neb-bg);
  color: var(--neb-text);
  margin-bottom: 1rem;
}

.filter-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 0.45rem;
}

.constellation-card {
  background-color: var(--neb-surface);
  border: 1px solid var(--neb-border);
  border-radius: 1rem;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  min-width: 0;
  max-width: 100%;
  overflow: hidden;
  overflow-wrap: break-word;
}

.route-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(min(100%, 320px), 1fr));
  gap: 0.75rem;
  margin-top: 1rem;
}

.route-grid > * {
  min-width: 0;
  max-width: 100%;
}

.route-item {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0.75rem 0.95rem;
  border-radius: 0.65rem;
  background-color: var(--neb-elevated);
  border: 1px solid var(--neb-border);
  min-width: 0;
  max-width: 100%;
  overflow: hidden;
  overflow-wrap: break-word;
}

.route-item a {
  color: var(--neb-accent);
  font-weight: 700;
  text-decoration: none;
}
.route-item a:hover {
  text-decoration: underline;
}

.route-path {
  font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
  font-size: 0.76rem;
  color: var(--neb-muted);
  word-break: break-all;
}

.badge {
  display: inline-block;
  font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
  font-size: 0.72rem;
  font-weight: 700;
  padding: 0.15rem 0.5rem;
  border-radius: 0.35rem;
  background-color: var(--neb-badge-bg);
  color: var(--neb-badge-text);
  max-width: 100%;
  white-space: normal !important;
  overflow-wrap: break-word;
  word-break: break-word;
}

.site-footer {
  background-color: var(--neb-surface);
  border-top: 1px solid var(--neb-border);
  padding: 2rem 0;
  margin-top: 3rem;
  font-size: 0.84rem;
  color: var(--neb-muted);
}

.disclaimer-box {
  background-color: var(--neb-elevated);
  border: 1px solid var(--neb-border);
  border-radius: 0.75rem;
  padding: 1rem 1.25rem;
  margin: 1rem 0;
}
`;
}

function renderNebulaeClientJs() {
  return `/**
 * @license MIT
 * nebulae-client.js — Client Progressive Enhancement for nebulae.raggiesoft.com
 * Implements Modern Web Guidance dark-mode-toggle and instant 9-property route search.
 */
(function () {
  var meta = document.querySelector('meta[name="color-scheme"]');
  var themeBtn = document.getElementById('theme-toggle');
  var themeLabel = document.getElementById('theme-toggle-label');
  var searchInput = document.getElementById('nebulae-search');
  var filterBtns = Array.prototype.slice.call(document.querySelectorAll('[data-constellation-filter]'));
  var cards = Array.prototype.slice.call(document.querySelectorAll('[data-constellation-id]'));
  var countEl = document.getElementById('visible-route-count');
  var activeConstellation = 'all';

  function getSystemScheme() {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function getRenderedScheme() {
    var stored = null;
    try { stored = localStorage.getItem('color-scheme'); } catch (e) {}
    return (stored === 'light' || stored === 'dark') ? stored : getSystemScheme();
  }

  function updateThemeLabel() {
    var current = getRenderedScheme();
    document.documentElement.setAttribute('data-theme', current);
    if (!themeLabel) return;
    var stored = null;
    try { stored = localStorage.getItem('color-scheme'); } catch (e) {}
    if (stored === 'light' || stored === 'dark') {
      themeLabel.textContent = current === 'dark' ? '🌌 Deep Space (Pinned)' : '☀️ Star-Chart (Pinned)';
    } else {
      themeLabel.textContent = current === 'dark' ? '🌌 System (Deep Space)' : '☀️ System (Star-Chart)';
    }
  }

  if (themeBtn && meta) {
    updateThemeLabel();
    themeBtn.addEventListener('click', function () {
      var current = getRenderedScheme();
      var target = current === 'dark' ? 'light' : 'dark';
      var sys = getSystemScheme();
      try {
        if (target === sys) {
          localStorage.removeItem('color-scheme');
          meta.content = 'light dark';
        } else {
          localStorage.setItem('color-scheme', target);
          meta.content = target;
        }
      } catch (e) {
        meta.content = target;
      }
      updateThemeLabel();
    });
  }

  var menuBtn = document.getElementById('mobile-menu-toggle');
  var primaryNav = document.getElementById('primary-navigation');
  if (menuBtn && primaryNav) {
    menuBtn.addEventListener('click', function () {
      var isOpen = primaryNav.classList.toggle('is-open');
      menuBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  function applyFilter() {
    var q = String(searchInput ? searchInput.value : '').trim().toLowerCase();
    var totalVisible = 0;

    cards.forEach(function (card) {
      var cid = card.getAttribute('data-constellation-id');
      var matchesConstellation = (activeConstellation === 'all' || activeConstellation === cid);
      if (!matchesConstellation) {
        card.style.display = 'none';
        return;
      }
      var items = Array.prototype.slice.call(card.querySelectorAll('.route-item'));
      var visibleInCard = 0;
      items.forEach(function (item) {
        var text = (item.textContent || '').toLowerCase();
        var show = !q || text.indexOf(q) !== -1;
        item.style.display = show ? '' : 'none';
        if (show) {
          visibleInCard++;
          totalVisible++;
        }
      });
      card.style.display = visibleInCard > 0 ? '' : 'none';
    });

    if (countEl) {
      countEl.textContent = String(totalVisible);
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', applyFilter);
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      activeConstellation = btn.getAttribute('data-constellation-filter') || 'all';
      filterBtns.forEach(function (b) {
        b.setAttribute('aria-pressed', b === btn ? 'true' : 'false');
      });
      applyFilter();
    });
  });
})();
`;
}

function buildNebulaeIndexHtml(constellations) {
  const totalRoutes = constellations.reduce((sum, c) => sum + c.routes.length, 0);

  const filterButtonsHtml = [
    `<button type="button" class="btn" data-constellation-filter="all" aria-pressed="true">🌌 All 9 Constellations (${totalRoutes})</button>`,
    ...constellations.map(
      (c) =>
        `<button type="button" class="btn" data-constellation-filter="${escapeHtml(c.id)}" aria-pressed="false">${escapeHtml(c.domain)} (${c.routes.length})</button>`
    )
  ].join('\n            ');

  const constellationsHtml = constellations
    .map(
      (c) => `
      <section class="constellation-card" data-constellation-id="${escapeHtml(c.id)}" aria-labelledby="heading-${escapeHtml(c.id)}">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 1rem; border-bottom: 1px solid var(--neb-border); padding-bottom: 0.85rem;">
          <div style="min-width: 0; max-width: 100%;">
            <span class="badge">${escapeHtml(c.techStack)}</span>
            <h2 id="heading-${escapeHtml(c.id)}" style="margin: 0.4rem 0 0.25rem; font-size: 1.4rem;">
              <a href="${escapeHtml(c.baseUrl)}" style="color: var(--neb-text); text-decoration: none;">
                ${escapeHtml(c.name)} — <code>${escapeHtml(c.domain)}</code>
              </a>
            </h2>
            <p style="margin: 0; font-size: 0.9rem; color: var(--neb-muted);">${escapeHtml(c.description)}</p>
            <p style="margin: 0.25rem 0 0; font-size: 0.78rem; font-family: monospace; color: var(--neb-gold);">
              Redirects: ${escapeHtml(c.vanityRedirects)}
            </p>
          </div>
          <a href="${escapeHtml(c.baseUrl)}" class="btn">Launch ${escapeHtml(c.domain)} ↗</a>
        </div>

        <div class="route-grid">
          ${c.routes
            .map((r) => {
              const fullUrl = `${c.baseUrl}${r.path === '/' ? '' : r.path}`;
              return `
              <article class="route-item">
                <div>
                  <div style="display: flex; justify-content: space-between; gap: 0.5rem; margin-bottom: 0.25rem;">
                    <span class="badge">${escapeHtml(r.category)}</span>
                    <span class="route-path">${escapeHtml(r.path)}</span>
                  </div>
                  <a href="${escapeHtml(fullUrl)}">${escapeHtml(r.title)}</a>
                </div>
              </article>`;
            })
            .join('\n')}
        </div>
      </section>`
    )
    .join('\n');

  return `<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="color-scheme" content="light dark" />
    <script>
      try {
        var storedScheme = localStorage.getItem('color-scheme');
        document.querySelector('meta[name="color-scheme"]').content = storedScheme ?? 'light dark';
        var resolvedTheme = (storedScheme === 'light' || storedScheme === 'dark')
          ? storedScheme
          : (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        document.documentElement.setAttribute('data-theme', resolvedTheme);
      } catch (e) {}
    </script>
    <title>The RaggieSoft Nebulae | Master Network Sitemap &amp; Observatory</title>
    <meta name="description" content="Master Cosmic Observatory and complete network sitemap indexing all 9 RaggieSoft properties and ${totalRoutes}+ routes across music, books, lore, and software." />
    <link rel="canonical" href="https://nebulae.raggiesoft.com" />
    <meta property="og:title" content="The RaggieSoft Nebulae | Master Network Observatory" />
    <meta property="og:description" content="Complete interactive sitemap indexing all 9 RaggieSoft domains and ${totalRoutes}+ routes across music, books, lore, and software." />
    <meta property="og:image" content="https://assets.raggiesoft.com/stardust-engine/images/stardust-engine-hero.jpg" />
    <meta property="og:url" content="https://nebulae.raggiesoft.com" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="The RaggieSoft Nebulae" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="The RaggieSoft Nebulae | Master Network Observatory" />
    <meta name="twitter:description" content="Complete interactive sitemap indexing all 9 RaggieSoft domains and ${totalRoutes}+ routes across music, books, lore, and software." />
    <meta name="twitter:image" content="https://assets.raggiesoft.com/stardust-engine/images/stardust-engine-hero.jpg" />
    <link rel="icon" type="image/png" href="https://assets.raggiesoft.com/raggiesoft-corporate/images/logos/raggiesoft-logo.png" />
    <link rel="stylesheet" href="https://assets.raggiesoft.com/common/css/raggiesoft-grid.css" />
    <link rel="stylesheet" href="https://assets.raggiesoft.com/common/css/raggiesoft-logo.css" />
    <link rel="stylesheet" href="https://assets.raggiesoft.com/nebulae/css/nebulae.css" />
    <link rel="stylesheet" href="https://assets.raggiesoft.com/common/css/raggiesoft-network.css?v=20261017g" />
  </head>
  <body>
    <div class="nebulae-sky" aria-hidden="true"></div>
    <a href="#content" class="skip-link">Skip to master network directory</a>

    <nav class="rs-network-bar" aria-label="RaggieSoft Ecosystem Network">
      <div class="rs-network-bar-inner">
        <span class="rs-network-label">✦ RaggieSoft Network:</span>
        <ul class="rs-network-links">
          <li><a href="https://raggiesoft.com">🌐 Hub</a></li>
          <li><a href="https://nebulae.raggiesoft.com" aria-current="page" class="is-active">🌌 Nebulae</a></li>
          <li><a href="https://music.raggiesoft.com">🎧 Music</a></li>
          <li><a href="https://books.raggiesoft.com">📚 Books</a></li>
          <li><a href="https://stardust.raggiesoft.com">🚀 Stardust</a></li>
          <li><a href="https://engineroom.raggiesoft.com">⚙️ Engine Room</a></li>
          <li><a href="https://lore.raggiesoft.com">🏛️ Lore</a></li>
          <li><a href="https://corporate.raggiesoft.com">🏢 Corporate</a></li>
          <li><a href="https://storetrainer.raggiesoft.com">💾 StoreTrainer</a></li>
          <li><a href="https://michaelpragsdale.com">👔 Michael P. Ragsdale</a></li>
        </ul>
      </div>
    </nav>

    <header class="site-header" role="banner">
      <div class="container header-inner">
        <a href="/" class="brand-title">🌌 The RaggieSoft Nebulae • Observatory</a>
        <button
          type="button"
          class="mobile-menu-toggle"
          id="mobile-menu-toggle"
          aria-expanded="false"
          aria-controls="primary-navigation"
          aria-label="Toggle navigation menu"
        >
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
        <div id="primary-navigation" class="control-bar">
          <a href="/sitemap.xml" class="btn">🗺️ XML Sitemap (${totalRoutes})</a>
          <a href="https://raggiesoft.com" class="btn">🌐 RaggieSoft Hub</a>
          <button
            type="button"
            id="theme-toggle"
            class="btn"
            aria-label="Toggle between Star-Chart Light Mode and Deep-Space Dark Mode"
          >
            <span id="theme-toggle-label">🌌 Theme</span>
          </button>
        </div>
      </div>
    </header>

    <main id="content" class="container" tabindex="-1">
      <section class="hero-panel" aria-labelledby="observatory-heading">
        <span class="badge" style="margin-bottom: 0.5rem;">9 Distinct Tech Stacks • ${totalRoutes} Indexed Routes • 100% Zero-Database Architecture</span>
        <h1 id="observatory-heading" style="margin: 0 0 0.5rem; font-size: clamp(1.75rem, 3.2vw, 2.5rem);">
          Every Star in the RaggieSoft Universe. One Master Star-Chart.
        </h1>
        <p style="margin: 0 0 1.25rem; color: var(--neb-muted); max-width: 82ch;">
          Originally used as the Web Awesome staging ground for <code>raggiesoft-hub</code>, <strong><code>nebulae.raggiesoft.com</code></strong> now serves as the permanent <strong>Master Cosmic Observatory &amp; Complete Network Sitemap</strong>—indexing every single route across all 9 standalone RaggieSoft properties (<strong id="visible-route-count">${totalRoutes}</strong> routes visible).
        </p>

        <label for="nebulae-search" style="display: block; font-weight: 700; margin-bottom: 0.35rem;">
          🔭 Search Across All 9 Properties (${totalRoutes} Routes, Albums, Books, Corporate Filings &amp; Source Modules):
        </label>
        <input
          type="search"
          id="nebulae-search"
          class="search-input"
          placeholder="Type any band, album, character, bankruptcy exhibit, LLC, or route path (e.g. 'Nine-Figure Refusal', 'StoreTrainer', 'Julian', 'Blacksburg')..."
        />

        <div class="filter-pills" role="group" aria-label="Filter by Constellation Property">
          ${filterButtonsHtml}
        </div>
      </section>

      ${constellationsHtml}
    </main>

    <footer class="site-footer" role="contentinfo">
      <div class="container">
        <div class="disclaimer-box" role="note" aria-label="Fictitious Persons and Entities Disclaimer">
          <strong>Fictitious Persons, Bands &amp; Entities Disclaimer:</strong> All narrative characters, bands (including The Stardust Engine, Fractured Prisms, Crimson Node, The Paper Wall, Mana Canvas, The Arctic Symphony Project, and Teller County), biographies, universities (including Commonwealth Polytechnic Institute / CPI, The Forgers, and The Crucible), corporations (including OmniCorp, Apex Records, Prairie Coachworks, and Sainte-Claire), transit agencies (Blue Ridge Transit), in-universe legal filings, and any entity with <strong>&ldquo;LLC&rdquo;</strong>, <strong>&ldquo;Trust&rdquo;</strong>, or <strong>&ldquo;Holdings&rdquo;</strong> in its name (including <em>Engine Room Records, LLC</em>, <em>The O'Connell Family Revocable Trust</em>, <em>The O'Connell Family, LLC</em>, <em>Artists First Management, LLC</em>, <em>Stardust Properties, LLC</em>, <em>Stardust Blacksburg, LLC</em>, <em>Stardust Strategic Assets, LLC</em>, <em>Pacific Rim Properties, LLC</em>, <em>Jessica Miller Center, LLC</em>, and <em>Aethelgard Holdings, LLC</em>) are works of fiction. Any resemblance to actual persons (living or dead), businesses, institutions, or events is purely coincidental. In real life, there is only <strong>Engine Room Records</strong> (no &ldquo;LLC&rdquo;), the real-world creative brand of <strong>Michael P. Ragsdale</strong>.
        </div>
        <p style="margin: 0;">
          &copy; 2026 Michael P. Ragsdale / RaggieSoft. Code licensed under the
          <a href="https://opensource.org/licenses/MIT" target="_blank" rel="noopener noreferrer">MIT License</a>.
          Creative content licensed under
          <a href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank" rel="noopener noreferrer">CC BY-SA 4.0</a>.
        </p>
      </div>
    </footer>

    <script src="https://assets.raggiesoft.com/nebulae/js/nebulae-client.js" defer></script>
    <script src="https://assets.raggiesoft.com/common/js/raggiesoft-network.js?v=20261017g" defer></script>
  </body>
</html>`;
}

function buildSitemapXml(constellations) {
  const today = new Date().toISOString().split('T')[0];
  const urls = [];
  for (const c of constellations) {
    for (const r of c.routes) {
      const fullUrl = `${c.baseUrl}${r.path === '/' ? '' : r.path}`;
      urls.push(
        `  <url>\n    <loc>${escapeHtml(fullUrl)}</loc>\n    <lastmod>${today}</lastmod>\n  </url>`
      );
    }
  }
  return `<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n${urls.join('\n')}\n</urlset>\n`;
}

function buildNebulaeSite() {
  const constellations = collectConstellations();
  const totalRoutes = constellations.reduce((sum, c) => sum + c.routes.length, 0);

  const indexHtml = buildNebulaeIndexHtml(constellations);
  const cssContent = renderNebulaeCss();
  const jsContent = renderNebulaeClientJs();
  const sitemapXml = buildSitemapXml(constellations);
  const robotsTxt = `User-agent: *\nAllow: /\nSitemap: https://nebulae.raggiesoft.com/sitemap.xml\n`;

  for (const base of [projectRoot, path.join(projectRoot, 'dist')]) {
    fs.mkdirSync(path.join(base, 'assets'), { recursive: true });
    fs.writeFileSync(path.join(base, 'index.html'), indexHtml, 'utf-8');
    fs.writeFileSync(path.join(base, 'assets', 'nebulae.css'), cssContent, 'utf-8');
    fs.writeFileSync(path.join(base, 'assets', 'nebulae-client.js'), jsContent, 'utf-8');
    fs.writeFileSync(path.join(base, 'sitemap.xml'), sitemapXml, 'utf-8');
    fs.writeFileSync(path.join(base, 'robots.txt'), robotsTxt, 'utf-8');
  }

  const sharedCdnCssDir = path.join(workspaceRoot, 'raggiesoft-assets', 'nebulae', 'css');
  const sharedCdnJsDir = path.join(workspaceRoot, 'raggiesoft-assets', 'nebulae', 'js');
  fs.mkdirSync(sharedCdnCssDir, { recursive: true });
  fs.mkdirSync(sharedCdnJsDir, { recursive: true });
  fs.writeFileSync(path.join(sharedCdnCssDir, 'nebulae.css'), cssContent, 'utf-8');
  fs.writeFileSync(path.join(sharedCdnJsDir, 'nebulae-client.js'), jsContent, 'utf-8');

  console.log(
    `✅ Built nebulae.raggiesoft.com Master Cosmic Observatory (${constellations.length} constellations, ${totalRoutes} routes indexed).`
  );
}

buildNebulaeSite();

if (process.argv.includes('--serve')) {
  const port = Number(process.env.PORT || 4324);
  const server = http.createServer((req, res) => {
    const urlPath = (req.url || '/').split('?')[0];
    let filePath = path.join(projectRoot, urlPath === '/' ? 'index.html' : urlPath);
    if (!fs.existsSync(filePath)) {
      filePath = path.join(projectRoot, 'index.html');
    }
    const ext = path.extname(filePath);
    const mime =
      ext === '.css'
        ? 'text/css; charset=utf-8'
        : ext === '.js'
          ? 'application/javascript; charset=utf-8'
          : ext === '.xml'
            ? 'application/xml; charset=utf-8'
            : 'text/html; charset=utf-8';
    res.writeHead(200, { 'Content-Type': mime });
    res.end(fs.readFileSync(filePath));
  });
  server.listen(port, () => {
    console.log(`🚀 Nebulae Observatory preview server running at http://localhost:${port}`);
  });
}

