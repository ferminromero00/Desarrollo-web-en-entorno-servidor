<?php
if (isset($_REQUEST["accion"])) {
    $accion = $_REQUEST["accion"];

    switch ($accion) {
        case "Acceder":
            $_SESSION["usuario"] = $_REQUEST["nombre"];
            $usuario = $_SESSION["usuario"];

            if ($usuario !== "1234") {
                $vista = "vistas" . DIRECTORY_SEPARATOR . "cuestionarios.php";
                break;
            } else {
                $vista = "vistas" . DIRECTORY_SEPARATOR . "admin.php";
                break;
            }
        case "Responder":
            $_SESSION["nombreFichero"] = $_REQUEST["cuestionario"];

            $vista = "vistas" . DIRECTORY_SEPARATOR . "preguntasCuestionario.php";
            break;
        case "Agregar_Preguntas":
            $vista = "vistas" . DIRECTORY_SEPARATOR . "agregarpreguntas.php";
            break;
        case "Crear_pregunta_y_continuar":
            $contenido = $_REQUEST["pregunta"];


            $vista = "vistas" . DIRECTORY_SEPARATOR . "agregarpreguntas.php";
            break;
        case "Crear_pregunta_y_finalizar":
         


            $vista = "vistas" . DIRECTORY_SEPARATOR . "admin.php";
            break;



        case "Ver_todas_las_respuestas":
            
            $vista = "vistas" . DIRECTORY_SEPARATOR . "verRespuestas.php";
            break;
        case "Cerrar":
            session_unset();
            session_destroy();
            $vista = "vistas" . DIRECTORY_SEPARATOR . "iniciosesion.php";
    }
}


















?>