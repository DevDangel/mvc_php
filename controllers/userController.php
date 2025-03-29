<?php
require_once('C:/xampp/htdocs/MVC_PHP/model/userModel.php'); //Requerimiento del controlador 

class userController{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new userModel(); //herencia maso meno
    }

    //funcion para agregar un usuario
    public function addUser($nombre,$apellido,$e_mail){
        if($this->userModel->addUser($nombre,$apellido,$e_mail)){
            echo "Usuario agregado exitosamente.";
        }else{
            echo "Hubo un error al agregar al usuario.";
        }
    }

    //Funcion para eliminar un usuario
    public function deleteUser($id){
        if($this->userModel->deleteUser($id)){
            echo "Usuario eliminado exitosamente.";
        }else{
            echo "Hubo un error al eliminar al usuario";
        }
    }

    //funcion para obtener todos los usuarios
    public function getUsers(){
        return $this->userModel->getUsers();
    }

    //Login for MVC
    //logica para el registro
    public function register($nombre,$password){
        if($this->userModel->registerUser($nombre,$password)){
            echo "Usuario creado exitosamente";
        }else{
            echo "Error al registrar usuario";
        }
    }

    //logica ingreso "login"
    public function login($nombre, $password) {
        $user = $this->userModel->authenticateUser($nombre, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user['nombre'];
            header("Location: index.php");
        } else {
            $_SESSION['error_message']= "Credenciales incorrectas.";
            header("Location: login.php");
            exit();
        }
    }
}
?>