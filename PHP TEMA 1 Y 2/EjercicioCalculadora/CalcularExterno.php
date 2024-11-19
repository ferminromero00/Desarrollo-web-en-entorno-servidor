<?php

$resultado = "";
$operando1 = "";
$operando2 = "";

// Preguntamos si hemos recibido el formulario
if (isset($_REQUEST["accion"]) == true ) {
    $accion = $_REQUEST["accion"];
    $operando1 = $_REQUEST["operando1"];
    $operando2 = $_REQUEST["operando2"];
    switch ($accion) {
        case "+": $resultado = $operando1 + $operando2; break;
        case "-": $resultado = $operando1 - $operando2; break;
        case "*": $resultado = $operando1 * $operando2; break;
        case "/":   try {
                        $resultado = $operando1 / $operando2; 
                    }catch (DivisionByZeroError $e) {
                        $resultado = "División por cero ";
                    }       
                    break;
        default: $resultado = "Operación no permitida";
    }

    
}

?>