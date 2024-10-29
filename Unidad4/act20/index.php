<?php

session_start();
require_once 'authController.php';

if (!isset($_SESSION['token'])) {
    header('Location: login.php');
    exit;
}

$productController = new ProductController();
$products = $productController->getProducts();

$categoryController = new CategoryController();
$categories = $categoryController->getCategories();

$tagController = new TagController();
$tags = $tagController->getTags();

$brandController = new BrandController();
$brands = $brandController->getBrands();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
                    <div class="row">
                        <div class = "row my-3">
                            <h1 class="col-9">Lista de productos</h1>
                            <button type="button" class="btn btn-success col-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                             Añadir
                            </button>
                        </div>
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="<?php echo htmlspecialchars($product['cover']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                        <p class="card-text"><strong>Precio: $</strong>
                                            <?php 
                                                echo isset($product['presentations'][0]['price'][0]['amount']) 
                                                    ? htmlspecialchars($product['presentations'][0]['price'][0]['amount']) 
                                                    : "No encontrado"; 
                                            ?>
                                        </p>
                                        <div class="mx-3">
                                            <a href="detalleProducto.php?slug=<?php echo htmlspecialchars($product['slug']); ?>" class="btn btn-primary mx-1">Detalles</a>
                                            <button class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['id']; ?>">Editar</button>
                                            <form id="eliminar-form" method="POST" action="authController.php" style="display: inline;">
                                                <input type="hidden" name="action" value="deleteProduct">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                                <button class="btn btn-danger delete-product-btn" onclick="deleteProduct()">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal EDITAR PRODUCTO -->
                            <div class="modal fade" id="editProductModal<?php echo $product['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editProductModalLabel">Editar producto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editProductForm" method="POST" action="authController.php">
                                                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

                                                <div class="mb-3">
                                                    <label for="editName" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editSlug" class="form-label">Slug</label>
                                                    <input type="text" class="form-control" id="slug" name="slug" value="<?php echo htmlspecialchars($product['slug']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editDescription" class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editBrand" class="form-label">Marca</label>
                                                    <select id="brand_id" name="brand_id" class="form-select">
                                                        <?php foreach ($brands as $brand): ?>
                                                        <option value="<?= $brand['id']; ?>" <?= isset($product['brand_id']) && $product['brand_id'] == $brand['id'] ? 'selected' : ''; ?>>
                                                            <?= htmlspecialchars($brand['name']); ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editFeatures" class="form-label">Características</label>
                                                    <textarea class="form-control" id="features" name="features" rows="2"><?php echo htmlspecialchars($product['features']); ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" id="saveChangesButton">Guardar Cambios</button>
                                                </div>
                                                <input type="hidden" name="action" value="editProduct">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            </div>

            
        </div>

        <!-- Modal AÑADIR PRODUCTO-->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Añadir producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" method="POST" action="authController.php" enctype="multipart/form-data" >
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="features" class="form-label">Características</label>
                                <textarea class="form-control" id="features" name="features" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="brand_id" class="form-label">Marca</label>
                                <select class="form-control" id="brand_id" name="brand_id" required>
                                <?php
                                    foreach ($brands as $brand) {
                                        echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                                    }
                                ?>
                            </div>
                            <div class="mb-3">
                                <select class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="editCover" class="form-label">Portada (Imagen)</label>
                                <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Añadir Producto</button>
                            </div>
                            <input type="hidden" name="action" value="addProduct">
                        </form>
                    </div>
                </div>
            </div>
        </div>





    </div>

    <script>
        function deleteProduct(){
            swal("Producto eliminado", {
            icon: "success",
            });
            // swal({
            //     title: "Desea eliminar el producto?",
            //     text: "No se podra retornar esta accion",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            //     })
            //     .then((willDelete) => {
            //     if (willDelete) {


            //     }
            // });
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
