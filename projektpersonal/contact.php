<?php
$message_sent = false;
$error_message = '';

if ($_POST && isset($_POST['send_message'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Ju lutemi plotësoni të gjitha fushat e detyrueshme.';
    } else {
        // Në një projekt real, këtu do të ruanim mesazhin në bazën e të dhënave
        // Për tani, thjesht tregojmë një mesazh suksesi
        $message_sent = true;
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakti - AutoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-car"></i> AutoShop
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Kryefaqja</a>
                <a class="nav-link active" href="contact.php">Kontakti</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center mb-5">Kontaktoni me Ne</h1>
                
                <?php if ($message_sent): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Mesazhi juaj u dërgua me sukses! Do t'ju përgjigjemi sa më shpejt.
                    </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> <?= $error_message ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow">
                    <div class="card-body p-4">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Emri *</label>
                                    <input type="text" class="form-control" name="name" required 
                                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="email" required
                                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefoni</label>
                                <input type="tel" class="form-control" name="phone"
                                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mesazhi *</label>
                                <textarea class="form-control" name="message" rows="6" required 
                                          placeholder="Shkruani mesazhin tuaj këtu..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="send_message" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane"></i> Dërgo Mesazhin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="row mt-5">
                    <div class="col-md-4 text-center mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                                <h5>Adresa</h5>
                                <p>Rruga Dëshmorët e Kombit<br>Tiranë, Shqipëri</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                                <h5>Telefoni</h5>
                                <p>+355 69 123 4567<br>+355 4 123 4567</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                                <h5>Email</h5>
                                <p>info@autoshop.al<br>contact@autoshop.al</p>
                            </div>
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
                <i class="fas fa-car"></i> AutoShop &copy; 2024 - Projekt i thjeshtë PHP
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
