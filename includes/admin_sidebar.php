<aside class="student-sidebar" id="studentSidebar" aria-label="Admin dashboard navigation">
    <div class="student-sidebar-heading">
        <span class="student-sidebar-title">Admin Portal</span>
        <button type="button" class="student-sidebar-toggle" aria-label="Collapse navigation"
            aria-controls="studentSidebar" aria-expanded="true">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>
    <nav class="student-sidebar-nav" aria-label="Admin sections">
        <a class="student-sidebar-link<?= $adminPage === 'dashboard' ? ' active' : '' ?>" href="admin_dashboard.php">
            <span class="student-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m3 10 9-7 9 7M5 9v11h14V9M9 20v-7h6v7"/></svg></span>
            <span class="student-nav-label">Dashboard</span>
        </a>
        <a class="student-sidebar-link<?= $adminPage === 'users' ? ' active' : '' ?>" href="admin_users.php">
            <span class="student-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1M16 5.5a3 3 0 0 0 0 5.8M18 14a5 5 0 0 1 3 4.5V20"/></svg></span>
            <span class="student-nav-label">User Management</span>
        </a>
        <a class="student-sidebar-link<?= $adminPage === 'accounts' ? ' active' : '' ?>" href="admin_accounts.php">
            <span class="student-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 9h18M8 13h8M8 17h5"/></svg></span>
            <span class="student-nav-label">Archived / Disabled Accounts</span>
        </a>
    </nav>
</aside>
