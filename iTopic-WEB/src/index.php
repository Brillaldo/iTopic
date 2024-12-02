<?php
session_start();
include 'db.php'; // Conexión a la base de datos

$mensaje = '';

// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "register") {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    if ($contraseña !== $confirmar_contraseña) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (usuario, correo, contrasena) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $usuario, $correo, $contraseña_hash);
            if ($stmt->execute()) {
                $_SESSION['usuario'] = $usuario;
                echo "<script>alert('Registro exitoso. Personaliza tu perfil para continuar.'); window.location.href = 'customize_profile/customize_profile.php';</script>";
                exit();
            } else {
                $mensaje = "Error al registrar el usuario.";
            }
            $stmt->close();
        } else {
            $mensaje = "Error en la preparación de la consulta.";
        }
    }
}

// Procesar el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "login") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conn->prepare("SELECT idUsuario, contrasena FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contrasena'])) {
            $_SESSION['usuario'] = $usuario;
            echo "<script>alert('Login exitoso'); window.location.href = 'home.php';</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTopic - Landing Page</title>
    <link rel="stylesheet" href="styles2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #121212;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Navbar */
        .navbar {
            position: absolute;
            top: 0;
            right: 0;
            margin: 20px;
            display: flex;
            gap: 10px;
        }

        .navbar button {
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            background: #fff;
            color: #121212;
            border: none;
            border-radius: 8px;
            transition: background 0.3s, color 0.3s;
        }

        .navbar button:hover {
            background: #f1f1f1;
            color: #000;
        }

        /* Landing Page Content */
        .landing-page {
            text-align: center;
            max-width: 600px;
        }

        .landing-page h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .landing-page p {
            font-size: 1.2rem;
            color: #ccc;
        }

        /* Formularios Pop-up */
        #form-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #1a1a1a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 100;
        }

        .form-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            color: #fff;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: #333;
            border: 1px solid #555;
            color: #fff;
            border-radius: 4px;
        }

        .form-button {
            width: 100%;
            padding: 15px;
            background: #fff;
            color: #121212;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        .form-button:hover {
            background: #f1f1f1;
            color: #000;
        }
    </style>
    <script>
        // Mostrar u ocultar el formulario según la opción seleccionada
        function mostrarFormulario(opcion) {
            $('#form-container').fadeIn();
            $('.form-content').hide();
            if (opcion === 'register') {
                $('#form-register').show();
            } else if (opcion === 'login') {
                $('#form-login').show();
            }
        }

        // Ocultar el formulario
        function cerrarFormulario() {
            $('#form-container').fadeOut();
        }
    </script>
</head>
<body>
    <!-- Navbar con botones de registro e inicio de sesión -->
    <div class="navbar">
        <button onclick="mostrarFormulario('register')">Registrarse</button>
        <button onclick="mostrarFormulario('login')">Iniciar Sesión</button>
    </div>

    <!-- Contenido de la página principal (Landing Page) -->
    <div class="landing-page">
        <h1>Bienvenido a iTopic</h1>
        <p>Conecta con tus amigos, comparte experiencias en tiempo real y descubre lugares nuevos.</p>
    </div>

    <!-- Formulario pop-up de registro e inicio de sesión -->
    <div id="form-container">
        <button class="form-close-btn" onclick="cerrarFormulario()">&times;</button>

        <!-- Formulario de registro -->
        <div id="form-register" class="form-content">
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="register">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <input type="password" name="confirmar_contraseña" placeholder="Confirmar Contraseña" required>
                <button type="submit" class="form-button">Registrar</button>
            </form>
        </div>

        <!-- Formulario de login -->
        <div id="form-login" class="form-content">
            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="login">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                <button type="submit" class="form-button">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <?php if ($mensaje): ?>
        <script>alert('<?php echo $mensaje; ?>');</script>
    <?php endif; ?>
</body>
</html>
