<?php
require_once '../includes/session_check.php';
checkAccess(['student'], '../auth/login.php');
require_once '../config/db.php';

$studentId = (int) $_SESSION['user_id'];
$assignmentsStmt = $pdo->prepare("
    SELECT a.id, a.title, a.description, a.due_at, c.course_code, c.course_name,
           ac.completed_at
    FROM assignments a
    JOIN courses c ON c.id = a.course_id
    JOIN enrollments e ON e.course_id = c.id AND e.student_id = :enrolled_student_id AND e.status = 'APPROVED'
    LEFT JOIN assignment_completions ac ON ac.assignment_id = a.id AND ac.student_id = :completed_student_id
    ORDER BY (ac.completed_at IS NOT NULL), a.due_at ASC
");
$assignmentsStmt->execute([
    'enrolled_student_id' => $studentId,
    'completed_student_id' => $studentId,
]);
$assignments = $assignmentsStmt->fetchAll();
$pendingAssignments = array_values(array_filter($assignments, static fn($assignment) => !$assignment['completed_at']));
$completedAssignments = array_values(array_filter($assignments, static fn($assignment) => $assignment['completed_at']));

$applicationsStmt = $pdo->prepare("
    SELECT e.id, e.status, e.applied_at, c.course_code, c.course_name
    FROM enrollments e
    JOIN courses c ON c.id = e.course_id
    WHERE e.student_id = :student_id AND e.status = 'PENDING'
    ORDER BY e.applied_at ASC
");
$applicationsStmt->execute(['student_id' => $studentId]);
$pendingApplications = $applicationsStmt->fetchAll();
$studentPendingTaskCount = count($pendingAssignments) + count($pendingApplications);

$announcementCountStmt = $pdo->prepare("
    SELECT COUNT(*)
    FROM announcements a
    WHERE a.course_id IS NULL
       OR EXISTS (
            SELECT 1 FROM enrollments e
            WHERE e.course_id = a.course_id
              AND e.student_id = :student_id
              AND e.status = 'APPROVED'
       )
");
$announcementCountStmt->execute(['student_id' => $studentId]);
$studentAnnouncementCount = (int) $announcementCountStmt->fetchColumn();

$pageTitle = 'Pending Tasks | APEX Learning Hub';
$extraCss = ['../css/admin.css?v=202610291355', '../css/student.css?v=202610292118'];
$extraJs = '../js/student.js?v=202610291930';
$bodyClass = 'admin-dashboard student-dashboard';
$useVisualTheme = true;
$studentPage = 'tasks';
require_once '../includes/header.php';
?>

<div class="student-dashboard-shell" id="studentDashboardShell">
    <?php require '../includes/student_sidebar.php'; ?>
    <div class="container student-dashboard-content">
        <header class="student-page-header">
            <span class="student-eyebrow">Stay on track</span>
            <h1>Pending Tasks</h1>
            <p>Assignments for your enrolled courses and enrollment decisions still in progress.</p>
        </header>

        <section class="student-page-list">
            <div class="student-list-section-heading">
                <h2>Assignments to complete <span class="tab-badge"><?= count($pendingAssignments) ?></span></h2>
            </div>
            <?php if (empty($pendingAssignments)): ?>
                <div class="student-overview-card student-empty-state">
                    <p>No assignments are currently waiting for you.</p>
                </div>
            <?php else: ?>
                <?php foreach ($pendingAssignments as $assignment): ?>
                    <article class="student-overview-card student-task-full">
                        <form action="../api/student_process.php" method="POST" class="student-task-check-form">
                            <input type="hidden" name="action" value="complete_assignment">
                            <input type="hidden" name="assignment_id" value="<?= (int) $assignment['id'] ?>">
                            <button type="submit" class="student-check-empty" aria-label="Mark assignment complete"></button>
                        </form>
                        <div class="student-task-full-copy">
                            <span class="student-eyebrow"><?= htmlspecialchars($assignment['course_code']) ?></span>
                            <h3><?= htmlspecialchars($assignment['title']) ?></h3>
                            <?php if ($assignment['description'] !== ''): ?>
                                <p><?= nl2br(htmlspecialchars($assignment['description'])) ?></p>
                            <?php endif; ?>
                        </div>
                        <time class="student-task-due<?= strtotime($assignment['due_at']) < time() ? ' overdue' : '' ?>"
                            datetime="<?= htmlspecialchars(date('c', strtotime($assignment['due_at']))) ?>">
                            Due <?= date('M j, Y · g:i A', strtotime($assignment['due_at'])) ?>
                        </time>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="student-list-section-heading">
                <h2>Enrollment decisions <span class="tab-badge"><?= count($pendingApplications) ?></span></h2>
            </div>
            <?php if (empty($pendingApplications)): ?>
                <div class="student-overview-card student-empty-state">
                    <p>No enrollment applications are awaiting a decision.</p>
                </div>
            <?php else: ?>
                <?php foreach ($pendingApplications as $application): ?>
                    <article class="student-overview-card student-task-full">
                        <span class="student-check-empty student-check-static" aria-hidden="true"></span>
                        <div class="student-task-full-copy">
                            <span class="student-eyebrow"><?= htmlspecialchars($application['course_code']) ?></span>
                            <h3>Enrollment decision pending</h3>
                            <p><?= htmlspecialchars($application['course_name']) ?> · Applied <?= date('M j, Y', strtotime($application['applied_at'])) ?></p>
                        </div>
                        <span class="student-task-status">Awaiting review</span>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($completedAssignments)): ?>
                <details class="student-completed-tasks">
                    <summary>Completed assignments (<?= count($completedAssignments) ?>)</summary>
                    <?php foreach ($completedAssignments as $assignment): ?>
                        <div class="student-completed-task">
                            <span aria-hidden="true">✓</span>
                            <strong><?= htmlspecialchars($assignment['title']) ?></strong>
                            <small><?= htmlspecialchars($assignment['course_code']) ?></small>
                        </div>
                    <?php endforeach; ?>
                </details>
            <?php endif; ?>
        </section>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>
