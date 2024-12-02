<?php
$servername = "itopic-sql";  // Este es el nombre del servicio de MySQL en tu archivo docker-compose.yml
$username = "myuser";        // El usuario que definiste en docker-compose.yml
$password = "12345";         // La contraseña que definiste en docker-compose.yml
$dbname = "itopic";          // El nombre de la base de datos que definiste en docker-compose.yml

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
//if ($conn->connect_error) {
//  die("Conexión fallida: " . $conn->connect_error);
//}
//echo "Conectado correctamente";
?>
