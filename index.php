<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

require_once 'includes/session_check.php';
checkAccess(['admin', 'registrar', 'dean', 'professor', 'student'], 'auth/login.php');

switch ($_SESSION['role']) {
    case 'admin':
        header("Location: views/admin_dashboard.php");
        break;
    case 'registrar':
        header("Location: views/registrar_dashboard.php");
        break;
    case 'professor':
        header("Location: views/professor_dashboard.php");
        break;
    case 'dean':
        $_SESSION = [];
        session_destroy();
        header("Location: auth/login.php?error=role_unavailable");
        break;
    case 'student':
        header("Location: views/student_dashboard.php");
        break;
    default:
        header("Location: auth/login.php");
        break;
}
exit;
