<?php
require_once("includes/conexion.php");
session_start();
if(isset ($_POST ["register"])){
    if (!empty ($_POST['nombre']) && !empty($_POST ['apellido']) && !empty($_POST ['correo'])&& !empty($_POST ['contrasena'])){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $correo=$_POST['correo'];
        $contrasena=$_POST['contrasena'];
        $contrasena=password_hash($contrasena, PASSWORD_BCRYPT);



        $query = $connection->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $query->bindParam("correo", $correo, PDO :: PARAM_STR);
        $query -> execute();


        if($query-> rowCount()>0){
        echo ' El email ya se encuentra registrado';
        }

        if($query->rowCount()==0){

            $query = $connection->prepare("INSERT INTO usuario (nombre, apellido, correo, contrasena) VALUES (?, ?, ?, ?)");

            $query->bindParam(1, $nombre, PDO::PARAM_STR);
            $query->bindParam(2, $apellido, PDO::PARAM_STR);
            $query->bindParam(3, $correo, PDO::PARAM_STR);
            $query->bindParam(4, $contrasena, PDO::PARAM_STR);
            
            $query->execute();
            
            
        echo $nombre;
        echo $apellido;
        echo $correo;
        echo $contrasena;
        $rowCount = $query->rowCount();

        if ($rowCount > 0) {
            echo "Cuenta creada correctamente";
        } else {
            echo "Error al crear la cuenta, verifique los datos";
        }

    }
 }
}
?>
