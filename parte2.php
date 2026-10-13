<?php
// Recoger el histórico de tiradas por GET y limpiarlo para conservar solo dígitos 1-6
$resultados = $_GET["resultados"] ?? "";
$resultados = preg_replace("/[^1-6]/", "", $resultados);

// Comprobar si se ha pulsado el botón para lanzar el dado
$resultado = null;
if (isset($_GET["lanzar"])) {
    // Generar un número aleatorio entre 1 y 6
    $resultado = rand(1, 6);
    // Concatenar la nueva tirada al histórico
    $resultados .= $resultado;
}

// Convertir el histórico en array para poder recorrerlo
$tiradas = $resultados !== "" ? str_split($resultados) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Simulador de lanzamiento de dado - Parte 2</title>
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
        table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
        }
        table img {
            width: 40px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Lanzar un dado - Parte 2</h1>

    <!-- Formulario que envía por GET el histórico actualizado -->
    <form action="parte2.php" method="get">
        <input type="hidden" name="resultados" value="<?php echo $resultados; ?>">
        <button type="submit" name="lanzar">Lanzar dado</button>
    </form>

    <?php if ($resultado !== null): ?>
        <!-- Mostrar la última tirada en grande -->
        <div class="resultado">
            <img src="img/dado<?php echo $resultado; ?>.png" alt="Cara del dado: <?php echo $resultado; ?>">
            <p><?php echo $resultado; ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($tiradas)): ?>
        <!-- Histórico de tiradas en formato tabla -->
        <h2>Historial de tiradas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nº de tirada</th>
                    <th>Dado</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tiradas as $indice => $tirada): ?>
                    <tr>
                        <td><?php echo $indice + 1; ?></td>
                        <td><img src="img/dado<?php echo $tirada; ?>.png" alt="Cara del dado: <?php echo $tirada; ?>" width="40"></td>
                        <td><?php echo $tirada; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Enlace para reiniciar el juego sin parámetros -->
    <p><a href="parte2.php">Empezar de nuevo</a></p>
</body>
</html>
