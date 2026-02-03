<?php
require_once 'includes/functions.php';
redirectIfNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <nav class="navbar">
                <div class="nav-brand">
                    <h2>نظام التسجيل</h2>
                </div>
                <div class="nav-links">
                    <span>مرحباً، <?php echo $_SESSION['username']; ?></span>
                    <a href="logout.php" class="btn logout">تسجيل الخروج</a>
                </div>
            </nav>
        </header>
        
        <main class="dashboard">
            <div class="welcome-section">
                <h1>مرحباً بك في الصفحة الرئيسية</h1>
                <p>لقد سجلت الدخول بنجاح إلى النظام</p>
                <div class="login-time">
                    <p>وقت الدخول: <?php echo date('Y-m-d H:i:s'); ?></p>
                </div>
            </div>
            
            <div class="user-info">
                <h3>معلومات الجلسة:</h3>
                <div class="info-card">
                    <p><strong>اسم المستخدم:</strong> <?php echo $_SESSION['username']; ?></p>
                    <p><strong>رقم المستخدم:</strong> <?php echo $_SESSION['user_id']; ?></p>
                    <p><strong>وقت الدخول:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                    <p><strong>معرف الجلسة:</strong> <?php echo session_id(); ?></p>
                </div>
            </div>
            
            <div class="system-info">
                <h3>معلومات النظام:</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <h4>إصدار PHP</h4>
                        <p><?php echo phpversion(); ?></p>
                    </div>
                    <div class="info-item">
                        <h4>خادم الويب</h4>
                        <p><?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
                    </div>
                    <div class="info-item">
                        <h4>نظام التشفير</h4>
                        <p>crypt() with Blowfish</p>
                    </div>
                    <div class="info-item">
                        <h4>اتصال قاعدة البيانات</h4>
                        <p>PDO MySQL</p>
                    </div>
                </div>
            </div>
            
            <div class="features">
                <h3>مميزات النظام:</h3>
                <div class="features-grid">
                    <div class="feature-card">
                        <h4>أمان عالي</h4>
                        <p>استخدام PDO للحماية من هجمات SQL Injection</p>
                    </div>
                    <div class="feature-card">
                        <h4>تشفير كلمات المرور</h4>
                        <p>استخدام crypt لتشفير كلمات المرور</p>
                    </div>
                    <div class="feature-card">
                        <h4>واجهة عربية</h4>
                        <p>تصميم واجهة مستخدم باللغة العربية</p>
                    </div>
                    <div class="feature-card">
                        <h4>إدارة الجلسات</h4>
                        <p>نظام إدارة جلسات آمن</p>
                    </div>
                </div>
            </div>
            
            <div class="actions">
                <h3>الإجراءات المتاحة:</h3>
                <div class="action-buttons">
                    <a href="profile.php" class="btn secondary">الملف الشخصي</a>
                    <a href="change_password.php" class="btn secondary">تغيير كلمة المرور</a>
                    <a href="logout.php" class="btn danger">تسجيل الخروج</a>
                </div>
            </div>
        </main>
        
        <footer>
            <p>© 2024 نظام التسجيل - جميع الحقوق محفوظة</p>
            <p>إصدار PHP: <?php echo phpversion(); ?> | وقت الخادم: <?php echo date('Y-m-d H:i:s'); ?></p>
        </footer>
    </div>
</body>
</html>