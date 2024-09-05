<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuario</title>
    <!-- Puedes incluir aquí tus enlaces a hojas de estilo, scripts, etc. -->
</head>
<body>
   <div class="container mlogin">
    <div id="login">
        <h1>Login de Usuario</h1>
        <form name="loginform" id="loginform" action="/login.php" method="POST">
            <p>
                <label for="user_login">Nombre<br/>
                <input type="text" name="nombre" id="nombre" class="input" value="" size="32"/></label>
            </p>
            <p>
                <label for="user_pass">Contraseña<br/>
                <input type="password" name="contrasena" id="contrasena" class="input" value="" size="32"/></label>
            </p>
            <p class="submit">
                <input type="submit" name="login" class="button" value="Entrar"/>
            </p>
            <p class="regtext">¿No estás registrado? <a href="/registro.php">Registrarse Aquí</a></p>
        </form>
    </div>
   </div>
</body>
</html>
