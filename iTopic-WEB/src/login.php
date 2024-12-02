<?php
session_start();
include 'db.php'; // Asegúrate de que `db.php` contiene la conexión a la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $stmt = $conn->prepare("SELECT idUsuario, contrasena FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $row['contrasena'])) {
            $_SESSION['usuario'] = $usuario; // Guardar el usuario en la sesión
            echo "<script>alert('Login exitoso'); window.location.href = 'home.php';</script>";
            
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
