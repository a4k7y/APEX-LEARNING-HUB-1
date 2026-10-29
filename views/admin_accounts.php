<?php
require_once '../includes/session_check.php';
checkAccess(['admin'], '../auth/login.php');
require_once '../config/db.php';
require_once '../includes/admin_account_helpers.php';

$pageTitle = 'Archived / Disabled Accounts | APEX Learning Hub';
$extraCss = ['../css/admin.css?v=202610292250', '../css/student.css?v=202610292224'];
$extraJs = '../js/admin.js?v=202610292245';
$bodyClass = 'admin-dashboard student-dashboard admin-portal';
$useVisualTheme = true;
$hideSharedSearch = true;
$adminPage = 'accounts';
$csrfToken = adminCsrfToken();

$accountsStmt = $pdo->query("
    SELECT u.id, u.first_name, u.last_name, u.email, u.role, u.created_at,
           u.is_active, u.archived_at,
           creator.first_name AS creator_first_name, creator.last_name AS creator_last_name
    FROM users u
    LEFT JOIN users creator ON creator.id = u.created_by
    WHERE (u.is_active = 0 OR u.archived_at IS NOT NULL)
      AND u.role <> 'admin'
    ORDER BY (u.archived_at IS NOT NULL) DESC, u.last_name, u.first_name
");
$accounts = $accountsStmt->fetchAll();
$message = trim($_GET['msg'] ?? '');
$error = trim($_GET['error'] ?? '');

require_once '../includes/header.php';
?>

<div class="student-dashboard-shell" id="studentDashboardShell">
    <?php require '../includes/admin_sidebar.php'; ?>
    <div class="student-dashboard-content container">
        <section class="dashboard-header admin-portal-heading">
            <div class="dashboard-title">
                <h1>Archived / Disabled Accounts</h1>
                <p>These accounts cannot access the APEX Learning Hub while disabled or archived.</p>
            </div>
        </section>

        <?php if ($message !== ''): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <?php if ($error !== ''): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <section class="card admin-user-table-card" aria-labelledby="restricted-users-title">
            <div class="table-toolbar">
                <div>
                    <h2 class="card-title" id="restricted-users-title">Restricted Account Records</h2>
                    <p class="text-muted"><?= number_format(count($accounts)) ?> disabled or archived account<?= count($accounts) === 1 ? '' : 's' ?></p>
                </div>
                <div class="search-box">
                    <input type="search" placeholder="Search name, email, or role..." aria-label="Search restricted accounts"
                        data-table-search="adminAccountsTable">
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table admin-user-table" id="adminAccountsTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Account Status</th>
                            <th>Created</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$accounts): ?>
                            <tr><td class="admin-table-empty" colspan="8">There are no disabled or archived accounts.</td></tr>
                        <?php else: ?>
                            <?php foreach ($accounts as $account): ?>
                                <?php
                                $displayName = trim($account['first_name'] . ' ' . $account['last_name']);
                                $archived = $account['archived_at'] !== null;
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($account['first_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($account['last_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($account['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><span class="role-pill role-<?= htmlspecialchars($account['role'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(ucfirst($account['role']), ENT_QUOTES, 'UTF-8') ?></span></td>
                                    <td>
                                        <span class="admin-status-pill<?= $archived ? ' archived' : ' disabled' ?>">
                                            <?= $archived ? 'Archived' : 'Disabled' ?>
                                        </span>
                                        <?php if ($archived): ?>
                                            <small class="admin-status-date"><?= htmlspecialchars(date('M j, Y', strtotime($account['archived_at'])), ENT_QUOTES, 'UTF-8') ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars(date('M j, Y', strtotime($account['created_at'])), ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <?= $account['creator_first_name']
                                            ? htmlspecialchars(trim($account['creator_first_name'] . ' ' . $account['creator_last_name']), ENT_QUOTES, 'UTF-8')
                                            : 'Existing account' ?>
                                    </td>
                                    <td>
                                        <form action="../api/admin_accounts_process.php" method="POST"
                                            onsubmit="return confirm('Restore access for <?= htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') ?>?');">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="action" value="restore_user">
                                            <input type="hidden" name="user_id" value="<?= (int) $account['id'] ?>">
                                            <button type="submit" class="btn btn-outline btn-sm">Restore Access</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<button type="button" class="student-sidebar-backdrop" aria-label="Close admin navigation"></button>
<button type="button" class="student-mobile-toggle" aria-label="Open admin navigation"
    aria-controls="studentSidebar" aria-expanded="false">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
</button>

<?php require_once '../includes/footer.php'; ?>
