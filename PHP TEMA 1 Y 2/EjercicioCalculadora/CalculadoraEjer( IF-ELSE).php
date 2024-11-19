<?php 
    $resultado = "";

    if (isset($_REQUEST["suma"])) {
        $num1 = $_REQUEST["num1"];
        $num2 = $_REQUEST["num2"];
        $resultado = $num1 + $num2; 
    }else if (isset($_REQUEST["resta"])) {
        $num1 = $_REQUEST["num1"];
        $num2 = $_REQUEST["num2"];
        $resultado = $num1 - $num2; 
    } else if (isset($_REQUEST["multiplicacion"])) {
        $num1 = $_REQUEST["num1"];
        $num2 = $_REQUEST["num2"];
        $resultado = $num1 * $num2; 
    } else if (isset($_REQUEST["dividir"])) {
        $num1 = $_REQUEST["num1"];
        $num2 = $_REQUEST["num2"];

        try {
            $resultado = $num1 / $num2;
        }catch (DivisionByZeroError $e) {
            $resultado = "Division por cero"; 
        };
        
    };
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form action="#" align="center" method="POST">
        <label>Operando 1</label>
        <input type="number" name="num1" id="num1" value="<?php echo $num1 ?>" placeholder="Introduce un numero">
        <br><br>
        <label>Operando 2</label>
        <input type="number" name="num2" id="num2" value="<?php echo $num2 ?>" placeholder="Introduce un numero">
        <br><br>
        <input type="submit" value="+" name="suma">
        <input type="submit" value="-" name="resta">
        <input type="submit" value="x" name="multiplicacion">
        <input type="submit" value="/" name="dividir">
        <br><br>
        <label>Resultado</label>
        <?php echo "<input type='number' value='$resultado'>";?>
    </form>
</body>
</html>