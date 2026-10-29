<?php
$visualBase = $visualBase ?? '';
$activePage = $activePage ?? '';
?>
<!-- ===== Search & Utility Bar ===== -->
<div class="sub-bar">
    <div class="sub-bar-container">
        <div class="sub-bar-right">
            <div class="sub-search" role="search">
                <svg class="search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    aria-hidden="true">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="globalSearch" placeholder="Search courses, announcements, policies…"
                    autocomplete="off" aria-label="Search site content">
                <button type="button" id="searchClear" class="search-clear-btn" aria-label="Clear search query"
                    style="display:none;">&times;</button>
                <div id="searchResults" class="search-results-dropdown" role="listbox" aria-live="polite"></div>
            </div>

            <?php require __DIR__ . '/../../includes/language_switcher.php'; ?>
        </div>
    </div>
</div>

<!-- ===== Primary Navigation Header ===== -->
<header class="main-header">
    <div class="header-container">
        <div class="header-logo" role="img" aria-label="APEX Learning Hub">
            <svg class="header-logo-mark" viewBox="0 0 504 428" role="img" aria-hidden="true">
                <title>APEX Brand Mark</title>
                <path fill="var(--red-base)" d="M252 0 154 103a19 19 0 0 0-5 13v97L0 361v67h82l120-119v-62l50-49z" />
                <path fill="var(--red-base)" d="m262 13 87 92a15 15 0 0 1 5 12v97l150 147v67h-75L301 301v-53l-39-40z" />
                <path fill="var(--red-base)" d="M213 312h83l118 116h-99l-55-56h-57l-54 56H97z" />
            </svg>
            <div class="header-logo-type">
                <span class="header-wordmark">APEX</span>
                <span class="header-tagline">Learning Hub</span>
            </div>
        </div>

        <nav class="main-nav" id="mainNav" aria-label="Main Site Navigation">
            <a href="<?= htmlspecialchars($visualBase) ?>homepage.php" class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>">
                <span data-lang-en>Home</span>
                <span data-lang-fil>Pangunahing Pahina</span>
            </a>
            <a href="<?= htmlspecialchars($visualBase) ?>announcement.php" class="nav-link <?= $activePage === 'announcement' ? 'active' : '' ?>">
                <span data-lang-en>Announcements</span>
                <span data-lang-fil>Mga Anunsyo</span>
            </a>
            <a href="<?= htmlspecialchars($visualBase) ?>policies.php" class="nav-link <?= $activePage === 'policies' ? 'active' : '' ?>">
                <span data-lang-en>Policies</span>
                <span data-lang-fil>Mga Patakaran</span>
            </a>
            <a href="<?= htmlspecialchars($visualBase) ?>contact.php" class="nav-link <?= $activePage === 'contact' ? 'active' : '' ?>">
                <span data-lang-en>Contact Us</span>
                <span data-lang-fil>Makipag-ugnayan</span>
            </a>
            <a href="<?= htmlspecialchars($visualBase) ?>homepage.php#about" class="nav-link <?= $activePage === 'about' ? 'active' : '' ?>">
                <span data-lang-en>About</span>
                <span data-lang-fil>Tungkol sa Amin</span>
            </a>
        </nav>

        <div class="header-actions">
            <button class="burger-btn" id="menuToggle" aria-label="Toggle Navigation Menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>
