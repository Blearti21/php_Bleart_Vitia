<?php
session_start();

$error_message = '';
$success_message = '';

// Përdorues ekzistues (për të kontrolluar duplikatet)
$existing_users = [
    'admin@autoshop.al',
    'demo@autoshop.al'
];

if ($_POST && isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($name) || empty($email) || empty($password)) {
        $error_message = 'Ju lutemi plotësoni të gjitha fushat e detyrueshme';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Fjalëkalimet nuk përputhen';
    } elseif (strlen($password) < 6) {
        $error_message = 'Fjalëkalimi duhet të ketë të paktën 6 karaktere';
    } elseif (in_array($email, $existing_users)) {
        $error_message = 'Ky email është i regjistruar tashmë';
    } else {
        // Në një projekt real, këtu do të ruanim në bazën e të dhënave
        // Për tani, thjesht simulojmë regjistrimin e suksesshëm
        $success_message = 'Regjistrimi u krye me sukses! Mund të hyni tani me: ' . $email;
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
    <title>Sign Up - AutoShop</title>
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
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link active" href="signup.php">Sign Up</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                            <h2>Krijoni Llogarinë Tuaj</h2>
                            <p class="text-muted">Regjistrohuni për të aksesuar të gjitha shërbimet</p>
                        </div>

                        <?php if ($error_message): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success_message): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                                <div class="mt-2">
                                    <a href="login.php" class="btn btn-success btn-sm">Hyr tani</a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Emri i plotë *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="name" required 
                                           value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" required 
                                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fjalëkalimi *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" name="password" required minlength="6">
                                    </div>
                                    <small class="text-muted">Të paktën 6 karaktere</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Konfirmo Fjalëkalimin *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" name="confirm_password" required minlength="6">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Pranoj kushtet dhe rregullat
                                </label>
                            </div>

                            <button type="submit" name="signup" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-plus"></i> Regjistrohu
                            </button>
                        </form>

                        <div class="text-center">
                            <p class="mb-0">
                                Keni tashmë llogari? 
                                <a href="login.php" class="text-decoration-none fw-bold">
                                    Hyni këtu
                                </a>
                            </p>
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
