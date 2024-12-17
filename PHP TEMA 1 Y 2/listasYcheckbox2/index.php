<?php
if (isset($_REQUEST["accion"])) {
    $numeros = $_REQUEST["nums"];
    echo "El número seleccionado es: " . $numeros . "<br>";
}

if (isset($_REQUEST["accion1"])) {
    if (isset($_REQUEST["check"])) {
        $numeros1 = $_REQUEST["check"];
        echo "Los números seleccionados son: ";
        print_r($numeros1);
        echo "<br>Total de números seleccionados: " . count($numeros1);
    } else {
        echo "No se seleccionaron números.";
    }
}

if (isset($_REQUEST["accion2"])) {
    if (isset($_REQUEST["campos"])) {
        $texto = array_filter($_REQUEST["campos"], fn($linea) => !empty($linea));

        if (count($texto) === count($_REQUEST["campos"])) {
            $f = fopen("fichero.txt", "w");
            if ($f !== false) {
                foreach ($texto as $linea) {
                    fwrite($f, $linea . PHP_EOL);
                }
                fclose($f);
            }

            echo "Contenido del array:";
            var_dump($texto);
        } else {
            echo "Error: Todos los campos deben estar completos.";
        }
    } else {
        echo "No se proporcionaron campos de texto.";
    }
}

if (isset($_REQUEST["leer_fichero"])) {
    if (file_exists("fichero.txt")) {
        $f = fopen("fichero.txt", "r");
        echo "<h3>Contenido del fichero:</h3>";
        while (($linea = fgets($f)) !== false) {
            echo htmlspecialchars($linea) . "<br>";
        }
        fclose($f);
    } else {
        echo "El fichero no existe.";
    }
}

if (isset($_REQUEST["eliminar_fichero"])) {
    if (file_exists("fichero.txt")) {
        unlink("fichero.txt");
        echo "Fichero eliminado correctamente.";
    } else {
        echo "El fichero no existe.";
    }
}

if (isset($_REQUEST["rango"])) {
    $inicio = $_REQUEST["inicio"];
    $fin = $_REQUEST["fin"];

    if (is_numeric($inicio) && is_numeric($fin) && $inicio <= $fin) {
        echo "<h3>Números en el rango de $inicio a $fin:</h3>";
        echo "<ol>";
        for ($i = $inicio; $i <= $fin; $i++) {
            echo "<li>$i</li>";
        }
        echo "</ol>";
    } else {
        echo "Error: Ingrese un rango válido (número inicial menor o igual al final).";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Tarea</title>
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        fieldset {
            margin-bottom: 20px;
            padding: 15px;
        }

        legend {
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <form action="#" method="GET">
        <fieldset>
            <legend>Seleccionar un número</legend>
            <select name="nums">
                <?php for ($i = 1; $i <= 100; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <input type="submit" value="Mostrar" name="accion">
        </fieldset>

        <fieldset>
            <legend>Seleccionar múltiples números</legend>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <input type="checkbox" name="check[]" value="<?php echo $i; ?>">
                <label for="<?php echo $i ?>"><?php echo $i ?></label>
            <?php endfor; ?>
            <br>
            <input type="submit" value="Mostrar" name="accion1">
        </fieldset>
    </form>

    <form action="#" method="GET">
        <fieldset>
            <legend>Ingresar campos de texto</legend>
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <label for="<?php echo $i ?>">Campo <?php echo $i ?></label>
                <input type="text" name="campos[]">
                <br>
            <?php endfor; ?>
            <br>
            <input type="submit" value="Escribir" name="accion2">
            <input type="submit" value="Leer fichero" name="leer_fichero">
            <input type="submit" value="Eliminar fichero" name="eliminar_fichero">
        </fieldset>
    </form>

    <form action="#" method="GET">
        <fieldset>
            <legend>Mostrar un rango de números</legend>
            <label for="inicio">Número inicial:</label>
            <input type="number" name="inicio" required>
            <br>
            <label for="fin">Número final:</label>
            <input type="number" name="fin" required>
            <br>
            <input type="submit" value="Mostrar rango" name="rango">
        </fieldset>
    </form>
</body>

</html>
