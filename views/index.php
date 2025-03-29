<?php
require_once('C:/xampp/htdocs/MVC_PHP/controllers/userController.php');

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userController = new userController(); //instancia del controlador
$users = $userController->getUsers();//obtener todos los usuarios


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC PHP</title>
    <link rel="stylesheet" href="/assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            margin: 0 auto;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input, button {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #f1f1f1;
        }

        .delete-btn {
            color: red;
            cursor: pointer;
        }

        .form-container input {
            width: 30%;
            margin-right: 10px;
        }

        .form-container button {
            width: auto;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
        .logout-link {
            position: absolute;
            top: 10px;
            right: 10px;
            display: inline-block;
            padding: 5px 10px; /* Reduce el espaciado interno */
            background-color: #218838; /* Color del botón */
            color: white;
            text-decoration: none;
            border-radius: 3px; /* Reduce el redondeo de las esquinas */
            font-size: 14px; /* Reduce el tamaño del texto */
            font-weight: normal; /* Cambia el texto a peso normal */
            transition: background-color 0.3s ease;
            text-align: center;
        }


        .logout-link:hover {
            background-color: #d32f2f; /* Rojo más oscuro al pasar el cursor */
            cursor: pointer; /* Cambia el cursor al estilo "mano" */
        }
    </style>
    <a href="logout.php" class="logout-link">Cerrar sesión</a>
</head>
<body>
    <section>
        <select name="text" id="" placeholder="Elige tu sexo">Elige tu sexo
            <option value="">sexo</option>
            <option value="">ANAL</option>
            <option value="">sin condon</option>
        </select>
    </section>
    <h1>MVC with PHP by Angel Herrera</h1>
    <div class="form-container">
        <form action=""method="POST">
            <input type="text" name="nombre" placeholder="Nombre"required>
            <input type="text"name="apellido" placeholder="Apellido"required>
            <input type="text"name="e_mail" placeholder="Correo electronico"required>
            <button type="submit"name="add">Agregar +</button>
        </form>
    </div>
    <?php
    //verificar si el formulario se envio para agregar un nuevo usuario
    if (isset($_POST['add'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $e_mail = $_POST['e_mail'];

        $userController->addUser($nombre,$apellido,$e_mail);//agregar al usuario a la base de datos
        header("Location: index.php");//Redirigir para evitar el reenvio del formulario
    }
    ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo electronico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //mostrar los empleados en la tabla
                foreach($users as $user):
                ?>
                <tr>
                    <td><?php echo $user['id'];?></td>
                    <td><?php echo $user['nombre'];?></td>
                    <td><?php echo $user['apellido'];?></td>
                    <td><?php echo $user['e_mail'];?></td>
                    <td>
                        <a href="?delete=<?php echo $user['id'];?>"class="delete-btn" title="Eliminar este campo">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach;?>        
            </tbody>
        </table>
    </div>
    <?php
    //verificar si hizo click en el enlace de eliminar 
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $userController->deleteUser($id); // Eliminar el usuario de la base de datos
        header("Location: index.php"); // Redirigir para evitar el reenvío del formulario
    }
    ?>
</body>
</html>