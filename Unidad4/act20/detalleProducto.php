<?php
    session_start();
    require_once 'authController.php';

    if (!isset($_SESSION['token'])) {
        header('Location: login.php');
        exit;
    }

    $productController = new ProductController();
    $productDetails = null;
    if (isset($_GET['slug'])) {
        $productDetails = $productController->getProductsBySlug($_GET['slug']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Producto</title>
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
                    <h1>Detalles del Producto</h1>
                    <div class="card">
                        <h5 class="card-header">Marca: <?php echo htmlspecialchars($productDetails['brand']['name']); ?></h5>
                        <div class="card-body">
                            <div class="row">
                                <div id="carouselExampleIndicators" class="carousel slide col-12 col-md-3" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <img src="<?php echo htmlspecialchars($productDetails['cover']); ?>" class="d-block w-100" alt="Slide 1">
                                      </div>
                                      <div class="carousel-item">
                                        <img src="<?php echo htmlspecialchars($productDetails['cover']); ?>" class="d-block w-100" alt="Slide 2">
                                      </div>
                                      <div class="carousel-item">
                                        <img src="<?php echo htmlspecialchars($productDetails['cover']); ?>" class="d-block w-100" alt="Slide 3">
                                        <!-- <div class="carousel-caption d-none d-md-block">
                                          <h5>Título del Slide 3</h5>
                                          <p>Descripción del Slide 3.</p>
                                        </div> -->
                                      </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="visually-hidden">Next</span>
                                    </button>
                                  </div>
                                  
                    
                                <div class="col-9">
                                    <p class="card-title"><strong>ID: </strong><?php echo htmlspecialchars($productDetails['id']); ?></p>
                                    <p class="card-text"><strong>Nombre: </strong><?php echo htmlspecialchars($productDetails['name']); ?></p>
                                    <p class="card-text"><strong>Descripcion: </strong><?php echo htmlspecialchars($productDetails['description']); ?></p>
                                    <p class="card-text"><strong>Caracteristicas: </strong><?php echo htmlspecialchars($productDetails['features']); ?></p>
                                    <p class="card-text"><strong>Precio: $</strong><?php echo htmlspecialchars($productDetails['presentations'][0]['price'][0]['amount']); ?><p>
                                    <!-- <a href="index.php" class="btn btn-primary">Volver</a> -->
                                </div>
                            </div>
                            <!--TABLA RESPONSIVA-->
                            <div class="table-responsive">
                                <table class="table table-sm caption-top p-0"> 

                                    <caption>
                                        Categorias
                                    </caption>

                                    <thead class="table-dark">
                                        <tr>
                                            <th>Marca</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo htmlspecialchars($productDetails['brand']['name']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--TABLA RESPONSIVA-->
                            <div class="table-responsive">
                                <table class="table table-sm caption-top p-0"> 

                                    <thead class="table-dark">
                                        <tr>
                                            <th>Categorias</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php 
                                                    foreach ($productDetails['categories'] as $category) {
                                                        echo htmlspecialchars($category['name']) . ", ";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--TABLA RESPONSIVA-->
                            <div class="table-responsive">
                                <table class="table table-sm caption-top p-0"> 

                                    <thead class="table-dark">
                                        <tr>
                                            <th>Etiquetas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php 
                                                foreach ($productDetails['tags'] as $tag) {
                                                    echo htmlspecialchars($tag['name']) . ", ";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="index.php" class="btn btn-primary">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
