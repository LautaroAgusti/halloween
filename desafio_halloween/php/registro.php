<?php
$con = mysqli_connect('localhost', 'root', '', 'halloween');
if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

if (isset($_POST['nombre']) && isset($_POST['clave'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    $query = "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave')";
    if (mysqli_query($con, $query)) {
        echo "Usuario registrado con éxito. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="post">
        <label>Nombre de usuario:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="clave" required>
        <br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
