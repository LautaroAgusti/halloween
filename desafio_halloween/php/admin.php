<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != 1) { // Supongamos ID 1 es admin
    header("Location: login.php");
    exit();
}

$con = mysqli_connect('localhost', 'root', '', 'halloween');
if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

if (isset($_POST['nombre']) && isset($_FILES['foto'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $archivo = $_FILES['foto']['name'];
    $extension = end(explode('.', $archivo));
    $nombreArchivo = time() . '.' . $extension;

    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        copy($_FILES['foto']['tmp_name'], "fotos/" . $nombreArchivo);
        $query = "INSERT INTO disfraces (nombre, descripcion, votos, foto) VALUES ('$nombre', '$descripcion', 0, '$nombreArchivo')";
        if (mysqli_query($con, $query)) {
            echo "Disfraz agregado con éxito.";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de administración</title>
</head>
<body>
    <h1>Panel de Administración</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nombre del disfraz:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea>
        <br>
        <label>Foto:</label>
        <input type="file" name="foto" required>
        <br>
        <button type="submit">Agregar Disfraz</button>
    </form>
</body>
</html>
