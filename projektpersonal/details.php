<?php
// Të dhënat e makinave (të njëjtat si në index.php)
$cars = [
    [
        'id' => 1,
        'brand' => 'BMW',
        'model' => 'X5',
        'year' => 2020,
        'price' => 45000,
        'mileage' => 35000,
        'fuel' => 'Diesel',
        'transmission' => 'Automatik',
        'color' => 'E zezë',
        'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=600&h=400&fit=crop',
        'description' => 'BMW X5 në gjendje të shkëlqyer, i mirëmbajtur rregullisht. Makina ka të gjitha opsionet dhe është gati për përdorim.',
        'features' => ['Navigacion GPS', 'Kamera prapa', 'Ulëse lëkure', 'Klimatizim automatik', 'Xhama të errëta']
    ],
    [
        'id' => 2,
        'brand' => 'Mercedes',
        'model' => 'C-Class',
        'year' => 2019,
        'price' => 38000,
        'mileage' => 42000,
        'fuel' => 'Benzinë',
        'transmission' => 'Automatik',
        'color' => 'E bardhë',
        'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=600&h=400&fit=crop',
        'description' => 'Mercedes C-Class elegante dhe komfortable. Motor i fuqishëm dhe konsum i ulët karburanti.',
        'features' => ['Sistem audio premium', 'Ulëse të ngrohta', 'Kontrolli i kursimit', 'Drita LED']
    ],
    [
        'id' => 3,
        'brand' => 'Audi',
        'model' => 'A4',
        'year' => 2021,
        'price' => 42000,
        'mileage' => 28000,
        'fuel' => 'Diesel',
        'transmission' => 'Automatik',
        'color' => 'Gri',
        'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=600&h=400&fit=crop',
        'description' => 'Audi A4 moderne me teknologji të avancuar. Makina është në gjendje perfekte dhe ka garanci.',
        'features' => ['Quattro AWD', 'Virtual Cockpit', 'Parkimi automatik', 'Kontrolli adaptiv']
    ],
    [
        'id' => 4,
        'brand' => 'Volkswagen',
        'model' => 'Golf',
        'year' => 2018,
        'price' => 22000,
        'mileage' => 55000,
        'fuel' => 'Benzinë',
        'transmission' => 'Manual',
        'color' => 'E kuqe',
        'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=600&h=400&fit=crop',
        'description' => 'Volkswagen Golf i besueshëm dhe ekonomik. Ideal për qytet dhe udhëtime të gjata.',
        'features' => ['Bluetooth', 'Kontrolli i kursimit', 'Drita LED', 'Radio me ekran prekës']
    ],
    [
        'id' => 5,
        'brand' => 'Toyota',
        'model' => 'Corolla',
        'year' => 2020,
        'price' => 25000,
        'mileage' => 30000,
        'fuel' => 'Hybrid',
        'transmission' => 'Automatik',
        'color' => 'E bardhë',
        'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=600&h=400&fit=crop',
        'description' => 'Toyota Corolla Hybrid me konsum shumë të ulët karburanti. Makina është si e re.',
        'features' => ['Sistem hibrid', 'Kamera prapa', 'Kontrolli i kursimit', 'Bluetooth']
    ],
    [
        'id' => 6,
        'brand' => 'Ford',
        'model' => 'Focus',
        'year' => 2019,
        'price' => 20000,
        'mileage' => 48000,
        'fuel' => 'Benzinë',
        'transmission' => 'Manual',
        'color' => 'Blu',
        'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=600&h=400&fit=crop',
        'description' => 'Ford Focus sportive dhe dinamike. Motor i fuqishëm dhe handling i shkëlqyer.',
        'features' => ['Sistem audio SYNC', 'Kontrolli i kursimit', 'Drita LED', 'Bluetooth']
    ]
];

// Gjej makinën sipas ID
$car_id = $_GET['id'] ?? 0;
$car = null;

foreach ($cars as $c) {
    if ($c['id'] == $car_id) {
        $car = $c;
        break;
    }
}

// Nëse makina nuk gjendet, kthehu te faqja kryesore
if (!$car) {
    header('Location: index.php');
    exit;
}

// Handle contact form
$message_sent = false;
if ($_POST && isset($_POST['send_message'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';
    
    if (!empty($name) && !empty($email) && !empty($message)) {
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
    <title><?= $car['brand'] . ' ' . $car['model'] ?> - AutoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .price-box {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .feature-list {
            list-style: none;
            padding: 0;
        }
        .feature-list li {
            padding: 5px 0;
        }
        .feature-list li:before {
            content: "✓";
            color: #28a745;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
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
                <a class="nav-link" href="contact.php">Kontakti</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Kryefaqja</a></li>
                <li class="breadcrumb-item active"><?= $car['brand'] . ' ' . $car['model'] ?></li>
            </ol>
        </nav>

        <div class="row">
            <!-- Car Details -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <img src="<?= $car['image'] ?>" class="card-img-top" alt="<?= $car['brand'] . ' ' . $car['model'] ?>" style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <h1 class="card-title"><?= $car['brand'] . ' ' . $car['model'] ?></h1>
                        
                        <!-- Car Info -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <strong><i class="fas fa-calendar text-primary"></i> Viti:</strong><br>
                                <?= $car['year'] ?>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fas fa-tachometer-alt text-primary"></i> Kilometrazhi:</strong><br>
                                <?= number_format($car['mileage']) ?> km
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fas fa-gas-pump text-primary"></i> Karburanti:</strong><br>
                                <?= $car['fuel'] ?>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fas fa-cogs text-primary"></i> Transmisioni:</strong><br>
                                <?= $car['transmission'] ?>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <strong><i class="fas fa-palette text-primary"></i> Ngjyra:</strong><br>
                                <?= $car['color'] ?>
                            </div>
                        </div>
                        
                        <h3>Përshkrimi</h3>
                        <p><?= $car['description'] ?></p>
                        
                        <?php if (!empty($car['features'])): ?>
                            <h3>Karakteristikat</h3>
                            <ul class="feature-list">
                                <?php foreach ($car['features'] as $feature): ?>
                                    <li><?= $feature ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price -->
                <div class="price-box mb-4">
                    <h2 class="mb-0">€<?= number_format($car['price']) ?></h2>
                    <p class="mb-0">Çmimi përfundimtar</p>
                </div>

                <!-- Contact Form -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-envelope"></i> Kontaktoni për këtë makinë</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($message_sent): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Mesazhi juaj u dërgua me sukses!
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Emri *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefoni</label>
                                <input type="tel" class="form-control" name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mesazhi *</label>
                                <textarea class="form-control" name="message" rows="4" required 
                                          placeholder="Jam i interesuar për <?= $car['brand'] . ' ' . $car['model'] ?>..."></textarea>
                            </div>
                            <button type="submit" name="send_message" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> Dërgo Mesazhin
                            </button>
                        </form>
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
