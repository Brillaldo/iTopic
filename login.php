<?php

require_once"includes/conexion.php";

if(isset($_POST["login"])){

   if(!empty($_POST['nombre']) && !empty($_POST['contrasena'])){
    $nombre=$_POST['nombre'];
    $contrasena=$_POST['contrasena'];
    $query = $connection->prepare("SELECT * FROM usuario WHERE nombre = :nombre");
    $query->bindParam("nombre", $nombre, PDO::FETCH_ASSOC);
    $query->execute();
   
    $result=$query->fetch(PDO::FETCH_ASSOC);
   
    if(!$result){
   echo '<p class="error"> correo o la contrasna estan incorrectos!<p>';
    }else{
        $contrasenaAlmacenada = $result['contrasena'];

            if (password_verify($contrasena, $contrasenaAlmacenada)) {
                $_SESSION['sesion_nombre'] = $nombre;
                echo 'Éxito de la cuenta';
            } else {
                $message = "Correo o contraseña inválidos";
                echo $message;
            }
        }
   
   
    }
}
?>



