<?php

class AuthController
{
    public function login($email = null, $password = null)
    {
        // URL de la API de login
        $url = 'https://crud.jonathansoto.mx/api/login';

        // Datos a enviar
        $data = json_encode([
            'email' => $email,
            'password' => $password,
        ]);

        // Configurar la solicitud HTTP
        $options = [
            'http' => [
                'header' => "Content-Type: application/json\r\n" .
                            "Accept: application/json\r\n",
                'method' => 'POST',
                'content' => $data,
            ],
        ];
        $context = stream_context_create($options);
        
        // Hacer la solicitud a la API
        $response = file_get_contents($url, false, $context);

        if ($response === FALSE) {
            echo "Error en la conexión a la API.";
            return;
        }

        // Decodificar la respuesta
        $result = json_decode($response, true);

        // Verificar si hay errores
        if (isset($result['errors'])) {
            echo "Error: " . implode(', ', $result['errors']);
            return;
        }

        // Obtener los datos del usuario
        $userData = $result['data'];
        $name = $userData['name'];
        $lastname = $userData['lastname'];

        echo "Bienvenido, $name $lastname. Has iniciado sesión correctamente.";
    }

    public function logout()
    {
        session_destroy();
        header('Location: login.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        
        $action = $_POST['action'];

        $authController = new AuthController();

        switch ($action) {
            case 'login':
                $email = $_POST['correo'];
                $password = $_POST['contrasena'];
                $authController->login($email, $password);
                break;

            case 'logout':
                $authController->logout();
                break;

            default:
                echo "Opción no válida.";
                break;
        }
    } else {
        echo "Sin opción.";
    }
}
?>
