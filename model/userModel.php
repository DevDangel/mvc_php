<?php
require_once('C:/xampp/htdocs/MVC_PHP/config/database.php'); //Requerimiento hacia donde esta apuntando

class userModel {
    private $conn; //atributo para la conexion

    //constructor
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    //metodo para agregar un usuario
    public function addUser($nombre,$apellido,$e_mail){
        //consulta SQL
        $query = "INSERT INTO empleado (nombre, apellido, e_mail) VALUES (:nombre,:apellido,:e_mail)";

        //preparamos la consulta con la instancia "stmt" de PHP DATA OBJECT (PDO)
        $stmt = $this->conn->prepare($query); //prepare() metodo que enfoca ($nombre,$apellido,$e_mail) con (:nombre,:apellido,:e_mail)
        
        //señalizamos los parametros para la consulta
        $stmt->bindParam(':nombre',$nombre);
        $stmt->bindParam(':apellido',$apellido);
        $stmt->bindParam(':e_mail',$e_mail);

        //condicion para si la instancia ejecuta la consulta o no
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //funcion para eliminar un usuario por su id
    public function deleteUser($id){
        $query = "DELETE FROM empleado WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',$id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //Funcion para obtener todos los empleados
    public function getUsers(){
        $query = "SELECT * FROM empleado";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Login for MVC
    
    //registras un usuario
    public function registerUser($nombre, $password) {
        $query = "INSERT INTO usuarios (nombre, password) VALUES (:nombre, :password)";
        $stmt = $this->conn->prepare($query);
        // No se hashea la contraseña
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password); // Almacenar directamente en texto plano
        return $stmt->execute();
    }
    //auntentificar un usuario
    public function authenticateUser($nombre, $password) {
        $query = "SELECT * FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
      
        if ($user && $password === $user['password']) {
            return $user;
        }
        return false;   
    }
}
?>