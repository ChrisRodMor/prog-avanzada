<?php
session_start();
require_once 'authController.php';

if (!isset($_SESSION['token'])) {
    header('Location: login.php');
    exit;
}

$productController = new ProductController();
$products = $productController->getProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 bg-dark text-white d-flex flex-column d-none d-sm-none d-md-block vh-100 position-sticky sticky-top">
                <h4 class="p-3">Sidebar</h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Customers</a>
                    </li>
                </ul>

                <div class="mt-auto p-3">
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="text-white d-flex align-items-center dropdown-toggle" id="dropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/30" alt="User Image" class="rounded-circle me-2">
                            <?php echo htmlspecialchars($_SESSION['name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="authController.php">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-10 p-0">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar scroll</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Link
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" aria-disabled="true">Link</a>
                                </li>
                            </ul>
                            <form class="d-flex ms-auto" method="POST" action="authController.php">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                                <div class="dropdown">
                                    <a href="#" class="text-white d-flex align-items-center dropdown-toggle mx-3" id="dropdownUserNavbar" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="https://via.placeholder.com/30" alt="User Image" class="rounded-circle me-2">
                                        <?php echo htmlspecialchars($_SESSION['name']); ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownUserNavbar">
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="authController.php">
                                                <input type="hidden" name="action" value="logout">
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </nav>

                <div class="container mt-4">
                    <h1>Lista de productos</h1>
                    <div class="row">
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="<?php echo htmlspecialchars($product['cover']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                        <p class="card-text"><strong>Precio: </strong>
                                            <?php 
                                                echo htmlspecialchars($product['presentations'][0]['price'][0]['amount']); 
                                            ?> €
                                        </p>
                                        <a href="detalleProducto.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary">Ver detalles</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
