<?php 
  include_once "../../app/config.php";

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
                  <li class="breadcrumb-item" aria-current="page">Add New Product</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Add New Product</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h5>Añadir producto</h5>
            </div>
            <div class="card-body">
              <form id="addProductForm" method="POST" action="products" enctype="multipart/form-data">
                <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">

                <div class="mb-3">
                  <label for="name" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" required>
                </div>

                <div class="mb-3">
                  <label for="slug" class="form-label">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Product Slug" required>
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Descripción</label>
                  <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Product Description" required></textarea>
                </div>

                <div class="mb-3">
                  <label for="features" class="form-label">Características</label>
                  <textarea class="form-control" id="features" name="features" rows="2" placeholder="Enter Product Features"></textarea>
                </div>

                <div class="mb-3">
                  <label for="brand_id" class="form-label">Marca</label>
                  <select class="form-select" id="brand_id" name="brand_id" required>
                    <?php
                      foreach ($brands as $brand) {
                        echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                      }
                    ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="cover" class="form-label">Portada (Imagen)</label>
                  <label class="btn btn-outline-secondary" for="cover"><i class="ti ti-upload me-2"></i>Click to Upload</label>
                  <input type="file" class="d-none" id="cover" name="cover" accept="image/*">
                </div>

                <div class="text-end">
                  <a type="button" href="<?php echo BASE_PATH; ?>products" class="btn btn-outline-secondary mb-0">Cancelar</a>
                  <button type="submit" class="btn btn-primary mb-0">Añadir Producto</button>
                </div>

                <input type="hidden" name="action" value="addProduct">
              </form>
            </div>
          </div>

            
          </div>
          
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    
    <?php 

      include "../layouts/footer.php";

    ?> 
<?php 

      include "../layouts/scripts.php";

    ?>

    <?php 

      include "../layouts/modals.php";

    ?>

  </body>
  <!-- [Body] end -->
</html>
