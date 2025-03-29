<?php
class Database{
    private $host = "localhost:33067"; //Servidor local
    private $db_name = "empleados"; //nombre de la base de datos
    private $username = "root"; //nombre de la direccion
    private $password = ""; //contraseña NOTA: no hay NOTA: cambió
    public $conn;

    public function connect(){
        $this->conn = null; //agregamos la propiedad "conn" para guardar y gestionar conexion
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
            $this->conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // depurar errores
            echo "Conexion Exitosa";
        }catch (PDOException $e){
            // depurar errores
            echo "Error de conexión: ".$e->getMessage();
        }
        return $this->conn;
    }
}
?>

