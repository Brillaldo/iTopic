<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];
$fotoPerfil = isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'profile-placeholder.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Social</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-logo">iTopic</div>
        <div class="navbar-profile">
            <img src="<?php echo htmlspecialchars($fotoPerfil); ?>" alt="Perfil" class="profile-picture" onclick="redirectToProfile()">
            <span class="profile-name" onclick="redirectToProfile()"><?php echo htmlspecialchars($nombreUsuario); ?></span>
        </div>
    </div>

    <!-- Main Section -->
    <div class="main-section">
        <!-- Historias -->
        <div class="stories-section">
            <!-- Div vacío por ahora -->
        </div>

        <!-- Nueva Publicación -->
        <div class="new-post-section">
            <!-- Div vacío por ahora -->
        </div>

        <!-- Mapa de ubicaciones -->
        <div class="map-section">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1565.7945323556617!2d-89.56646893388232!3d21.02836434975351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f5677a6c3afd0ff%3A0xfd1f9bc6d3e25c18!2sLaboratorio%20de%20innovaci%C3%B3n%20de%20la%20Universidad%20Modelo!5e0!3m2!1ses-419!2smx!4v1730238735636!5m2!1ses-419!2smx" 
            class="map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Lista de ranking -->
        <div class="ranked-general">
            <h2>Ranking de Usuarios</h2>
            <ul id="ranked-list">
                <!-- Lista generada con JavaScript -->
            </ul>
        </div>
    </div>

    <script>
        function redirectToProfile() {
            window.location.href = 'profile.php';
        }
    </script>
    <script src="script.js"></script>
</body>
</html>
