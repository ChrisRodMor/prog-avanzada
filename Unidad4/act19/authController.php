<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class AuthController
{
    public function login($email, $password)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $email, 'password' => $password),
            CURLOPT_HTTPHEADER => array(
                'Cookie: XSRF-TOKEN=eyJpdiI6InA3VVhoM0tHSTRZRXNlYjVzNlFqM2c9PSIsInZhbHVlIjoibEw5bWFzbDdGRmpTN1Rqb3d6NTdNTXNmR0wrUWk3RkF0ek55SkhQNUlQYWF5K216dE1FUU9kc3dnZFc0a1J5ZFRlOVEyTFhhZTI1RDExbG02UGIrc2k1N3E4Y0RWakVlZnNyZ2Zwd1Z5UWdsOWdFTWpJWkhYclNQWVlqTXBhYkYiLCJtYWMiOiI4MDc3MGYwMzkwMDk4ODFjY2Q3NjU4NzJlOTc5ZDI2NGFmNGNlYjYxODQzZGM0ZDQ3M2YwNjA5MjVhODY0N2I3IiwidGFnIjoiIn0%3D; apicrud_session=eyJpdiI6IlJ2ZEMrcFhRaXlSUE9ycUNNQUtsdFE9PSIsInZhbHVlIjoiSVY0Mk1WOGxSQzRPMnJ6dm5YeStNUjZ1ckVuQjZkWXJoZ2gzMmdkR1dicVlsN3dFWUlGTXN1TGJ0Y1BvTWExRXZxZkJWOTQ3V0JaOXZlMWdBTmlzUm5DaDhrMWZ6eTVkQ3hmdlBQcy9HWFpKU1oxNzFVWmpERXpHSnprOGhSVi8iLCJtYWMiOiJiOTI2YTA5MmU4MGY3ODg5M2U1MTM2YjY2YzYzZTRjNTIyYjQ5ZTc4YmUzMDZhZTJhOTZhMjAxNWJjN2FjNTQ3IiwidGFnIjoiIn0%3D'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error en la conexión a la API: ' . curl_error($curl);
            curl_close($curl);
            return;
        }

        curl_close($curl);

        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            header('Location: login.php');
            return;
        }

        $userData = $result['data'];
        $name = $userData['name'];
        $lastname = $userData['lastname'];
        $token = $userData['token'];

        session_start();
        $_SESSION['token'] = $token;
        $_SESSION['name'] = $name;

        echo "Bienvenido, $name $lastname con el token: $token";
        header('Location: index.php');
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: login.php');
    }
}












class ProductController
{
    public function getProducts()
    {

        $curl = curl_init();

        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error en la conexión a la API: ' . curl_error($curl);
            curl_close($curl);
            return [];
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['data'])) {
            return $result['data'];
        }

        return [];
    }

    public function getProductsBySlug($slug) {
        $curl = curl_init();
    
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        
        $result = json_decode($response, true);
    
        return $result['data'];
    }

    public function agregarProducto($name, $slug, $description, $features,$cover){

        $curl = curl_init();

        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }


        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name,'slug' => $slug,'description' => $description,'features' => $features, 'cover'=> new CURLFILE($cover)),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['token'],
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        header('Location: index.php');
    }

    public function editProduct($id, $name, $slug, $description, $features) {
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode(array(
                'id' => $id,
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        echo $response;
        header('Location: index.php');

    }

    public function deleteProduct($id) {
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
        
        header('Location: index.php');
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        
        $action = $_POST['action'];

        $authController = new AuthController();
        $productController = new ProductController();

        switch ($action) {
            case 'login':
                $email = $_POST['correo'];
                $password = $_POST['contrasena'];
                $authController->login($email, $password);
                break;

            case 'logout':
                $authController->logout();
                break;
            
            case 'addProduct':
                $name = $_POST['name'];
                $slug = $_POST['slug'];
                $description = $_POST['description'];
                $features = $_POST['features'];
                $cover = $_FILES['cover']['tmp_name'];

                $productController->agregarProducto($name, $slug, $description, $features, $cover);
                break;

            case 'editProduct':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $slug = $_POST['slug'];
                $description = $_POST['description'];
                $features = $_POST['features'];

                $productController->editProduct($id, $name, $slug, $description, $features);
                break;

            case 'deleteProduct':
                $id = $_POST['id'];

                $productController->deleteProduct($id);
                break;
            default:
                echo "Opción no válida.";
                break;
        }
    } else {
        echo "Sin opción.";
    }
}










class CategoryController
{
    public function getCategories()
    { 

        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error en la conexión a la API: ' . curl_error($curl);
            curl_close($curl);
            return [];
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['data'])) {
            return $result['data'];
        }

        return [];
    }
}







class TagController
{
    public function getTags()
    {
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error en la conexión a la API: ' . curl_error($curl);
            curl_close($curl);
            return [];
        }

        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['data'])) {
            return $result['data'];
        }

        return [];
    }
}



?>