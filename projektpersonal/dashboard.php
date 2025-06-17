<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Sample favorite cars (në një projekt real do të ishin në bazë të dhënash)
$favorite_cars = [
    [
        'id' => 1,
        'brand' => 'BMW',
        'model' => '5',
        'year' => 2020,
        'price' => 45000,
        'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=300&h=200&fit=crop'
    ],
    [
        'id' => 3,
        'brand' => 'Audi',
        'model' => 'A4',
        'year' => 2021,
        'price' => 42000,
        'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=300&h=200&fit=crop'
    ]
];
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AutoShop</title>
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
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="index.php">Kryefaqja</a>
                <a class="nav-link" href="contact.php">Kontakti</a>
            </div>
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item active" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-edit"></i> Profili</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="?logout=1"><i class="fas fa-sign-out-alt"></i> Dil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-1">Mirë se erdhe, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                                <p class="mb-0">Menaxho llogarinë tënde dhe shiko makinat e preferuara</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <i class="fas fa-user-circle fa-4x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-heart fa-2x text-danger mb-3"></i>
                        <h4><?php echo count($favorite_cars); ?></h4>
                        <p class="text-muted mb-0">Makina të Preferuara</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                        <h4>3</h4>
                        <p class="text-muted mb-0">Mesazhet e Dërguara</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar fa-2x text-success mb-3"></i>
                        <h4>15</h4>
                        <p class="text-muted mb-0">Ditë që nga regjistrimi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Favorites Section -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-heart text-danger"></i> Makinat e Preferuara</h5>
                        <a href="index.php" class="btn btn-sm btn-outline-primary">Shiko të gjitha</a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($favorite_cars)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-heart-broken fa-3x text-muted mb-3"></i>
                                <h5>Nuk keni makina të preferuara</h5>
                                <p class="text-muted">Shikoni listën e makinave dhe shtoni në të preferuarat</p>
                                <a href="index.php" class="btn btn-primary">Shiko Makinat</a>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach ($favorite_cars as $car): ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <img src="<?php echo $car['image']; ?>" 
                                                 class="card-img-top" alt="<?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>"
                                                 style="height: 150px; object-fit: cover;">
                                            <div class="card-body p-3">
                                                <h6 class="card-title"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h6>
                                                <p class="card-text text-muted small">
                                                    <?php echo $car['year']; ?>
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fw-bold text-primary">€<?php echo number_format($car['price']); ?></span>
                                                    <a href="details.php?id=<?php echo $car['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                        Detajet
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Profili Im</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h6 class="text-center"><?php echo htmlspecialchars($_SESSION['user_name']); ?></h6>
                        <p class="text-center text-muted small"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                        
                        <div class="row text-center">
                            <div class="col-6">
                                <small class="text-muted">Roli</small>
                                <div class="fw-bold"><?php echo ucfirst($_SESSION['user_role']); ?></div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Status</small>
                                <div class="fw-bold text-success">Aktiv</div>
                            </div>
                        </div>
                        
                        <div class="d-grid mt-3">
                            <a href="profile.php" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i> Ndrysho Profilin
                            </a>
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
