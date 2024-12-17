<?php
    $vista = "acceso.php";

    if(isset($_REQUEST["accion"])){
        $accion = strtolower(str_replace(" ","",$_REQUEST["accion"]));

        switch($accion){
            case "registrarme":
                // Capturamos los datos del formulario
                $_SESSION["nombre"] = $_REQUEST["nombre"];
                $_SESSION["password"] = $_REQUEST["password"];
    
                // Llamamos a la función para escribir el usuario
                escribirUsuario();
    
                // Opcional: Redirigir al acceso o mostrar mensaje de registro exitoso
                $vista = "acceso.php";
                break;
    
            case "acceder":
                $nombre = $_REQUEST["nombre"];
                $password = $_REQUEST["password"];
    
                // Llamamos a la función de acceso
                if (acceder($nombre, $password)) {
                    $_SESSION["nombre"] = $nombre; // Guardamos el usuario en sesión
                    $usuarios = leerUsuarios('usuarios'); // Llamar a la función leerUsuarios correctamente
                    $vista = "menu.php"; // Redirigimos al menú principal
                } else {
                    // Mostramos un mensaje de error en las credenciales
                    $vista = "acceso.php";
                    $error = "Credenciales incorrectas. Inténtalo de nuevo.";
                }
                break;
            case "cerrarsesion":
                session_unset();
                session_destroy();
                $vista ="acceso.php"; 
            break;
            case "verficheros":
                $vista= "verficheros.php";
            break;

            case"escribir":
                $vista = "escribir.php";
            break;
            case"guardarfichero":

                guardarRespuesta();               
                $vista = "escribir.php";
            break;
            case"guardarficheroyfinalizar":

                guardarRespuesta();  
                $nombre=$_SESSION["nombre"];    
                $usuarios = leerUsuarios('usuarios'); // Llamar a la función leerUsuarios correctamente
                $vista = "menu.php"; // Redirigimos al menú principal
            break;

            case"checkbox":
                $vista="checkbox.php";
            break;

            case "enviardatos":
                
// Solo se ejecuta si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos enviados por el formulario
    $sexo = $_POST['inputs']['radio'];
    $deportes = $_POST['inputs']['checkbox'] ?? [];
    $nombres = $_POST['inputs']['text'][0];
    $apellidos = $_POST['inputs']['text'][1];

    // Imprimir los valores recibidos
    echo "<h3>Información recibida:</h3>";
    echo "<p><strong>Sexo:</strong> $sexo</p>";
    echo "<p><strong>Deportes seleccionados:</strong> " . implode(", ", $deportes) . "</p>";
    echo "<p><strong>Nombre:</strong> $nombres</p>";
    echo "<p><strong>Apellidos:</strong> $apellidos</p>";
}


            break;


        }
    }
    




?>