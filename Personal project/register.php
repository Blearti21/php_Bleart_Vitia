<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>


<?php
session_start();
require 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) < 3) {
        $message = "Username must be at least 3 characters";
    } elseif (strlen($password) < 5) {
        $message = "Password must be at least 5 characters";
    } else {
        // Check if username exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $message = "Username already taken";
        } else {
            // Insert new user
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hash])) {
                $message = "Registration successful! You can <a href='login.php'>login now</a>.";
            } else {
                $message = "Error during registration";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2>Register</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="post" action="register.php">
    Username:<br>
    <input type="text" name="username" required><br><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
