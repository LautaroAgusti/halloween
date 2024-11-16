<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'halloween');
if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

$query = "SELECT * FROM disfraces WHERE eliminado = 0";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Disfraces de Halloween</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <h1>Disfraces de Halloween</h1>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="disfraz">
                <h3><?= htmlspecialchars($row['nombre']) ?></h3>
                <p><?= htmlspecialchars($row['descripcion']) ?></p>
                <p>Votos: <?= $row['votos'] ?></p>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <form method="post" action="votar.php">
                        <input type="hidden" name="id_disfraz" value="<?= $row['id'] ?>">
                        <button type="submit">Votar</button>
                    </form>
                <?php else: ?>
                    <p><a href="login.php">Inicia sesión para votar</a></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay disfraces disponibles.</p>
    <?php endif; ?>
</body>
</html>
