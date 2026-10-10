<?php
/**
 * ARCHITECTURE: Portfolio Header Navigation
 * 
 * This component provides dedicated navigation for the Michael P. Ragsdale
 * portfolio mini-site.
 * 
 * COMPONENTS:
 * 1. Static Navigation Links: Direct links to the Dashboard, Hiring Logistics, 
 *    and external sites like RaggieSoft Media.
 * 2. Resume Link: A stylized link to a PDF resume, utilizing a global CDN base URL.
 * 3. Active State Management: PHP logic determines if the 'Dashboard' link is active
 *    based on the current request URI.
 */

// includes/components/headers/portfolio/header-portfolio.php
// Dedicated navigation for the Michael P. Ragsdale mini-site.

$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$isHub = ($request_uri === '/about/michael-ragsdale');
?>

<!-- PORTFOLIO NAVIGATION CONTAINER -->
<!-- A flex-wrap container ensuring links flow gracefully on smaller screens -->
<div class="d-flex flex-wrap align-items-center gap-2 ms-auto" style="letter-spacing: 0.5px;">
  
  
    <button class="rs-btn" appearance="plain" href="/about/michael-ragsdale" class="<?php echo $isHub ? 'active' : ''; ?>">
        <i slot="start" class="ph ph-house-user me-2"></i>Dashboard
    </button>
  

  
    <!-- ANCHOR LINK -->
    <!-- Navigates to a specific section within the portfolio page -->
    <button class="rs-btn" appearance="plain" href="/about/michael-ragsdale#hiring-logistics">
        <i slot="start" class="ph ph-clipboard-check me-2"></i>Hiring Logistics
    </button>
  

  
    <!-- EXTERNAL DOCUMENT LINK -->
    <!-- Links directly to a PDF resource hosted on the CDN -->
    <button class="rs-btn" appearance="plain" href="<?php echo $cdnBaseUrl; ?>/portfolio/documents/resume/mragsdale-resume.pdf" class="text-primary">
        <i slot="start" class="ph ph-file-pdf me-2"></i>Resume (PDF)
    </button>
  

  
      <button class="rs-btn" appearance="plain" href="/raggiesoft-media" class=" hover-opacity">
        <i slot="start" class="ph ph-arrow-right-from-bracket me-2"></i><span class="small">RaggieSoft Media</span>
      </button>
  

</div>