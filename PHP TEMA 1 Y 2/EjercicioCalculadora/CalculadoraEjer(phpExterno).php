<?php require("CalcularExterno.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>    
    <form>
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
        </div>
        <div>
            <label for="resultado">Resultado</label>
            <input type="text" 
                    id="resultado" 
                    name="resultado"
                    value="<?php echo $resultado; ?>"/>
        </div>
    </form>
</body>
</html>