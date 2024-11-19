    <?php
        // Bloque recogida de datos, comprobaciones, conexiones a db, inicializaciones, etc... Pero no se escribe nada
        // Debemos comprobar si los datos han sido enviados para evitar los errores
        $dni = "";
        $nombre = "";
        // Si hay datos
        if(isset($_REQUEST["accion"])) {
            //Recogemos los datos del formulario, recogemos las variables locales
            $nombre = $_REQUEST["nombre"];
            $dni = $_REQUEST["dni"];
        }else{
            // Si no hay datos sale el mensaje de bienvenida
            $mensaje = "Bienvenido a la pagina";
        }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <p><?php
        //bloque para mostrar datos si existen, si no el mensaje de bienvenida
        if(isset($mensaje)) {
            echo"".$mensaje."";
        }else{
            echo "Hola $nombre, tu dni es $dni";
        }
       
    ?></p>
    <br>
    <form action="#" method="GET">
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" required/>
        <label>DNI</label>
        <input type="text" name="dni" id="dni" required/>
        <input type="submit" value="Saludar" name="accion" id="accion"/>
    </form>
</body>
</html>