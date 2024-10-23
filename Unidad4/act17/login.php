<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 p-5">
    
    <div class="container bg-white rounded shadow-lg w-100 p-0">
        <div class="row align-items-stretch g-0">
            <div class="col-md-6 d-none d-sm-none d-md-block p-0">
              <img src="R.jpg" class="img-fluid h-100 rounded-start" alt="Responsive image">
            </div>
            <div class="col-md-6 p-4">
                <div class="text-center">
                    <img src="user.png" class="img mb-3" style="width: 100px;">
                    <h2 class="mb-4">Iniciar sesión en su cuenta</h2>
                </div>
                <form action="authController.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" class="form-control" id="exampleInputEmail1" required>
                        <div id="emailHelp" class="form-text">Nunca compartiremos su correo con nadie más.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                    </div>
                    <button type="submit" name="action" value="login" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>