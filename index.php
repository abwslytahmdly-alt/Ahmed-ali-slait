<?php
require_once 'includes/functions.php';
redirectIfLoggedIn();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام التسجيل</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>مرحباً بك في نظام التسجيل</h1>
            <p>نظام آمن لتسجيل الدخول وإنشاء الحسابات</p>
        </header>
        
        <div class="options">
            <div class="option-card">
                <h2>تسجيل الدخول</h2>
                <p>إذا كان لديك حساب بالفعل</p>
                <a href="login.php" class="btn">الدخول إلى حسابك</a>
            </div>
            
            <div class="option-card">
                <h2>إنشاء حساب جديد</h2>
                <p>إذا كنت مستخدمًا جديدًا</p>
                <a href="register.php" class="btn">إنشاء حساب جديد</a>
            </div>
        </div>
        
        <div class="features">
            <h3>مميزات النظام:</h3>
            <ul>
                <li>تسجيل آمن باستخدام PDO</li>
                <li>تشفير كلمات المرور باستخدام crypt</li>
                <li>واجهة مستخدم عربية</li>
                <li>تصميم متجاوب</li>
                <li>إدارة جلسات آمنة</li>
            </ul>
        </div>
        
        <footer>
            <p>© 2024 نظام التسجيل - جميع الحقوق محفوظة</p>
        </footer>
    </div>
</body>
</html>