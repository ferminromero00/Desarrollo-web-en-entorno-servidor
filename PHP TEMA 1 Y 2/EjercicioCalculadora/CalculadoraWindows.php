<?php
$numero = isset($_REQUEST["memoria_num1"]) ? $_REQUEST["memoria_num1"] : ""; // Recuperar valor previo de num1
$numero2 = isset($_REQUEST["memoria_num2"]) ? $_REQUEST["memoria_num2"] : ""; // Recuperar valor previo de num2
$resultado = "";

// Concatenar números para Operando 1
if (isset($_REQUEST["boton1"])) {
    $numero = $_REQUEST["num1"] . $_REQUEST["boton1"]; // Concatenar número actual con el botón presionado
}

// Concatenar números para Operando 2
if (isset($_REQUEST["boton2"])) {
    $numero2 = $_REQUEST["num2"] . $_REQUEST["boton2"]; // Concatenar número actual con el botón presionado
}

// Si se presiona un botón de operación
if (isset($_REQUEST["accion"])) {
    $accion = $_REQUEST["accion"];
    $operando1 = $_REQUEST["num1"]; // Aseguramos que sean valores numéricos
    $operando2 = $_REQUEST["num2"];

    switch ($accion) {
        case "+":
            $resultado = $operando1 + $operando2;
            break;
        case "-":
            $resultado = $operando1 - $operando2;
            break;
        case "*":
            $resultado = $operando1 * $operando2;
            break;
        case "/":
            if ($operando2 != 0) {
                $resultado = $operando1 / $operando2;
            } else {
                $resultado = "Error: División por cero";
            }
            break;
        default:
            $resultado = "Operación no permitida";
    }
}

// Resetear los números
if (isset($_REQUEST["reset"])) {
    $numero = "";
    $numero2 = "";
    $resultado = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Windows</title>
</head>

<body>

    <form action="#" align="center" method="POST">
        <!-- Operando 1 -->
        <label>Operando 1</label>
        <input type="text" name="num1" id="num1" value="<?php echo $numero ?>" placeholder="Introduce un número">
        <br><br>
        <!-- Botones numéricos para Operando 1 -->
        <input type="submit" value="1" name="boton1">
        <input type="submit" value="2" name="boton1">
        <input type="submit" value="3" name="boton1">
        <input type="submit" value="4" name="boton1">
        <input type="submit" value="5" name="boton1">
        <input type="submit" value="6" name="boton1">
        <input type="submit" value="7" name="boton1">
        <input type="submit" value="8" name="boton1">
        <input type="submit" value="9" name="boton1">
        <input type="submit" value="0" name="boton1">
        <br><br>

        <!-- Operando 2 -->
        <label>Operando 2</label>
        <input type="text" name="num2" id="num2" value="<?php echo $numero2 ?>" placeholder="Introduce un número">
        <br><br>
        <!-- Botones numéricos para Operando 2 -->
        <input type="submit" value="1" name="boton2">
        <input type="submit" value="2" name="boton2">
        <input type="submit" value="3" name="boton2">
        <input type="submit" value="4" name="boton2">
        <input type="submit" value="5" name="boton2">
        <input type="submit" value="6" name="boton2">
        <input type="submit" value="7" name="boton2">
        <input type="submit" value="8" name="boton2">
        <input type="submit" value="9" name="boton2">
        <input type="submit" value="0" name="boton2">
        <br><br>

        <!-- Operaciones -->
        <input type="submit" value="+" name="accion">
        <input type="submit" value="-" name="accion">
        <input type="submit" value="*" name="accion">
        <input type="submit" value="/" name="accion">
        <br><br>

        <!-- Mostrar Resultado -->
        <label>Resultado</label>
        <input type="text" value="<?php echo $resultado; ?>" readonly>
        <br><br>
        <!-- Botón de Reset -->
        <input type="submit" value="Resetear" name="reset">
        <br><br>


        <!-- Campos ocultos para mantener valores -->
        <input type="hidden" name="memoria_num1" value="<?php echo $numero; ?>">
        <input type="hidden" name="memoria_num2" value="<?php echo $numero2; ?>">

    </form>

</body>

</html>