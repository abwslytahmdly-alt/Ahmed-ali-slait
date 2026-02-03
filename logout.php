<?php
require_once 'includes/functions.php';

if (isLoggedIn()) {
    // تسجيل وقت الخروج
    $logout_time = date('Y-m-d H:i:s');
    
    // تدمير جميع بيانات الجلسة
    $_SESSION = array();
    
    // إذا كان هناك كوكي الجلسة، قم بتدميره
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    // تدمير الجلسة
    session_destroy();
    
    // رسالة الوداع
    $message = "تم تسجيل الخروج بنجاح في $logout_time";
} else {
    $message = "لم تكن مسجلاً الدخول";
}

// إعادة التوجيه لصفحة تسجيل الدخول مع رسالة
header("Location: login.php?message=" . urlencode($message));
exit();
?>