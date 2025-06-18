<?php
require_once 'config.php';

// Të dhënat e makinave (në vend të bazës së të dhënave)
$cars = [
    [
        'id' => 1,
        'brand' => 'BMW',
        'model' => 'X5',
        'year' => 2020,
        'price' => 45000,
        'mileage' => 35000,
        'fuel' => 'Diesel',
        'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=400&h=250&fit=crop',
        'description' => 'BMW X5 në gjendje të shkëlqyer, i mirëmbajtur rregullisht.'
    ],
    [
        'id' => 2,
        'brand' => 'Mercedes',
        'model' => 'C-Class',
        'year' => 2019,
        'price' => 38000,
        'mileage' => 42000,
        'fuel' => 'Benzinë',
        'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=400&h=250&fit=crop',
        'description' => 'Mercedes C-Class elegante dhe komfortable.'
    ],
    [
        'id' => 3,
        'brand' => 'Audi',
        'model' => 'A4',
        'year' => 2021,
        'price' => 42000,
        'mileage' => 28000,
        'fuel' => 'Diesel',
        'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=400&h=250&fit=crop',
        'description' => 'Audi A4 moderne me teknologji të avancuar.'
    ],
    [
        'id' => 4,
        'brand' => 'Volkswagen',
        'model' => 'Golf',
        'year' => 2018,
        'price' => 22000,
        'mileage' => 55000,
        'fuel' => 'Benzinë',
        'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=400&h=250&fit=crop',
        'description' => 'Volkswagen Golf i besueshëm dhe ekonomik.'
    ],
    [
        'id' => 5,
        'brand' => 'Toyota',
        'model' => 'Corolla',
        'year' => 2020,
        'price' => 25000,
        'mileage' => 30000,
        'fuel' => 'Hybrid',
        'image' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=400&h=250&fit=crop',
        'description' => 'Toyota Corolla Hybrid me konsum të ulët.'
    ],
    [
        'id' => 6,
        'brand' => 'Ford',
        'model' => 'Focus',
        'year' => 2019,
        'price' => 20000,
        'mileage' => 48000,
        'fuel' => 'Benzinë',
        'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=400&h=250&fit=crop',
        'description' => 'Ford Focus sportive dhe dinamike.'
    ]
];

// Filtrat
$search = $_GET['search'] ?? '';
$max_price = $_GET['max_price'] ?? '';
$fuel_type = $_GET['fuel_type'] ?? '';

// Filtro makinat
$filtered_cars = $cars;

if (!empty($search)) {
    $filtered_cars = array_filter($filtered_cars, function($car) use ($search) {
        return stripos($car['brand'] . ' ' . $car['model'], $search) !== false;
    });
}

if (!empty($max_price)) {
    $filtered_cars = array_filter($filtered_cars, function($car) use ($max_price) {
        return $car['price'] <= $max_price;
    });
}

if (!empty($fuel_type)) {
    $filtered_cars = array_filter($filtered_cars, function($car) use ($fuel_type) {
        return $car['fuel'] === $fuel_type;
    });
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoShop - Blerje Makinash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 80px 0;
        }
        .card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
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
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="index.php">Kryefaqja</a>
                <a class="nav-link" href="contact.php">Kontakti</a>
            </div>
            <div class="navbar-nav">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="dashboard.php?logout=1"><i class="fas fa-sign-out-alt"></i> Dil</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a class="nav-link" href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Kyçu
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">🚗 Gjeni Makinën Tuaj</h1>
            <p class="lead mb-4">Zgjidhni nga koleksioni ynë i makinave të përdorura</p>
            <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']): ?>
                <a href="login.php" class="btn btn-light btn-lg">
                    <i class="fas fa-user-plus"></i> Regjistrohu për më shumë
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Kërkoni markë ose model..." value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="fuel_type">
                        <option value="">Të gjitha karburantet</option>
                        <option value="Benzinë" <?= $fuel_type === 'Benzinë' ? 'selected' : '' ?>>Benzinë</option>
                        <option value="Diesel" <?= $fuel_type === 'Diesel' ? 'selected' : '' ?>>Diesel</option>
                        <option value="Hybrid" <?= $fuel_type === 'Hybrid' ? 'selected' : '' ?>>Hybrid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="max_price" placeholder="Çmimi maksimal €" value="<?= htmlspecialchars($max_price) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Kërko
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Cars Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">
                Makinat e Disponueshme 
                <span class="badge bg-primary"><?= count($filtered_cars) ?></span>
            </h2>
            
            <?php if (empty($filtered_cars)): ?>
                <div class="text-center">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>Nuk u gjetën makina</h4>
                    <p class="text-muted">Provoni të ndryshoni kriteret e kërkimit</p>
                    <a href="index.php" class="btn btn-primary">Shiko të gjitha</a>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($filtered_cars as $car): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <img src="<?= $car['image'] ?>" class="card-img-top" alt="<?= $car['brand'] . ' ' . $car['model'] ?>" style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= $car['brand'] . ' ' . $car['model'] ?></h5>
                                    <p class="card-text text-muted">
                                        <i class="fas fa-calendar"></i> <?= $car['year'] ?> • 
                                        <i class="fas fa-tachometer-alt"></i> <?= number_format($car['mileage']) ?> km • 
                                        <i class="fas fa-gas-pump"></i> <?= $car['fuel'] ?>
                                    </p>
                                    <p class="card-text flex-grow-1"><?= $car['description'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="price">€<?= number_format($car['price']) ?></span>
                                        <div>
                                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                                                <button class="btn btn-outline-danger btn-sm me-2" title="Shto në të preferuarat">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            <?php endif; ?>
                                            <a href="details.php?id=<?= $car['id'] ?>" class="btn btn-primary">
                                                <i class="fas fa-eye"></i> Detajet
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

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
