<?php
// Función para convertir la entrada en booleano, número o dejarla como cadena
function convertir($texto)
{
    $limpio = trim($texto);
    $minusculas = strtolower($limpio);

    if ($minusculas === "true") {
        return true;
    }
    if ($minusculas === "false") {
        return false;
    }
    if (is_numeric($limpio)) {
        return $limpio + 0;
    }
    return $texto;
}

// Función para mostrar adecuadamente el valor (booleanos como "true"/"false")
function mostrar($valor)
{
    if (is_bool($valor)) {
        return $valor ? "true" : "false";
    }
    return htmlspecialchars((string) $valor);
}

// Opciones de operadores permitidos
$operadores = ["and", "or", "xor", "+", "-"];

// Valores para repoblar el formulario
$valor1Raw = $_GET["valor1"] ?? "";
$valor2Raw = $_GET["valor2"] ?? "";
$operador = $_GET["operador"] ?? "and";

$resultado = null;
$error = null;
$v1 = null;
$v2 = null;

// Solo calculamos si llegan los tres parámetros por GET
if (isset($_GET["valor1"], $_GET["valor2"], $_GET["operador"])) {
    $v1 = convertir($valor1Raw);
    $v2 = convertir($valor2Raw);

    switch ($operador) {
        case "and":
            // Los paréntesis son obligatorios porque 'and' tiene menor precedencia que '='.
            // Sin paréntesis, PHP evaluaría: ($resultado = $v1) and $v2.
            $resultado = ($v1 and $v2);
            break;

        case "or":
            // Paréntesis obligatorios: 'or' tiene menor precedencia que '='.
            $resultado = ($v1 or $v2);
            break;

        case "xor":
            // Paréntesis obligatorios: 'xor' tiene menor precedencia que '='.
            $resultado = ($v1 xor $v2);
            break;

        case "+":
            // En PHP 8 sumar cadenas de texto no numéricas produce un error fatal
            if (is_string($v1) || is_string($v2)) {
                $error = "Error: no se pueden realizar operaciones aritméticas con cadenas de texto.";
            } else {
                $resultado = $v1 + $v2;
            }
            break;

        case "-":
            // En PHP 8 restar cadenas de texto no numéricas produce un error fatal
            if (is_string($v1) || is_string($v2)) {
                $error = "Error: no se pueden realizar operaciones aritméticas con cadenas de texto.";
            } else {
                $resultado = $v1 - $v2;
            }
            break;

        default:
            $error = "Operador no válido";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comparator - Parte 5</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        .resultado {
            margin-bottom: 25px;
        }

        .expresion {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .tipos {
            color: #666;
            margin-top: 0;
        }

        .error {
            color: #c00;
            font-weight: bold;
            margin-bottom: 25px;
        }

        form {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        input[type="text"],
        select,
        button {
            padding: 8px 12px;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <h1>Comparator - Parte 5</h1>

    <?php if ($error !== null): ?>
        <!-- Mensaje de error si la operación no es válida -->
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php elseif ($resultado !== null): ?>
        <!-- Resultado antes del formulario -->
        <div class="resultado">
            <p class="expresion">
                <?php echo mostrar($v1) . ' ' . htmlspecialchars($operador) . ' ' . mostrar($v2) . ' → ' . mostrar($resultado); ?>
            </p>
            <p class="tipos">
                <small><?php echo gettype($v1) . ' ' . htmlspecialchars($operador) . ' ' . gettype($v2) . ' → ' . gettype($resultado); ?></small>
            </p>
        </div>
    <?php endif; ?>

    <!-- Formulario que envía por GET a la misma página -->
    <form action="parte5.php" method="get">
        <input type="text" name="valor1" value="<?php echo htmlspecialchars($valor1Raw); ?>" placeholder="Valor 1">

        <select name="operador">
            <?php foreach ($operadores as $op): ?>
                <?php $selected = ($op === $operador) ? ' selected' : ''; ?>
                <option value="<?php echo htmlspecialchars($op); ?>"<?php echo $selected; ?>>
                    <?php echo htmlspecialchars($op); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="valor2" value="<?php echo htmlspecialchars($valor2Raw); ?>" placeholder="Valor 2">

        <button type="submit">Calcular</button>
    </form>
</body>

</html>
