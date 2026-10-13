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
        // Concatenamos para no meter variables pegadas a caracteres dentro de comillas dobles
        echo '<option value="' . $indice . '"' . $selected . '>' . htmlspecialchars($texto) . '…</option>' . "\n";
    }
}

// Función que devuelve el texto personalizado si existe, o el del desplegable por defecto
function elegir($custom, $lista, $indice)
{
    if ($custom !== "") {
        return $custom;
    }
    return $lista[$indice] ?? "";
}

// Recoger los textos personalizados introducidos por el usuario
$intro_custom = trim($_GET["intro_custom"] ?? "");
$accion_custom = trim($_GET["accion_custom"] ?? "");
$cierre_custom = trim($_GET["cierre_custom"] ?? "");

// Recoger el modo de generación (manual o aleatoria)
$modo = $_GET["modo"] ?? null;

// Determinar los índices según el modo
if ($modo === "aleatoria") {
    // En modo aleatorio, elegimos un índice al azar de cada array
    $intro = array_rand($intros);
    $accion = array_rand($acciones);
    $cierre = array_rand($cierres);
} else {
    // En modo manual, recogemos los índices enviados por GET
    $intro = (int) ($_GET["intro"] ?? -1);
    $accion = (int) ($_GET["accion"] ?? -1);
    $cierre = (int) ($_GET["cierre"] ?? -1);
}

// La frase solo se genera si llega el parámetro modo por GET
$frase = null;
if (isset($_GET["modo"])) {
    // La función elegir da prioridad al texto personalizado sobre el desplegable
    $parteIntro = elegir($intro_custom, $intros, $intro);
    $parteAccion = elegir($accion_custom, $acciones, $accion);
    $parteCierre = elegir($cierre_custom, $cierres, $cierre);

    if ($parteIntro !== "" && $parteAccion !== "" && $parteCierre !== "") {
        $frase = $parteIntro . " " . $parteAccion . " " . $parteCierre . ".";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Constructor de frases - Parte 4</title>
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
            text-align: left;
        }

        fieldset {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        legend {
            font-weight: bold;
        }

        select,
        input[type="text"],
        button {
            padding: 8px 12px;
            font-size: 1rem;
            margin-top: 6px;
        }

        input[type="text"] {
            width: 280px;
            display: block;
        }

        select {
            width: 100%;
        }

        .botones {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <h1>Constructor de frases - Parte 4</h1>

    <?php if ($frase !== null): ?>
        <!-- Se usa htmlspecialchars para prevenir ataques XSS con texto del usuario -->
        <p class="frase"><?php echo htmlspecialchars($frase); ?></p>
    <?php endif; ?>

    <!-- Formulario que envía por GET a la misma página -->
    <form action="parte4.php" method="get">
        <fieldset>
            <legend>Introducción</legend>
            <select name="intro">
                <?php pintarOpciones($intros, $intro); ?>
            </select>
            <!-- htmlspecialchars evita XSS al conservar el valor en el input -->
            <input type="text" name="intro_custom" value="<?php echo htmlspecialchars($intro_custom); ?>" placeholder="O escribe tu propia introducción">
        </fieldset>

        <fieldset>
            <legend>Acción</legend>
            <select name="accion">
                <?php pintarOpciones($acciones, $accion); ?>
            </select>
            <!-- htmlspecialchars evita XSS al conservar el valor en el input -->
            <input type="text" name="accion_custom" value="<?php echo htmlspecialchars($accion_custom); ?>" placeholder="O escribe tu propia acción">
        </fieldset>

        <fieldset>
            <legend>Cierre</legend>
            <select name="cierre">
                <?php pintarOpciones($cierres, $cierre); ?>
            </select>
            <!-- htmlspecialchars evita XSS al conservar el valor en el input -->
            <input type="text" name="cierre_custom" value="<?php echo htmlspecialchars($cierre_custom); ?>" placeholder="O escribe tu propio cierre">
        </fieldset>

        <div class="botones">
            <button type="submit" name="modo" value="manual">Generar frase</button>
            <button type="submit" name="modo" value="aleatoria">Frase aleatoria</button>
        </div>
    </form>
</body>

</html>