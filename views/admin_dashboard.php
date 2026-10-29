<?php
require_once '../includes/session_check.php';
checkAccess(['admin'], '../auth/login.php');
require_once '../config/db.php';
require_once '../includes/admin_account_helpers.php';

$pageTitle = 'Admin Dashboard | APEX Learning Hub';
$extraCss = ['../css/admin.css?v=202610292250', '../css/student.css?v=202610292224'];
$extraJs = '../js/admin.js?v=202610292245';
$bodyClass = 'admin-dashboard student-dashboard admin-portal';
$useVisualTheme = true;
$hideSharedSearch = true;
$adminPage = 'dashboard';
$csrfToken = adminCsrfToken();

$summaryStmt = $pdo->query("
    SELECT
        SUM(role IN ('dean', 'professor', 'student') AND is_active = 1 AND archived_at IS NULL) AS active_users,
        SUM(role = 'registrar' AND is_active = 1 AND archived_at IS NULL) AS active_registrars,
        SUM((is_active = 0 OR archived_at IS NOT NULL) AND role <> 'admin') AS restricted_users
    FROM users
");
$summary = $summaryStmt->fetch();
$message = trim($_GET['msg'] ?? '');
$error = trim($_GET['error'] ?? '');

require_once '../includes/header.php';
?>

<div class="student-dashboard-shell" id="studentDashboardShell">
    <?php require '../includes/admin_sidebar.php'; ?>
    <div class="student-dashboard-content container">
        <section class="dashboard-header admin-portal-heading">
            <div class="dashboard-title">
                <h1>Admin Dashboard</h1>
                <p>Welcome, <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?>. Manage registrar access and user accounts.</p>
            </div>
            <button type="button" class="btn btn-primary" data-open-modal="createRegistrarModal">
                Create Registrar Account
            </button>
        </section>

        <?php if ($message !== ''): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <?php if ($error !== ''): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <section class="metrics-grid admin-summary-grid" aria-label="Account overview">
            <article class="metric-card">
                <div class="metric-icon navy" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1M16 5.5a3 3 0 0 1 0 5.8M18 14a5 5 0 0 1 3 4.5V20"/></svg>
                </div>
                <div class="metric-data">
                    <h3><?= number_format((int) ($summary['active_users'] ?? 0)) ?></h3>
                    <p>Active Deans, Professors &amp; Students</p>
                </div>
            </article>
            <article class="metric-card">
                <div class="metric-icon teal" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM20 8v6M23 11h-6"/></svg>
                </div>
                <div class="metric-data">
                    <h3><?= number_format((int) ($summary['active_registrars'] ?? 0)) ?></h3>
                    <p>Active Registrar Accounts</p>
                </div>
            </article>
            <article class="metric-card">
                <div class="metric-icon coral" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 9h18M8 13h8M8 17h5"/></svg>
                </div>
                <div class="metric-data">
                    <h3><?= number_format((int) ($summary['restricted_users'] ?? 0)) ?></h3>
                    <p>Disabled or Archived Accounts</p>
                </div>
            </article>
        </section>

        <section class="card admin-portal-shortcuts" aria-labelledby="admin-actions-title">
            <div>
                <h2 class="card-title" id="admin-actions-title">Account Administration</h2>
                <p>Manage registrar-created accounts, or review records that have been disabled or archived.</p>
            </div>
            <div class="admin-portal-shortcut-actions">
                <a class="btn btn-outline" href="admin_users.php">Manage User Accounts</a>
                <a class="btn btn-outline" href="admin_accounts.php">View Disabled &amp; Archived</a>
            </div>
        </section>
    </div>
</div>
<button type="button" class="student-sidebar-backdrop" aria-label="Close admin navigation"></button>
<button type="button" class="student-mobile-toggle" aria-label="Open admin navigation"
    aria-controls="studentSidebar" aria-expanded="false">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
</button>

<div class="modal-backdrop" id="createRegistrarModal">
    <div class="modal-dialog">
        <form action="../api/admin_accounts_process.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
            <input type="hidden" name="action" value="create_registrar">
            <div class="modal-header">
                <h2 class="modal-title">Create Registrar Account</h2>
                <button type="button" class="modal-close" data-close-modal aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="admin-form-name-grid">
                    <div class="form-group">
                        <label for="registrarFirstName">First Name</label>
                        <input class="form-control" id="registrarFirstName" name="first_name" maxlength="50" autocomplete="given-name" required>
                    </div>
                    <div class="form-group">
                        <label for="registrarLastName">Last Name</label>
                        <input class="form-control" id="registrarLastName" name="last_name" maxlength="50" autocomplete="family-name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="registrarEmail">Email</label>
                    <input class="form-control" type="email" id="registrarEmail" name="email" maxlength="100" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="registrarPassword">Temporary Password</label>
                    <input class="form-control" type="password" id="registrarPassword" name="password" minlength="8" maxlength="72"
                        autocomplete="new-password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9\s]).{8,72}" required>
                    <small class="text-muted">Use 8–72 characters with uppercase and lowercase letters, a number, and a symbol.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-close-modal>Cancel</button>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
