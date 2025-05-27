<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
require 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    Username:<br>
    <input type="text" name="username" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Sign up here</a></p>
</body>
</html>
