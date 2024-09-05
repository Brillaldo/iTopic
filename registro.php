<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="container mregister">
    <div id="login">
        <h1>Registrar</h1>
        <form name="registerform" id="registerform" action="register.php" method="post">
        <p>
            <label for="user_login">Nombre Completo<br/>
            <input type="text" name="nombre" id="nombre" class="input" size="32" value="" /></label>
        </p>
        <p>
            <label for="user_login">Apellido<br/>
            <input type="text" name="apellido" id="apellido" class="input" size="32" value="" /></label>
        </p>
        <p>
            <label for="user_pass">Email<br/>
            <input type="email" name="correo" id="correo" class="input" size="32" value="" /></label>
        </p>
        <p>
            <label for="user_pass">Contraseña<br/>
            <input type="password" name="contrasena" id="contrasena" class="input" size="32" value="" /></label>
        </p>

        <p class="submit">
        <input type="submit" name="register" id="register" class="button" value="Register" />
        </p>

     
        </form>
</div>
</div> 
</body>
</html>