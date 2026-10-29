<div class="lang-wrapper global-language-control">
    <button id="langBtn" class="lang-btn" type="button" aria-haspopup="listbox" aria-expanded="false"
        title="Change Language" aria-label="Change language">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>
        <span id="langLabel">English</span>
        <svg class="chevron-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"
            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
            aria-hidden="true">
            <path d="M1 1l4 4 4-4"></path>
        </svg>
    </button>
    <div id="langDropdown" class="lang-dropdown" role="listbox">
        <button type="button" class="lang-option selected" data-lang="en" role="option">
            <span>English</span>
            <span class="lang-tag">EN</span>
        </button>
        <button type="button" class="lang-option" data-lang="fil" role="option">
            <span>Filipino</span>
            <span class="lang-tag">FIL</span>
        </button>
    </div>
</div>
