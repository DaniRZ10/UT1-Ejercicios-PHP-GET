<?php
// Arrays con las partes de las frases
$intros = [
    "Yo en tu lugar",
    "La verdad es que",
    "Tú sabes que",
    "No hay duda de que",
    "Al final"
];

$acciones = [
    "siempre hay que invertir en",
    "lo importante es",
    "nunca subestimes",
    "yo siempre digo que",
    "el secreto está en"
];

$cierres = [
    "la bolsa de valores",
    "el no tener dinero congelado en el banco",
    "los chemtrails",
    "la nube",
    "las crypto"
];

// Función para generar las opciones de cada desplegable
function pintarOpciones($opciones, $seleccionado)
{
    foreach ($opciones as $indice => $texto) {
        $selected = ($indice === $seleccionado) ? ' selected' : '';
        echo "<option value=\"$indice\"$selected>" . htmlspecialchars($texto) . "…</option>\n";
    }
}

// Recoger los índices seleccionados por GET
$intro = (int) ($_GET["intro"] ?? -1);
$accion = (int) ($_GET["accion"] ?? -1);
$cierre = (int) ($_GET["cierre"] ?? -1);

// Comprobar que los tres índices existen en sus respectivos arrays
$frase = null;
if (isset($intros[$intro]) && isset($acciones[$accion]) && isset($cierres[$cierre])) {
    $frase = $intros[$intro] . " " . $acciones[$accion] . " " . $cierres[$cierre] . ".";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Constructor de frases - Parte 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        .frase {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 25px;
            color: #333;
        }

        form {
            display: inline-block;
        }

        .campo {
            margin-bottom: 15px;
        }

        select,
        button {
            padding: 8px 12px;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <h1>Constructor de frases - Parte 3</h1>

    <?php if ($frase !== null): ?>
        <!-- Frase generada mostrada encima del formulario -->
        <p class="frase"><?php echo htmlspecialchars($frase); ?></p>
    <?php endif; ?>

    <!-- Formulario que envía por GET a la misma página -->
    <form action="parte3.php" method="get">
        <div class="campo">
            <select name="intro">
                <?php pintarOpciones($intros, $intro); ?>
            </select>
        </div>

        <div class="campo">
            <select name="accion">
                <?php pintarOpciones($acciones, $accion); ?>
            </select>
        </div>

        <div class="campo">
            <select name="cierre">
                <?php pintarOpciones($cierres, $cierre); ?>
            </select>
        </div>

        <button type="submit">Generar frase</button>
    </form>
</body>

</html>