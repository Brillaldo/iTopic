<?php 

require_once("includes/conexion.php");
//include("includes/header.php");
//verificar que se haya apretado el boton del login,
//INVESTIGAR COMO HASHEAR UNA CONTRASENA
if(isset($_POST["login"])){
   //se verifica que correo y contrasna no esten vacios
   // Al registrar un usuario, hasheas la contraseña antes de almacenarla en la base de datos
    
// Guardar $contrasena_hasheada en la base de datos

   if(!empty($_POST['nombre']) && !empty($_POST['contrasena'])){
    $nombre=$_POST['nombre'];
    $contrasena=$_POST['contrasena'];
    //se consulta en la base de datos que coincidan
    $query = $connection->prepare("SELECT * FROM usuario WHERE nombre = :nombre");
    $query->bindParam("nombre", $nombre, PDO::FETCH_ASSOC);
    $query->execute();
   
    $result=$query->fetch(PDO::FETCH_ASSOC);
   
    // se almacena en la variable result el resultado de la consulta
   
    //si el resultado de la cunsulta no coincide con las variables se manda un mensaje de error .
    if(!$result){
   echo '<p class="error"> correo o la contrasna estan incorrectos!<p>';
    }else{
        $contrasenaAlmacenada = $result['contrasena'];

            if (password_verify($contrasena, $contrasenaAlmacenada)) {
                // Contraseña correcta
                $_SESSION['sesion_nombre'] = $nombre;
                echo 'Éxito de la cuenta';
                // header("Location: prueba1.php");
            } else {
                // Contraseña incorrecta
                $message = "Correo o contraseña inválidos";
                echo $message;
            }
        }
   
   
    }
}
?>



