<?php
        //? Recuperamos o creamos la sesión
        session_start(); // Inicia la sesión para poder acceder a variables de sesión

        //? Establecemos una variable con el directorio de las vistas
        $ruta = "vistas" . DIRECTORY_SEPARATOR; // Define la ruta donde se encuentran las vistas, usando el separador de directorios adecuado

        if (isset($_SESSION["usuario"])) { // Verifica si hay un usuario activo en la sesión
            $usuarioActivo = isset($_GET['ver']) ? $_GET['ver'] : $_SESSION["usuario"]; // Si hay un parámetro 'ver' en la URL, lo usa; de lo contrario, usa el usuario de la sesión
            $vista = "foro.php"; // Si hay un usuario activo, establece la vista a mostrar como 'publicaciones.php'
        } else {
            $vista = "identificacion.php"; // Si no hay usuario activo, establece la vista a mostrar como 'identificacion.php'
        }

        //? Incluimos los controladores y las funciones
        require("modelo" . DIRECTORY_SEPARATOR . "funciones.php"); // Incluye funciones generales del modelo
        require("controlador" . DIRECTORY_SEPARATOR . "controladorForo.php"); // Incluye el controlador para las publicaciones
        require("controlador" . DIRECTORY_SEPARATOR . "controladorUsuarios.php");
        ?>

        <html lang="es">
            <head>
                <meta charset="UTF-8"> <!-- Establece la codificación de caracteres a UTF-8 -->
                <title>Cuestionario</title> <!-- Título de la página -->
            </head>
            <body>
            
                <!-- include porque no es tan grave no incluir un mensaje -->
                <?php include("vistas/mensajes.php")?> <!-- Incluye el archivo de mensajes (notificaciones o alertas), puede no ser crítico -->
                
                <!-- Incluimos el contenido -->
                <?php include("vistas/$vista") ?> <!-- Incluye la vista correspondiente (publicaciones o identificación) -->
                
            </body>
        </html>