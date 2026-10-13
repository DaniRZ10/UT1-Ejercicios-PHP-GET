<?php
// Comprobar si se ha pulsado el botón para lanzar el dado
$resultado = null;
if (isset($_GET["lanzar"])) {
    // Generar un número aleatorio entre 1 y 6
    $resultado = rand(1, 6);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Simulador de lanzamiento de dado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .resultado {
            margin-top: 20px;
        }
        .resultado img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <h1>Lanzar un dado</h1>

    <!-- Formulario que envía por GET a la misma página -->
    <form action="parte1.php" method="get">
        <button type="submit" name="lanzar">Lanzar dado</button>
    </form>

    <?php if ($resultado !== null): ?>
        <!-- Mostrar el resultado solo si se ha lanzado el dado -->
        <div class="resultado">
            <img src="img/dado<?php echo $resultado; ?>.png" alt="Cara del dado: <?php echo $resultado; ?>">
            <p><?php echo $resultado; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
