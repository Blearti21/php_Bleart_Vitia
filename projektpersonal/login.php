<?php
session_start();


$users = [
    'admin@autoshop.al' => [
        'password' => 'admin123',
        'name' => 'Admin User',
        'role' => 'admin'
    ],
    'demo@autoshop.al' => [
        'password' => 'demo123', 
        'name' => 'Demo User',
        'role' => 'user'
    ]
];

$error_message = '';
$success_message = '';

// Handle login
if ($_POST && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (!empty($email) && !empty($password)) {
        if (isset($users[$email]) && $users[$email]['password'] === $password) {
            // Login successful
            $_SESSION['logged_in'] = true;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $users[$email]['name'];
            $_SESSION['user_role'] = $users[$email]['role'];
            
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = 'Email ose fjalëkalim i gabuar';
        }
    } else {
        $error_message = 'Ju lutemi plotësoni të gjitha fushat';
    }
}

// Redirect if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AutoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-car"></i> AutoShop
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Kryefaqja</a>
                <a class="nav-link" href="contact.php">Kontakti</a>
                <a class="nav-link active" href="login.php">Login</a>
                <a class="nav-link" href="signup.php">Sign Up</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                            <h2>Mirë se erdhe përsëri!</h2>
                            <p class="text-muted">Hyni në llogarinë tuaj</p>
                        </div>

                        <?php if ($error_message): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success_message): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" required 
                                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fjalëkalimi *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <button type="submit" name="login" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt"></i> Hyr
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="mb-0">
                                Nuk keni llogari? 
                                <a href="signup.php" class="text-decoration-none fw-bold">
                                    Regjistrohuni këtu
                                </a>
                            </p>
                        </div>

                        <hr class="my-4">
                        
                        <div class="text-center">
                            <p class="text-muted mb-2">Llogari demo:</p>
                            <small class="text-muted">
                                <strong>Admin:</strong> admin@autoshop.al / admin123<br>
                                <strong>User:</strong> demo@autoshop.al / demo123
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 text-center">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-car"></i> AutoShop &copy; 2024
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
