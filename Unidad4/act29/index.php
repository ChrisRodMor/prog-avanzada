<?php 
  include_once "app/config.php";
  require_once __DIR__ . '/app/authController.php';
?>

<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <?php 

      include "views/layouts/head.php";

    ?>

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main v2">
      <div class="bg-overlay bg-dark"></div>
      <div class="auth-wrapper">
        <div class="auth-sidecontent"> <div class="auth-sidefooter">
  <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" class="img-brand img-fluid" alt="images" />
  <hr class="mb-3 mt-4" />
  <div class="row">
    <div class="col my-1">
      <p class="m-0">Made with ♥ by Team <a href="https://themeforest.net/user/phoenixcoded" target="_blank"> Phoenixcoded</a></p>
    </div>
    <div class="col-auto my-1">
      <ul class="list-inline footer-link mb-0">
        <li class="list-inline-item"><a href="<?php echo BASE_PATH; ?>home">Home</a></li>
        <li class="list-inline-item"><a href="https://pcoded.gitbook.io/light-able/" target="_blank">Documentation</a></li>
        <li class="list-inline-item"><a href="https://phoenixcoded.support-hub.io/" target="_blank">Support</a></li>
      </ul>
    </div>
  </div>
</div>
 </div>
 <div class="auth-form">
    <div class="card my-5 mx-3">
        <div class="card-body">
            <h4 class="f-w-500 mb-1">Inicia sesión con tu correo electrónico</h4>
            <p class="mb-3">¿No tienes una cuenta? <a href="register-v2.html" class="link-primary ms-1">Crea una cuenta</a></p>
            <form action="auth" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" id="exampleInputEmail1" required>
                    <div id="emailHelp" class="form-text">Nunca compartiremos su correo con nadie más.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="d-flex mt-1 justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                    </div>
                    <a href="forgot-password-v2.html">
                        <h6 class="text-secondary f-w-400 mb-0">¿Olvidaste tu contraseña?</h6>
                    </a>
                </div>
                <button type="submit" name="action" value="login" class="btn btn-primary w-100 mt-4">Iniciar sesión</button>
            </form>
            <div class="saprator my-3">
                <span>O continúa con</span>
            </div>
            <div class="text-center">
                <ul class="list-inline mx-auto mt-3 mb-0">
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/" class="avtar avtar-s rounded-circle bg-facebook" target="_blank">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com/" class="avtar avtar-s rounded-circle bg-twitter" target="_blank">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://myaccount.google.com/" class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                            <i class="fab fa-google text-white"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="<?= BASE_PATH ?>assets/js/plugins/popper.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/simplebar.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/fonts/custom-font.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/pcoded.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/feather.min.js"></script>

       
    <script>
      layout_change('light');
    </script>
       
    <script>
      layout_sidebar_change('light');
    </script>
      
    <script>
      change_box_container('false');
    </script>
     
    <script>
      layout_caption_change('true');
    </script>
       
    <script>
      layout_rtl_change('false');
    </script>
     
    <script>
      preset_change('preset-1');
    </script>
    
 <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
  <div class="offcanvas-header justify-content-between">
    <h5 class="offcanvas-title">Settings</h5>
    <button type="button" class="btn btn-icon btn-link-danger" data-bs-dismiss="offcanvas" aria-label="Close"
      ><i class="ti ti-x"></i
    ></button>
  </div>
  <div class="pct-body customizer-body">
    <div class="offcanvas-body py-0">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="pc-dark">
            <h6 class="mb-1">Theme Mode</h6>
            <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
            <div class="row theme-color theme-layout">
              <div class="col-4">
                <div class="d-grid">
                  <button class="preset-btn btn active" data-value="true" onclick="layout_change('light');">
                    <span class="btn-label">Light</span>
                    <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid">
                  <button class="preset-btn btn" data-value="false" onclick="layout_change('dark');">
                    <span class="btn-label">Dark</span>
                    <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid">
                  <button
                    class="preset-btn btn"
                    data-value="default"
                    onclick="layout_change_default();"
                    data-bs-toggle="tooltip"
                    title="Automatically sets the theme based on user's operating system's color scheme."
                  >
                    <span class="btn-label">Default</span>
                    <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                      <i class="ph-duotone ph-cpu"></i>
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <h6 class="mb-1">Sidebar Theme</h6>
          <p class="text-muted text-sm">Choose Sidebar Theme</p>
          <div class="row theme-color theme-sidebar-color">
            <div class="col-6">
              <div class="d-grid">
                <button class="preset-btn btn" data-value="true" onclick="layout_sidebar_change('dark');">
                  <span class="btn-label">Dark</span>
                  <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                </button>
              </div>
            </div>
            <div class="col-6">
              <div class="d-grid">
                <button class="preset-btn btn active" data-value="false" onclick="layout_sidebar_change('light');">
                  <span class="btn-label">Light</span>
                  <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                </button>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <h6 class="mb-1">Accent color</h6>
          <p class="text-muted text-sm">Choose your primary theme color</p>
          <div class="theme-color preset-color">
            <a href="#!" class="active" data-value="preset-1"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-2"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-3"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-4"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-5"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-6"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-7"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-8"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-9"><i class="ti ti-check"></i></a>
            <a href="#!" data-value="preset-10"><i class="ti ti-check"></i></a>
          </div>
        </li>
        <li class="list-group-item">
          <h6 class="mb-1">Sidebar Caption</h6>
          <p class="text-muted text-sm">Sidebar Caption Hide/Show</p>
          <div class="row theme-color theme-nav-caption">
            <div class="col-6">
              <div class="d-grid">
                <button class="preset-btn btn active" data-value="true" onclick="layout_caption_change('true');">
                  <span class="btn-label">Caption Show</span>
                  <span class="pc-lay-icon"
                    ><span></span><span></span><span><span></span><span></span></span><span></span
                  ></span>
                </button>
              </div>
            </div>
            <div class="col-6">
              <div class="d-grid">
                <button class="preset-btn btn" data-value="false" onclick="layout_caption_change('false');">
                  <span class="btn-label">Caption Hide</span>
                  <span class="pc-lay-icon"
                    ><span></span><span></span><span><span></span><span></span></span><span></span
                  ></span>
                </button>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="pc-rtl">
            <h6 class="mb-1">Theme Layout</h6>
            <p class="text-muted text-sm">LTR/RTL</p>
            <div class="row theme-color theme-direction">
              <div class="col-6">
                <div class="d-grid">
                  <button class="preset-btn btn active" data-value="false" onclick="layout_rtl_change('false');">
                    <span class="btn-label">LTR</span>
                    <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                  </button>
                </div>
              </div>
              <div class="col-6">
                <div class="d-grid">
                  <button class="preset-btn btn" data-value="true" onclick="layout_rtl_change('true');">
                    <span class="btn-label">RTL</span>
                    <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item pc-box-width">
          <div class="pc-container-width">
            <h6 class="mb-1">Layout Width</h6>
            <p class="text-muted text-sm">Choose Full or Container Layout</p>
            <div class="row theme-color theme-container">
              <div class="col-6">
                <div class="d-grid">
                  <button class="preset-btn btn active" data-value="false" onclick="change_box_container('false')">
                    <span class="btn-label">Full Width</span>
                    <span class="pc-lay-icon"
                      ><span></span><span></span><span></span><span><span></span></span
                    ></span>
                  </button>
                </div>
              </div>
              <div class="col-6">
                <div class="d-grid">
                  <button class="preset-btn btn" data-value="true" onclick="change_box_container('true')">
                    <span class="btn-label">Fixed Width</span>
                    <span class="pc-lay-icon"
                      ><span></span><span></span><span></span><span><span></span></span
                    ></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="d-grid">
            <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

  </body>
  <!-- [Body] end -->
</html>