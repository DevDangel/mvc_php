<?php
require_once('C:/xampp/htdocs/MVC_PHP/controllers/userController.php');
$userController = new userController();

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $userController->login($nombre, $password);
}

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';//ternaria
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e8f5e9; /* Verde claro suave */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff; /* Fondo blanco */
            border: 2px solid #a5d6a7; /* Verde claro */
            border-radius: 10px;
            padding: 20px 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4caf50; /* Verde principal */
            margin-bottom: 20px;
            font-size: 24px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #c8e6c9; /* Verde muy claro */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f9fdf9; /* Verde pálido */
        }

        input:focus {
            outline: none;
            border-color: #4caf50; /* Verde principal */
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50; /* Verde principal */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #388e3c; /* Verde más oscuro */
        }

        .error-message{
            color: red; 
            margin-top: 10px; 
            text-align: center;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #388e3c; /* Verde oscuro */
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* Estilo específico para el formulario de registro */
        .register-form .form-container {
            border-color: #81c784; /* Verde claro para el registro */
        }   

        .register-form h1 {
         color: #66bb6a; /* Verde más brillante para registro */
        }
        
</style>
    <!-- Puedes vincular un archivo CSS externo aquí -->
</head>
<body>
    <div class="form-container">
        <h1>Iniciar Sesión</h1>
        <form action="login.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <?php if ($error_message):?>
                <div class="error-message"><?php echo $error_message;?></div>
            <?php endif; ?>    
        </form>
        <a href="register.php" class="link">¿No tienes una cuenta? Regístrate</a>
    </div>
</body>
</html>