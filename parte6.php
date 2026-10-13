<?php
// Frase fija original
$fraseOriginal = "Hace frío mucho frío tiempo frío que frío me frío estoy frío quedando frío contigo frío";

// Convertir la frase en array separando por espacios
$palabras = explode(" ", $fraseOriginal);

// Opción A: bucle for que avanza de 2 en 2
// Las posiciones impares de la frase (1ª, 3ª, 5ª...) corresponden a los índices pares (0, 2, 4...) porque el array empieza en el índice 0
$palabrasOpcionA = [];
$totalPalabras = count($palabras);
for ($i = 0; $i < $totalPalabras; $i += 2) {
    $palabrasOpcionA[] = $palabras[$i];
}
$fraseOpcionA = implode(" ", $palabrasOpcionA);

// Opción B: bucle foreach guardando solo las palabras distintas de "frío"
$palabrasOpcionB = [];
foreach ($palabras as $palabra) {
    if ($palabra !== "frío") {
        $palabrasOpcionB[] = $palabra;
    }
}
$fraseOpcionB = implode(" ", $palabrasOpcionB);

// Comparar si ambas frases resultantes son estrictamente iguales
$sonIguales = ($fraseOpcionA === $fraseOpcionB);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Trabajando con Strings - Parte 6</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            line-height: 1.6;
        }

        pre {
            background-color: #f4f4f4;
            padding: 12px;
            border-radius: 4px;
            overflow-x: auto;
        }

        .caja {
            background-color: #f9f9f9;
            padding: 10px 15px;
            border-left: 4px solid #0066cc;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Trabajando con Strings - Parte 6</h1>

    <h2>Frase original</h2>
    <div class="caja">
        <p><?php echo htmlspecialchars($fraseOriginal); ?></p>
    </div>

    <h2>Array de palabras (explode)</h2>
    <pre><?php print_r($palabras); ?></pre>

    <h2>Opción A (bucle for de 2 en 2)</h2>
    <div class="caja">
        <p><?php echo htmlspecialchars($fraseOpcionA); ?></p>
    </div>

    <h2>Opción B (bucle foreach filtrando "frío")</h2>
    <div class="caja">
        <p><?php echo htmlspecialchars($fraseOpcionB); ?></p>
    </div>

    <h2>Comparación de frases</h2>
    <div class="caja">
        <p>
            <?php if ($fraseOpcionA === $fraseOpcionB): ?>
                Las dos frases resultantes son exactamente iguales (===).
            <?php else: ?>
                Las dos frases resultantes son diferentes.
            <?php endif; ?>
        </p>
    </div>
</body>

</html>
