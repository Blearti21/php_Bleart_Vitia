<?php
// Inkludo config.php për lidhjen me bazën e të dhënave
include('config.php');

try {
    // Përgatitja e pyetjes SQL për të marrë të dhënat nga tabela 'products'
    $stmt = $conn->prepare("SELECT id, title, description, quantity, price FROM products");
    $stmt->execute();

    // Marrja e të dhënave
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Product List</title>
    <!-- Përdorimi i Bootstrap 4.5 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome për ikona -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <!-- Stilizimi me ngjyra të reja -->
    <style>
        body {
            background-color: #f1f1f1; /* Ngjyrë e lehtë për sfondin */
        }
        .navbar {
            background-color: #007bff; /* Ngjyra blu për navbar */
        }
        .navbar-brand, .nav-link {
            color: white !important; /* Ngjyra e bardhë për tekstin e navbar */
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #dcdcdc !important; /* Ndryshimi i ngjyrës kur kalon me miun */
        }
        .container {
            background-color: #ffffff; /* Sfondo i bardhë për përmbajtjen */
            border-radius: 10px; /* Këndet e rrumbullakosura */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Hije e lehtë */
            padding: 30px;
        }
        .table {
            background-color: #f0f8ff; /* Ngjyrë e lehtë për tabelën */
        }
        .table th, .table td {
            text-align: center;
        }
        .alert-warning {
            background-color: #ffcc00; /* Ngjyrë e verdhë për mesazhin e paralajmërimit */
            color: #333;
        }
        .btn-warning {
            background-color: #f0ad4e; /* Ngjyra e portokalltë për butonin e editimit */
            border-color: #f0ad4e;
        }
        .btn-warning:hover {
            background-color: #ec971f; /* Ndryshimi i ngjyrës kur kalon miu */
            border-color: #d58512;
        }
        .btn-danger {
            background-color: #d9534f; /* Ngjyra e kuqe për butonin e fshirjes */
            border-color: #d9534f;
        }
        .btn-danger:hover {
            background-color: #c9302c; /* Ndryshimi i ngjyrës kur kalon miu */
            border-color: #ac2925;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <!-- Shtimi i një navigacioni të thjeshtë -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="#">Product Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">Add Product</a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="text-center mb-4">Product List</h1>

        <!-- Kontrollo nëse ka produkte -->
        <?php if (empty($products)): ?>
            <div class="alert alert-warning" role="alert">
                No products available.
            </div>
        <?php else: ?>
            <!-- Tabela që shfaq të dhënat e produkteve -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th> <!-- Kolona për veprimet -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['title']) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= htmlspecialchars($product['quantity']) ?></td>
                            <td><?= htmlspecialchars($product['price']) ?></td>
                            <td>
                                <!-- Butoni i Editimit -->
                                <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <!-- Butoni i Fshirjes -->
                                <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- JavaScript për funksionalitetin e Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
