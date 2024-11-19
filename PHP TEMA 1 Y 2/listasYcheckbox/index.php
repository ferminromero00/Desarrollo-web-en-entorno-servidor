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
    } else {
        echo "No se seleccionaron números.";
    }
}

if (isset($_REQUEST["accion2"])) {
    if (isset($_REQUEST["campos"])) {
        $texto = $_REQUEST["campos"];

        $f = fopen("fichero.txt", "w");

        if ($f !== false) {
            foreach ($texto as $linea) {
                fwrite($f, $linea . PHP_EOL);
            }
            fclose($f);
        }

        echo "Contenido del array:";
        var_dump($texto);
        
        $f = fopen("fichero.txt", "r");

        if ($f) {
            while (!feof($f)) {
                fgets($f);
                echo $linea . "<br>";
            }
        }

    } else {
        echo "No se proporcionaron campos de texto.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucle</title>
</head>

<body style="background-color:grey;">
    <br><br>
    <form action="#" method="GET">
        <select name="nums">
            <?php for ($i = 1; $i <= 100; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <input type="submit" value="Mostrar" name="accion">

        <br><br><br>

        <?php for ($i = 1; $i <= 100; $i++): ?>
            <input type="checkbox" name="check[]" value="<?php echo $i; ?>">
            <label for="<?php echo $i ?>"><?php echo $i ?></label>
        <?php endfor; ?>

        <br><br>
        <input type="submit" value="Mostrar" name="accion1">
    </form>

    <br><br><br><br>

    <form action="#" method="GET">
        <?php for ($i = 1; $i <= 9; $i++): ?>
            <label for="<?php echo $i ?>">Campo <?php echo $i ?></label>
            <input type="text" name="campos[]">
            <br>
        <?php endfor; ?>

        <br><br>
        <input type="submit" value="Escribir" name="accion2">
    </form>
</body>

</html>