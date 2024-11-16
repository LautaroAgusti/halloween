<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$con = mysqli_connect('localhost', 'root', '', 'halloween');
if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

if (isset($_POST['id_disfraz'])) {
    $id_disfraz = (int)$_POST['id_disfraz'];
    $id_usuario = $_SESSION['usuario'];

    $query = "SELECT * FROM votos WHERE id_usuario = $id_usuario AND id_disfraz = $id_disfraz";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 0) {
        $insert_vote = "INSERT INTO votos (id_usuario, id_disfraz) VALUES ($id_usuario, $id_disfraz)";
        mysqli_query($con, $insert_vote);

        $update_votes = "UPDATE disfraces SET votos = votos + 1 WHERE id = $id_disfraz";
        mysqli_query($con, $update_votes);

        echo "Voto registrado con éxito.";
    } else {
        echo "Ya has votado por este disfraz.";
    }
}
header("Location: index.php");
exit();
?>
