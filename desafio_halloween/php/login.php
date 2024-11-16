<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'halloween');
if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

if (isset($_POST['nombre']) && isset($_POST['clave'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $query = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($_POST['clave'], $user['clave'])) {
            $_SESSION['usuario'] = $user['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
</head>
<body>
    <h1>Inicio de Sesión</h1>
    <form method="post">
        <label>Nombre de usuario:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="clave" required>
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
