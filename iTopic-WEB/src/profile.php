<?php
session_start();
include 'db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];
$fotoPerfil = isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'profile-placeholder.png';

// Obtener la biografía del usuario de la base de datos
$sql = "SELECT biografia FROM usuarios WHERE usuario = ?";
$biografia = '';
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $nombreUsuario);
    $stmt->execute();
    $stmt->bind_result($biografia);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - iTopic</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <!-- Sección del Perfil -->
    <div class="profile-container">
        
        <div class="back-button">
             <a href="home.php" class="button">Volver a Inicio</a>
        </div>
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($fotoPerfil); ?>" alt="Foto de Perfil" class="profile-picture-large">
            <h1 class="profile-username"><?php echo htmlspecialchars($nombreUsuario); ?></h1>
            <p class="profile-bio"><?php echo htmlspecialchars($biografia); ?></p>
        </div>

        <!-- Publicaciones -->
        <div class="publicaciones-section">
            <h2>Tus Publicaciones</h2>
            <div class="publicaciones-content">
                <!-- Aquí se mostrarán las publicaciones del usuario -->
            </div>
        </div>

        <!-- Mapa de Ubicaciones -->
        <div class="mapa-section">
            <h2>Mapa de Ubicaciones</h2>
            <div class="mapa-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1565.7945323556617!2d-89.56646893388232!3d21.02836434975351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5677a6c3afd0ff%3A0xfd1f9bc6d3e25c18!2sLaboratorio%20de%20innovaci%C3%B3n%20de%20la%20Universidad%20Modelo!5e0!3m2!1ses-419!2smx!4v1730238735636!5m2!1ses-419!2smx" 
                class="map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- Calendario de Eventos -->
        <div class="calendario-section">
            <h2>Calendario de Eventos</h2>
            <div class="calendario-content">
                <p>Calendario de actividad (Aquí se mostraría un calendario en una implementación real)</p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
