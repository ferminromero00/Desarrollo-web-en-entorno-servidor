<?php 

// Si se ha pulsado el botón 'acciónusuarios' recojo los campos 
if (isset($_REQUEST["accionusuarios"])) {
    // Convetimos a minúscula y eliminamos los espacios
    $accion = str_replace(" ","", strtolower($_REQUEST["accionusuarios"]));
    
    switch ($accion) {
        case "acceder":
            // Preguntamos si existe el usuario con esa clave en el fichero de usuarios
            $ok = acceder($_REQUEST["usuario"], $_REQUEST["clave"]);
            if ($ok == true) {
                // Creamos la variable de sesión 'usurio y guardamos el nombre de usuario y creamos 
                $_SESSION["usuario"] = $_REQUEST["usuario"];
                // Redirigimos hacia el bloc de notas
                $vista = "blocdenotas.php";
            }else{
                $mensaje = "Usuario incorrecto";
                $vista = "identificacion.php";
            }   
            break;
        case "registrarme":
            $ok = registrar($_REQUEST["usuario"],  $_REQUEST["clave"]);
            if ($ok) {
                $mensaje = "Usuario registrado";
            }else{
                $mensaje = "Error: el usuario no se ha podido registrar";
            }
            $vista = "identificacion.php";
            break;
        

        case "cerrarsesión": // Elimino las variables de sesión
            session_unset();
            // Destruyo la sesión
            session_destroy();
            // Y nos redirigimos a la página de login
            $vista = "identificacion.php";
            break;
    }  
}      

?>