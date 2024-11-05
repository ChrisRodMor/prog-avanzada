<?php 
  include_once "../../app/config.php";
  require_once __DIR__ . '/../../app/ProductController.php';
  $productController = new ProductController();
  $products = $productController->getProducts();
  require_once __DIR__ . '/../../app/BrandController.php';
  $brands = new BrandController();
  $brands = $brands->getBrands();
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
     <?php 

      include "../layouts/head.php";

    ?>

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    

    <?php 

      include "../layouts/sidebar.php";

    ?>

    <?php 

      include "../layouts/nav.php";

    ?>

    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo BASE_PATH; ?>home">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                  <li class="breadcrumb-item" aria-current="page">Products</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Products</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="ecom-wrapper">
              
              <div class="ecom-content">
                
              <div class="row">
                <?php foreach ($products as $product): ?>
                  <div class="col-sm-6 col-xl-4">
                    <div class="card product-card" style="max-width: 600px; margin: 2%;">
                        <div class="card-img-top">
                            <a href="products/<?php echo htmlspecialchars($product['slug']); ?>/" >
                                <img src="<?php echo htmlspecialchars($product['cover']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                    style="height: 500px; object-fit: cover;" class="img-prod img-fluid" />
                            </a>
                            <div class="card-body position-absolute end-0 top-0">
                                <div class="form-check prod-likes">
                                    <input type="checkbox" class="form-check-input" />
                                    <i data-feather="heart" class="prod-likes-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="overflow: hidden;">
                            <a href="products/<?php echo htmlspecialchars($product['slug']); ?>/" >
                                <p class="prod-content mb-0 text-muted"><?php echo htmlspecialchars($product['name']); ?></p>
                            </a>
                            <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                                <h4 class="mb-0 text-truncate">
                                    <b>$<?php 
                                        echo isset($product['presentations'][0]['price'][0]['amount']) 
                                            ? htmlspecialchars($product['presentations'][0]['price'][0]['amount']) 
                                            : "No encontrado"; 
                                    ?></b>
                                    <span class="text-sm text-muted f-w-400 text-decoration-line-through">$3.99</span>
                                </h4>
                                <div class="d-inline-flex align-items-center">
                                    <i class="ph-duotone ph-star text-warning me-1"></i>
                                    4.5 <small class="text-muted">/ 5</small>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <a href="<?php echo BASE_PATH; ?>products/<?php echo htmlspecialchars($product['slug']); ?>" class="avtar avtar-s btn-link-secondary btn-prod-card">
                                        <i class="ph-duotone ph-eye f-18"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex">
                                        <button class="btn btn-link-warning" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['id']; ?>">Edit</button>
                                        <form id="eliminar-form" method="POST" action="products">
                                          <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
                                          <input type="hidden" name="action" value="deleteProduct">
                                          <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                          <button type="submit" class="btn btn-link-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>

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
                            <form id="editProductForm" method="POST" action="products">
                                <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
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
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="productOffcanvas" aria-labelledby="productOffcanvasLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="productOffcanvasLabel">Product Details</h5>
        <a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="offcanvas">
          <i class="ti ti-x f-20"></i>
        </a>
      </div>
      <div class="offcanvas-body">
        <div class="card product-card shadow-none border-0">
          <div class="card-img-top p-0">
            <a href="ecom_product-details.html">
              <img src="../assets/images/application/img-prod-4.jpg" alt="image" class="img-prod img-fluid" />
            </a>
            <div class="card-body position-absolute end-0 top-0">
              <div class="form-check prod-likes">
                <input type="checkbox" class="form-check-input" />
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  class="feather feather-heart prod-likes-icon"
                >
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                  ></path>
                </svg>
              </div>
            </div>
            <div class="card-body position-absolute start-0 top-0">
              <span class="badge bg-danger badge-prod-card">30%</span>
            </div>
          </div>
        </div>
        <h5>Glitter gold Mesh Walking Shoes</h5>
        <p class="text-muted"
          >Image Enlargement: After shooting, you can enlarge photographs of the objects for clear zoomed view. Change In Aspect Ratio:
          Boldly crop the subject and save it with a composition that has impact.</p
        >
        <ul class="list-group list-group-flush">
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Price</p>
              <h4 class="mb-0"><b>$299.00</b><span class="mx-2 f-14 text-muted f-w-400 text-decoration-line-through">$399.00</span></h4>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Categories</p>
              <h6 class="mb-0">Shoes</h6>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Status</p>
              <h6 class="mb-0"><span class="badge bg-warning rounded-pill">Process</span></h6>
            </div>
          </li>
          <li class="list-group-item px-0">
            <div class="d-inline-flex align-items-center justify-content-between w-100">
              <p class="mb-0 text-muted me-1">Brands</p>
              <h6 class="mb-0"><img src="../assets/images/application/img-prod-brand-1.png" alt="user-image" class="wid-40" /></h6>
            </div>
          </li>
        </ul>
      </div>
    </div>
    
    <?php 

      include "../layouts/footer.php";

    ?>

    <?php 

      include "../layouts/scripts.php";

    ?>


    <!-- [Page Specific JS] start -->
    <script>
      // scroll-block
      var tc = document.querySelectorAll('.scroll-block');
      for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
      }
    </script>
   
   <?php 

      include "../layouts/modals.php";

    ?>

  </body>
  <!-- [Body] end -->
</html>
