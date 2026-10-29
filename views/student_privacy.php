<?php
require_once '../includes/session_check.php';
checkAccess(['student'], '../auth/login.php');

$pageTitle = 'Student Privacy | APEX Learning Hub';
$extraCss = ['../css/admin.css?v=202610291355', '../css/student.css?v=202610292118'];
$extraJs = '../js/student.js?v=202610291930';
$bodyClass = 'admin-dashboard student-dashboard';
$useVisualTheme = true;
$studentPage = 'privacy';
require_once '../includes/header.php';
?>

<div class="student-dashboard-shell" id="studentDashboardShell">
    <?php require '../includes/student_sidebar.php'; ?>
    <div class="container student-dashboard-content">
        <header class="student-page-header">
            <span class="student-eyebrow">Student portal</span>
            <h1>Student Privacy</h1>
            <p>This notice explains how information connected to your APEX Learning Hub student account is used within the portal.</p>
        </header>

        <div class="student-page-list student-privacy-content">
            <section class="student-overview-card student-privacy-section">
                <h2>Information used in your account</h2>
                <p>The portal uses account details such as your name, institutional email, and student ID, along with information about your course enrollments, applications, class schedule, assignments, completion status, and announcements relevant to your courses.</p>
            </section>

            <section class="student-overview-card student-privacy-section">
                <h2>Why this information is used</h2>
                <p>This information supports student portal features, including displaying your courses and schedule, managing enrollment requests, showing assignments and announcements, and maintaining your profile.</p>
            </section>

            <section class="student-overview-card student-privacy-section">
                <h2>Access to student information</h2>
                <p>Information is available through the portal according to account roles and the features needed for academic and administrative work. Course-related information may be visible to the instructors responsible for those courses and authorized school staff.</p>
            </section>

            <section class="student-overview-card student-privacy-section">
                <h2>Keeping your account details current</h2>
                <p>You can review and update editable profile details from My Profile. Institutional account information managed by the school may need to be corrected by the appropriate school administrator.</p>
            </section>

            <section class="student-overview-card student-privacy-section">
                <h2>Questions or requests</h2>
                <p>For questions about your student information or requests to review or correct it, contact your school’s registrar or the administrator responsible for APEX Learning Hub.</p>
            </section>
        </div>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>
