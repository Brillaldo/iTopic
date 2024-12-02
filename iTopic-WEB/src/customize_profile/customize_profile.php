<?php
session_start();
include '../db.php'; // Conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];
$mensaje = '';

// Procesar el formulario de personalización de perfil
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customize_profile'])) {
    $biografia = $_POST['biografia'];
    
    // Manejar la subida de la imagen de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        $targetDir = "/var/www/html/uploads/"; // Ruta absoluta para guardar la imagen
        $targetFile = $targetDir . basename($_FILES["foto_perfil"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validar el tipo de archivo
        $check = getimagesize($_FILES["foto_perfil"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $targetFile)) {
                // Guardar la biografía y la ruta de la foto en la base de datos
                $sql = "UPDATE usuarios SET biografia = ?, foto_perfil = ? WHERE usuario = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("sss", $biografia, $targetFile, $nombreUsuario);
                    if ($stmt->execute()) {
                        $_SESSION['foto_perfil'] = $targetFile; // Guardar la ruta de la foto en la sesión
                        unset($_SESSION['nuevo_usuario']); // Quitar la bandera de nuevo usuario
                        header("Location: ../home.php");
                        exit();
                    } else {
                        $mensaje = "Error al actualizar el perfil.";
                    }
                    $stmt->close();
                }
            } else {
                $mensaje = "Error al mover la imagen al directorio de destino.";
            }
        } else {
            $mensaje = "El archivo no es una imagen válida.";
        }
    } else {
        $mensaje = "Por favor, selecciona una imagen de perfil válida.";
    }
}

// Manejar el botón "Omitir"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['omitir'])) {
    unset($_SESSION['nuevo_usuario']); // Quitar la bandera de nuevo usuario
    header("Location: ../home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar Perfil</title>
    <link rel="stylesheet" href="../customize_profile/styles.css">
</head>
<body>
    <div class="customize-profile-container">
        <h1>Personaliza tu Perfil</h1>

        <?php if ($mensaje): ?>
            <p class="error-message"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <form action="customize_profile.php" method="POST" enctype="multipart/form-data">
            <div class="field-wrap">
                <label for="foto_perfil">Foto de Perfil:</label>
                <input type="file" id="foto_perfil" name="foto_perfil" required>
            </div>
            <div class="field-wrap">
                <label for="biografia">Biografía:</label>
                <textarea id="biografia" name="biografia" rows="5" required></textarea>
            </div>
            <button type="submit" name="customize_profile" class="button button-block">Guardar Cambios</button>
        </form>

        <form action="customize_profile.php" method="POST">
            <button type="submit" name="omitir" class="button button-block omit-button">Omitir</button>
        </form>
    </div>
</body>
</html>
