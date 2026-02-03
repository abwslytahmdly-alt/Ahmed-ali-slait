<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
redirectIfLoggedIn();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // التحقق من البيانات
    if (empty($username) || empty($email) || empty($password)) {
        $error = "جميع الحقول مطلوبة";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "البريد الإلكتروني غير صالح";
    } elseif ($password !== $confirm_password) {
        $error = "كلمتا المرور غير متطابقتين";
    } elseif (strlen($password) < 6) {
        $error = "كلمة المرور يجب أن تكون 6 أحرف على الأقل";
    } else {
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            // التحقق من وجود المستخدم مسبقاً
            $query = "SELECT id FROM users WHERE username = :username OR email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $error = "اسم المستخدم أو البريد الإلكتروني موجود مسبقاً";
            } else {
                // تشفير كلمة المرور باستخدام دالة createHash
                $hashed_password = createHash($password);
                
                // إدخال المستخدم الجديد
                $query = "INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, NOW())";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                
                if ($stmt->execute()) {
                    $success = "تم إنشاء الحساب بنجاح! يمكنك الآن تسجيل الدخول";
                    // تفريغ الحقول بعد النجاح
                    $username = $email = '';
                } else {
                    $error = "حدث خطأ أثناء إنشاء الحساب";
                }
            }
        } catch(PDOException $exception) {
            $error = "خطأ في الاتصال بقاعدة البيانات: " . $exception->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>إنشاء حساب جديد</h1>
            
            <?php if ($error): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">اسم المستخدم:</label>
                    <input type="text" id="username" name="username" 
                           value="<?php echo isset($username) ? $username : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email" 
                           value="<?php echo isset($email) ? $email : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">كلمة المرور:</label>
                    <input type="password" id="password" name="password" required>
                    <small>يجب أن تكون 6 أحرف على الأقل</small>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">تأكيد كلمة المرور:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">إنشاء الحساب</button>
                </div>
            </form>
            
            <div class="links">
                <p>لديك حساب بالفعل؟ <a href="login.php">سجل الدخول هنا</a></p>
                <p><a href="index.php">العودة للصفحة الرئيسية</a></p>
            </div>
        </div>
    </div>
</body>
</html>