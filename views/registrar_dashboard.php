<?php
require_once '../includes/session_check.php';
checkAccess(['registrar'], '../auth/login.php');
require_once '../config/db.php';

$pageTitle = 'Registrar Workspace | APEX Learning Hub';
$extraCss  = '../css/admin.css?v=202610291355';
$extraJs   = '../js/admin.js';
$bodyClass = 'admin-dashboard';
$useVisualTheme = true;

$msg   = $_GET['msg'] ?? '';
$error = $_GET['error'] ?? '';

$studentCount = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'student'")->fetchColumn();
$profCount    = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'professor'")->fetchColumn();
$courseCount  = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$pendingCount = $pdo->query("SELECT COUNT(*) FROM enrollments WHERE status = 'PENDING'")->fetchColumn();

$coursesStmt = $pdo->query("
    SELECT c.*, 
           u.first_name AS prof_first, u.last_name AS prof_last, u.email AS prof_email,
           (SELECT COUNT(*) FROM enrollments e WHERE e.course_id = c.id AND e.status = 'APPROVED') AS enrolled_students
    FROM courses c
    LEFT JOIN users u ON c.professor_id = u.id
    ORDER BY c.course_code ASC
");
$courses = $coursesStmt->fetchAll();

$usersStmt = $pdo->query("SELECT * FROM users ORDER BY role ASC, created_at DESC");
$allUsers  = $usersStmt->fetchAll();

$profListStmt = $pdo->query("SELECT id, first_name, last_name, email FROM users WHERE role = 'professor' ORDER BY last_name ASC");
$professors   = $profListStmt->fetchAll();

$enrollmentStmt = $pdo->query("
    SELECT e.id AS enrollment_id, e.status, e.applied_at, e.decided_at,
           s.first_name AS student_first, s.last_name AS student_last, s.email AS student_email,
           c.course_code, c.course_name,
           p.first_name AS prof_first, p.last_name AS prof_last
    FROM enrollments e
    JOIN users s ON e.student_id = s.id
    JOIN courses c ON e.course_id = c.id
    LEFT JOIN users p ON c.professor_id = p.id
    ORDER BY e.applied_at DESC
");
$enrollments = $enrollmentStmt->fetchAll();

$announcementStmt = $pdo->query("
    SELECT a.*, u.first_name, u.last_name, u.role, c.course_code
    FROM announcements a
    JOIN users u ON a.author_id = u.id
    LEFT JOIN courses c ON a.course_id = c.id
    ORDER BY a.created_at DESC
");
$announcements = $announcementStmt->fetchAll();

require_once '../includes/header.php';
?>

<div class="container">
    <div class="dashboard-header">
        <div class="dashboard-title">
            <h1>APEX Hub Registrar Workspace</h1>
            <p>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?> &bull; Registrar Control Panel</p>
        </div>
        <div style="display:flex; gap:0.5rem;">
            <button type="button" class="btn btn-primary registrar-action-btn" data-open-modal="addCourseModal">
                + New Course
            </button>
            <button type="button" class="btn btn-teal registrar-action-btn" data-open-modal="addUserModal">
                + New User
            </button>
            <button type="button" class="btn btn-coral registrar-action-btn" data-open-modal="addAnnouncementModal">
                + Announcement
            </button>
        </div>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-icon navy" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="m3 9 9-5 9 5-9 5-9-5Z"/><path d="M7 11.2V16c2.8 2.4 7.2 2.4 10 0v-4.8M21 9v6"/></svg>
            </div>
            <div class="metric-data">
                <h3><?= number_format($studentCount) ?></h3>
                <p>Enrolled Students</p>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon teal" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 20v-1a6 6 0 0 1 12 0v1M16 5.5a3 3 0 0 1 0 5.8M18 14a5 5 0 0 1 3 4.5V20"/></svg>
            </div>
            <div class="metric-data">
                <h3><?= number_format($profCount) ?></h3>
                <p>Faculty Professors</p>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon coral" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v17H6.5A2.5 2.5 0 0 1 4 17.5z"/><path d="M4 17.5A2.5 2.5 0 0 1 6.5 15H20M8 7h8"/></svg>
            </div>
            <div class="metric-data">
                <h3><?= number_format($courseCount) ?></h3>
                <p>Curriculum Courses</p>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon gold" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
            </div>
            <div class="metric-data">
                <h3><?= number_format($pendingCount) ?></h3>
                <p>Pending Applications</p>
            </div>
        </div>
    </div>

    
    <div class="tab-navigation">
        <button type="button" class="tab-btn active" data-target="tabCourses">
            Courses <span class="tab-badge"><?= count($courses) ?></span>
        </button>
        <button type="button" class="tab-btn" data-target="tabUsers">
            Users &amp; Faculty <span class="tab-badge"><?= count($allUsers) ?></span>
        </button>
        <button type="button" class="tab-btn" data-target="tabEnrollments">
            Enrollment Applications <span class="tab-badge"><?= count($enrollments) ?></span>
        </button>
        <button type="button" class="tab-btn" data-target="tabAnnouncements">
            Announcements <span class="tab-badge"><?= count($announcements) ?></span>
        </button>
    </div>

    
    <div class="tab-panel active" id="tabCourses">
        <div class="card">
            <div class="table-toolbar">
                <div class="search-box">
                    <input type="text" placeholder="Search courses or codes..." data-table-search="coursesTable">
                </div>
                <div>
                    <button class="btn btn-primary btn-sm" data-open-modal="addCourseModal">+ Create Course</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table" id="coursesTable">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Course &amp; Schedule</th>
                            <th>Assigned Professor</th>
                            <th>Enrollment / Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($courses)): ?>
                            <tr><td colspan="5" style="text-align:center; padding:2rem;">No courses created yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($courses as $c): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($c['course_code']) ?></strong></td>
                                    <td>
                                        <strong><?= htmlspecialchars($c['course_name']) ?></strong>
                                        <div class="text-muted" style="font-size:0.75rem;">
                                            <?= !empty($c['meeting_days'])
                                                ? htmlspecialchars(str_replace(',', ' · ', $c['meeting_days'])) . ' · ' . date('g:i A', strtotime($c['start_time'])) . '–' . date('g:i A', strtotime($c['end_time']))
                                                : 'Schedule not set' ?>
                                            <?= !empty($c['room']) ? ' · ' . htmlspecialchars($c['room']) : '' ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($c['prof_first'])): ?>
                                            <?= htmlspecialchars($c['prof_first'] . ' ' . $c['prof_last']) ?>
                                            <div class="text-muted" style="font-size:0.75rem;"><?= htmlspecialchars($c['prof_email']) ?></div>
                                        <?php else: ?>
                                            <span class="badge" style="background:#eee; color:#666;">Unassigned</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div style="font-size:0.85rem; font-weight:600; margin-bottom:4px;">
                                            <?= (int)$c['enrolled_students'] ?> / <?= (int)$c['max_capacity'] ?> Enrolled
                                        </div>
                                        <div class="capacity-meter">
                                            <?php 
                                            $pct = $c['max_capacity'] > 0 ? min(100, round(($c['enrolled_students'] / $c['max_capacity']) * 100)) : 0; 
                                            ?>
                                            <div class="capacity-fill <?= $pct >= 90 ? 'high' : '' ?>" style="width: <?= $pct ?>%;"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline btn-sm course-schedule-edit"
                                            data-open-modal="courseScheduleModal"
                                            data-course-id="<?= (int) $c['id'] ?>"
                                            data-course-name="<?= htmlspecialchars($c['course_code'] . ' · ' . $c['course_name'], ENT_QUOTES) ?>"
                                            data-days="<?= htmlspecialchars($c['meeting_days'] ?? '', ENT_QUOTES) ?>"
                                            data-start="<?= htmlspecialchars(substr((string) ($c['start_time'] ?? ''), 0, 5), ENT_QUOTES) ?>"
                                            data-end="<?= htmlspecialchars(substr((string) ($c['end_time'] ?? ''), 0, 5), ENT_QUOTES) ?>"
                                            data-room="<?= htmlspecialchars($c['room'] ?? '', ENT_QUOTES) ?>">
                                            Set Schedule
                                        </button>
                                        <form action="../api/admin_process.php" method="POST" style="display:inline;" onsubmit="return confirm('Delete this course? Students enrolled will be affected.');">
                                            <input type="hidden" name="action" value="delete_course">
                                            <input type="hidden" name="course_id" value="<?= $c['id'] ?>">
                                            <button type="submit" class="btn btn-outline btn-sm" style="color:var(--coral-dark);">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="tab-panel" id="tabUsers">
        <div class="card">
            <div class="table-toolbar">
                <div class="search-box">
                    <input type="text" placeholder="Search user by name or email..." data-table-search="usersTable">
                </div>
                <div>
                    <button class="btn btn-teal btn-sm" data-open-modal="addUserModal">+ Add User Account</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table" id="usersTable">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allUsers as $u): ?>
                            <tr>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="avatar-mini"><?= strtoupper(substr($u['first_name'], 0, 1)) ?></div>
                                        <div>
                                            <strong><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></strong>
                                            <?php if ($u['id'] == $_SESSION['user_id']): ?>
                                                <span style="font-size:0.7rem; color:var(--teal); font-weight:700;">(You)</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td>
                                    <span class="role-pill role-<?= htmlspecialchars($u['role']) ?>">
                                        <?= htmlspecialchars($u['role'] === 'admin' ? 'Registrar' : ucfirst($u['role'])) ?>
                                    </span>
                                </td>
                                <td style="font-size:0.8rem; color:var(--text-muted);">
                                    <?= date('M d, Y', strtotime($u['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($u['id'] != $_SESSION['user_id']): ?>
                                        <form action="../api/admin_process.php" method="POST" style="display:inline;" onsubmit="return confirm('Permanently remove this user account?');">
                                            <input type="hidden" name="action" value="delete_user">
                                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                            <button type="submit" class="btn btn-outline btn-sm" style="color:var(--coral-dark);">Delete</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size:0.8rem;">Current <?= $u['role'] === 'registrar' ? 'Registrar' : 'Administrator' ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="tab-panel" id="tabEnrollments">
        <div class="card">
            <div class="table-toolbar">
                <div class="search-box">
                    <input type="text" placeholder="Search student or course..." data-table-search="enrollmentsTable">
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table" id="enrollmentsTable">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Target Course</th>
                            <th>Instructor</th>
                            <th>Status</th>
                            <th>Applied Date</th>
                            <th>Registrar Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($enrollments)): ?>
                            <tr><td colspan="6" style="text-align:center; padding:2rem;">No enrollment records found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($enrollments as $e): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($e['student_first'] . ' ' . $e['student_last']) ?></strong>
                                        <div class="text-muted" style="font-size:0.75rem;"><?= htmlspecialchars($e['student_email']) ?></div>
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($e['course_code']) ?></strong> - <?= htmlspecialchars($e['course_name']) ?>
                                    </td>
                                    <td>Prof. <?= htmlspecialchars($e['prof_first'] . ' ' . $e['prof_last']) ?></td>
                                    <td>
                                        <span class="badge badge-<?= strtolower($e['status']) ?>">
                                            <?= htmlspecialchars($e['status']) ?>
                                        </span>
                                    </td>
                                    <td style="font-size:0.8rem;"><?= date('M d, Y h:i A', strtotime($e['applied_at'])) ?></td>
                                    <td>
                                        <form action="../api/admin_process.php" method="POST" style="display:inline-flex; gap:0.25rem;">
                                            <input type="hidden" name="action" value="update_enrollment">
                                            <input type="hidden" name="enrollment_id" value="<?= $e['enrollment_id'] ?>">
                                            <?php if ($e['status'] !== 'APPROVED'): ?>
                                                <button type="submit" name="status" value="APPROVED" class="btn btn-success btn-sm">Approve</button>
                                            <?php endif; ?>
                                            <?php if ($e['status'] !== 'REJECTED'): ?>
                                                <button type="submit" name="status" value="REJECTED" class="btn btn-danger btn-sm">Reject</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="tab-panel" id="tabAnnouncements">
        <div class="card">
            <div class="table-toolbar">
                <div class="card-title" style="margin:0;">Broadcasts &amp; Bulletins</div>
                <button class="btn btn-coral btn-sm" data-open-modal="addAnnouncementModal">+ Post Announcement</button>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Announcement Title</th>
                            <th>Scope / Course</th>
                            <th>Author</th>
                            <th>Date Posted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($announcements)): ?>
                            <tr><td colspan="5" style="text-align:center; padding:2rem;">No announcements active.</td></tr>
                        <?php else: ?>
                            <?php foreach ($announcements as $a): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($a['title']) ?></strong>
                                        <p style="font-size:0.85rem; color:var(--text-muted); margin-top:3px;">
                                            <?= nl2br(htmlspecialchars($a['message'])) ?>
                                        </p>
                                    </td>
                                    <td>
                                        <?php if ($a['course_code']): ?>
                                            <span class="role-pill role-professor"><?= htmlspecialchars($a['course_code']) ?></span>
                                        <?php else: ?>
                                            <span class="role-pill role-admin">Global Campus</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($a['first_name'] . ' ' . $a['last_name']) ?></td>
                                    <td style="font-size:0.8rem;"><?= date('M d, Y h:i A', strtotime($a['created_at'])) ?></td>
                                    <td>
                                        <form action="../api/admin_process.php" method="POST" style="display:inline;" onsubmit="return confirm('Remove this announcement?');">
                                            <input type="hidden" name="action" value="delete_announcement">
                                            <input type="hidden" name="announcement_id" value="<?= $a['id'] ?>">
                                            <button type="submit" class="btn btn-outline btn-sm" style="color:var(--coral-dark);">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal-backdrop" id="addCourseModal">
    <div class="modal-dialog">
        <form action="../api/admin_process.php" method="POST">
            <input type="hidden" name="action" value="add_course">
            <div class="modal-header">
                <h3 class="modal-title">Create New Academic Course</h3>
                <button type="button" class="modal-close" data-close-modal>&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="course_code">Course Code *</label>
                    <input type="text" id="course_code" name="course_code" class="form-control" placeholder="e.g. CS101" required>
                </div>
                <div class="form-group">
                    <label for="course_name">Course Name *</label>
                    <input type="text" id="course_name" name="course_name" class="form-control" placeholder="e.g. Introduction to Computing" required>
                </div>
                <div class="form-group">
                    <label for="professor_id">Assign Faculty Instructor</label>
                    <select id="professor_id" name="professor_id" class="form-control">
                        <option value="">-- Select Professor (Optional) --</option>
                        <?php foreach ($professors as $p): ?>
                            <option value="<?= $p['id'] ?>">Prof. <?= htmlspecialchars($p['first_name'] . ' ' . $p['last_name']) ?> (<?= htmlspecialchars($p['email']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="max_capacity">Maximum Student Capacity</label>
                    <input type="number" id="max_capacity" name="max_capacity" class="form-control" value="30" min="1" max="100">
                </div>
                <fieldset class="course-days-fieldset">
                    <legend>Meeting Days (Optional)</legend>
                    <div class="course-days-options">
                        <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                            <label><input type="checkbox" name="meeting_days[]" value="<?= $day ?>"> <?= substr($day, 0, 3) ?></label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <div class="course-schedule-fields">
                    <div class="form-group">
                        <label for="new_course_start">Start Time</label>
                        <input type="time" id="new_course_start" name="start_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_course_end">End Time</label>
                        <input type="time" id="new_course_end" name="end_time" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_course_room">Room / Location</label>
                    <input type="text" id="new_course_room" name="room" class="form-control" maxlength="100">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-close-modal>Cancel</button>
                <button type="submit" class="btn btn-primary">Create Course</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-backdrop" id="courseScheduleModal">
    <div class="modal-dialog">
        <form action="../api/admin_process.php" method="POST">
            <input type="hidden" name="action" value="update_course_schedule">
            <input type="hidden" id="schedule_course_id" name="course_id">
            <div class="modal-header">
                <h3 class="modal-title">Set Course Schedule</h3>
                <button type="button" class="modal-close" data-close-modal>&times;</button>
            </div>
            <div class="modal-body">
                <p id="schedule_course_name" class="text-muted"></p>
                <fieldset class="course-days-fieldset">
                    <legend>Meeting Days</legend>
                    <div class="course-days-options">
                        <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                            <label><input type="checkbox" name="meeting_days[]" value="<?= $day ?>"> <?= substr($day, 0, 3) ?></label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <div class="course-schedule-fields">
                    <div class="form-group">
                        <label for="schedule_start_time">Start Time</label>
                        <input type="time" id="schedule_start_time" name="start_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="schedule_end_time">End Time</label>
                        <input type="time" id="schedule_end_time" name="end_time" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="schedule_room">Room / Location</label>
                    <input type="text" id="schedule_room" name="room" class="form-control" maxlength="100">
                </div>
                <p class="text-muted">Leave all schedule fields empty to mark the course schedule as TBA.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-close-modal>Cancel</button>
                <button type="submit" class="btn btn-primary">Save Schedule</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-backdrop" id="addUserModal">
    <div class="modal-dialog">
        <form action="../api/admin_process.php" method="POST">
            <input type="hidden" name="action" value="add_user">
            <div class="modal-header">
                <h3 class="modal-title">Create User Account</h3>
                <button type="button" class="modal-close" data-close-modal>&times;</button>
            </div>
            <div class="modal-body">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
                    <div class="form-group">
                        <label for="user_fn">First Name *</label>
                        <input type="text" id="user_fn" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="user_ln">Last Name *</label>
                        <input type="text" id="user_ln" name="last_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_email">Institutional Email *</label>
                    <input type="email" id="user_email" name="email" class="form-control" placeholder="user@apex.edu.ph" required>
                </div>
                <div class="form-group">
                    <label for="user_role">Account Role *</label>
                    <select id="user_role" name="role" class="form-control" required>
                        <option value="student">Student</option>
                        <option value="professor">Professor</option>
                        <option value="dean">Dean</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_pass">Initial Password *</label>
                    <input type="password" id="user_pass" name="password" class="form-control"
                        placeholder="8+ characters, upper/lowercase, number, symbol"
                        minlength="8" maxlength="72"
                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9\s]).{8,72}"
                        title="Use at least 8 characters with an uppercase letter, a lowercase letter, a number, and a special character."
                        autocomplete="new-password" required>
                    <small class="text-muted">Use at least 8 characters, including uppercase and lowercase letters, a number, and a special character.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-close-modal>Cancel</button>
                <button type="submit" class="btn btn-teal">Add User Account</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-backdrop" id="addAnnouncementModal">
    <div class="modal-dialog">
        <form action="../api/admin_process.php" method="POST">
            <input type="hidden" name="action" value="post_announcement">
            <div class="modal-header">
                <h3 class="modal-title">Publish Campus Announcement</h3>
                <button type="button" class="modal-close" data-close-modal>&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="ann_title">Announcement Title *</label>
                    <input type="text" id="ann_title" name="title" class="form-control" placeholder="e.g. Midterm Schedule Advisory" required>
                </div>
                <div class="form-group">
                    <label for="ann_course">Target Audience</label>
                    <select id="ann_course" name="course_id" class="form-control">
                        <option value="">-- All Students (Global Campus Broadcast) --</option>
                        <?php foreach ($courses as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['course_code']) ?>: <?= htmlspecialchars($c['course_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ann_message">Announcement Content *</label>
                    <textarea id="ann_message" name="message" class="form-control" rows="4" placeholder="Enter message details here..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-close-modal>Cancel</button>
                <button type="submit" class="btn btn-coral">Broadcast Now</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
