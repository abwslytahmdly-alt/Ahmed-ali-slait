<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
redirectIfLoggedIn();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = "اسم المستخدم وكلمة المرور مطلوبان";
    } else {
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            $query = "SELECT id, username, password FROM users WHERE username = :username OR email = :username";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashed_password = $row['password'];
                
                // التحقق من كلمة المرور باستخدام دالة verifyHash
                if (verifyHash($password, $hashed_password)) {
                    // بدء الجلسة
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    
                    // إعادة التوجيه للصفحة الرئيسية
                    header("Location: home.php");
                    exit();
                } else {
                    $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
                }
            } else {
                $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
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
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>تسجيل الدخول</h1>
            
            <?php if ($error): ?>
                <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">اسم المستخدم أو البريد الإلكتروني:</label>
                    <input type="text" id="username" name="username" 
                           value="<?php echo isset($username) ? $username : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">كلمة المرور:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn">تسجيل الدخول</button>
                </div>
            </form>
            
            <div class="links">
                <p>ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a></p>
                <p><a href="index.php">العودة للصفحة الرئيسية</a></p>
            </div>
        </div>
    </div>
</body>
</html>