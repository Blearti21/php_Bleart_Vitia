<?php
require_once 'config.php';

$error = '';
$success = '';

// Handle login
if ($_POST && isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Ju lutemi plotësoni të gjitha fushat.';
    } else {
        try {
            $pdo = getConnection();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Email ose fjalëkalim i gabuar.';
            }
        } catch(PDOException $e) {
            $error = 'Gabim në sistem. Provoni përsëri.';
        }
    }
}

// Handle registration
if ($_POST && isset($_POST['register'])) {
    $name = trim($_POST['reg_name'] ?? '');
    $email = trim($_POST['reg_email'] ?? '');
    $password = $_POST['reg_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Ju lutemi plotësoni të gjitha fushat.';
    } elseif ($password !== $confirm_password) {
        $error = 'Fjalëkalimet nuk përputhen.';
    } elseif (strlen($password) < 6) {
        $error = 'Fjalëkalimi duhet të ketë të paktën 6 karaktere.';
    } else {
        try {
            $pdo = getConnection();
            
            // Kontrollo nëse email-i ekziston
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error = 'Ky email është i regjistruar tashmë.';
            } else {
                // Regjistro përdoruesin e ri
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $hashed_password]);
                
                $success = 'Llogaria u krijua me sukses! Mund të kyçeni tani.';
            }
        } catch(PDOException $e) {
            $error = 'Gabim në sistem. Provoni përsëri.';
        }
    }
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
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs mb-4" id="authTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button">
                                    <i class="fas fa-sign-in-alt"></i> Kyçu
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button">
                                    <i class="fas fa-user-plus"></i> Regjistrohu
                                </button>
                            </li>
                        </ul>

                        <!-- Alerts -->
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
                            </div>
                        <?php endif; ?>

                        <div class="tab-content">
                            <!-- Login Tab -->
                            <div class="tab-pane fade show active" id="login">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fjalëkalimi</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary w-100">
                                        <i class="fas fa-sign-in-alt"></i> Kyçu
                                    </button>
                                </form>
                                
                                <div class="mt-3 text-center">
                                    <small class="text-muted">
                                        Test account: admin@autoshop.al / password
                                    </small>
                                </div>
                            </div>

                            <!-- Register Tab -->
                            <div class="tab-pane fade" id="register">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Emri</label>
                                        <input type="text" class="form-control" name="reg_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="reg_email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fjalëkalimi</label>
                                        <input type="password" class="form-control" name="reg_password" required minlength="6">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmo Fjalëkalimin</label>
                                        <input type="password" class="form-control" name="confirm_password" required minlength="6">
                                    </div>
                                    <button type="submit" name="register" class="btn btn-success w-100">
                                        <i class="fas fa-user-plus"></i> Regjistrohu
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
