<?php
// Con session_start() intentamos recuperar la sesión, y si no existe la crea
session_start();

// Si NO (!) existe la variable de sesión  'carrito'
if (!isset($_SESSION["carrito"])) {
    // La creamos como un array vacio
    $_SESSION["carrito"] = array();
}

// Preguntamos si hemos recibido el formulario
if (isset($_REQUEST["accion"])) {
    // Recojo el valor del botón que hemos pulsado
    $accion = $_REQUEST["accion"];
    // Pamasos el valor a minúscula y le quitamos los espacios
    $accion = strtolower($accion);
    // Reemplazamos los espacios por cadena vacía en la cadena $accion
    $accion = str_replace(" ", "", $accion);
    switch ($accion) {
        case "guardar": // Recogemos el valor del campo de texto
            $valor = $_REQUEST["valor"];
            // y lo añadimos al array carrito
            array_push($_SESSION["carrito"], $valor);
            break;
        case "mostrarcarrito":  // Activamos una variable interruptor 'mostrar' 
            // Para preguntar por ella y mostrar el contenido
            $mostrar = true;
            break;

    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>

<body>
    <form>
        <input type="text" name="valor" id="">
        <input type="submit" value="Guardar" name="accion">
        <input type="submit" value="Mostrar carrito" name="accion">
    </form>

    <!-- Preguntamos si hemos activado la variable interruptor para mostrar los resultados -->
    <?php if (isset($mostrar) && $mostrar == true): ?>
        <h3>Contenido del carrito</h3>
        <ul>
            <!-- Recorremo el array, cogiendo cada uno de los elementos -->
            <?php foreach ($_SESSION["carrito"] as $elemento): ?>
                <!-- y los mostramos -->
                <li>
                    <p><?php echo $elemento ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>