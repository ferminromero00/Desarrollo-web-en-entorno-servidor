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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>    
    <form action="">
        <div>
            <label for="operando1">Operando 1</label>
            <input type="text" 
                    id="operando1" 
                    name="operando1" 
                    placeholder="0"
                    value="<?php echo $operando1; ?>"/>
        </div>
        <div>
            <label for="operando2">Operando 2</label>
            <input type="text" 
                    id="operando2" 
                    name="operando2" 
                    placeholder="0"
                    value = "<?php echo $operando2; ?>" />
        </div>
        <div>            
            <input type="submit" value="+" name="accion"/>     
            <input type="submit" value="-" name="accion"/>     
            <input type="submit" value="*" name="accion"/>     
            <input type="submit" value="/" name="accion"/> 
            <!-- guarda el último resultado -->
            <input type="submit" value="M" name="accion"/> 
            <!-- recupera el último resultado guardado-->
            <input type="submit" value="R" name="accion"/> 
        </div>
        <div>
            <label for="resultado">Resultado</label>
            <input type="text" 
                    id="resultado" 
                    name="resultado"
                    value="<?php echo $resultado; ?>"/>
            <input type="hidden" name="memoria" value ="<?php echo $resultado ?>"/>
            
        </div>
    </form>
</body>
</html>