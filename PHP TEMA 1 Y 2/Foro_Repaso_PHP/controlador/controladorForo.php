<?php

if (isset($_REQUEST["accion"])) {
    // Limpiamos la acción recibida: convertimos a minúsculas y eliminamos espacios
    $accion = str_replace(" ", "", strtolower($_REQUEST["accion"]));

    // Evaluamos la acción usando un switch
    switch ($accion){

        case "responder":
            $_SESSION["miembro"] = $_REQUEST["miembro"];
            $preguntas = leerPreguntas($_SESSION["miembro"]);
            // var_dump($preguntas);
            $vista = "preguntas.php";
            break;
        
        case "contestarpregunta": 
            $_SESSION["pregunta"] = $_REQUEST["pregunta"];
            $pregunta = $_REQUEST["pregunta"];
            $miembro = $_SESSION["miembro"];
            $respuestas = leerRespuestas("usuarios/$miembro/$pregunta");
            $vista = "contestarpregunta.php";
            break;
        
            case "guardarrespuesta":
                $ok = guardarRespuesta(
                    $_SESSION["miembro"],
                    $_SESSION["pregunta"],
                    $_SESSION["usuario"],
                    $_REQUEST["respuesta"]
                );
                if ($ok) {
                    $mensaje = "Respuesta guardada";
                    $preguntas = leerPreguntas($_SESSION["miembro"]);
                } else {
                    $mensaje = "¡¡ Error : no se ha podido guardar la respuesta !!";
                }
                
                $vista = "preguntas.php";
                break; 
            
            case "volverapreguntas": 
                $vista="preguntas.php"; 
                $preguntas = leerPreguntas($_SESSION["miembro"]);
                break; 
            case "volveralforo":
                $miembros=leerUsuarios(); 
                $vista="foro.php"; 
                break; 


            case "agregarpregunta": 
                $_SESSION["miembro"]=$_REQUEST["miembro"];
                $vista="agregarpregunta.php"; 
                break; 

            case "agregarpreguntaypermanecer":
                $miembro=$_SESSION["miembro"]; 
                $pregunta=$_REQUEST["pregunta"]; 
                $ok=crearPregunta($miembro,$pregunta); 

                if($ok){
                    $mensaje="Se ha creado la pregunta correctamente"; 
                }else{
                    $mensaje="ERROR: No se ha podido crear la pregunta"; 
                }
                $vista="agregarpregunta.php"; 
                break; 

            case "agregarpreguntayvolver":
                $miembro=$_SESSION["miembro"]; 
                $pregunta=$_REQUEST["pregunta"]; 
                $ok=crearPregunta($miembro,$pregunta); 

                if($ok){
                    $mensaje="Se ha creado la pregunta correctamente"; 
                }else{
                    $mensaje="ERROR: No se ha podido crear la pregunta"; 
                }
                $miembros=leerUsuarios();
                $vista="foro.php"; 
                break; 

            case "vermiforo": 
                $miembro = $_REQUEST["miembro"];
                $preguntas = leerPreguntas($miembro);
                $respuestas = [];
                foreach ($preguntas as $pregunta) {
                    $respuestas[$pregunta] = leerRespuestas("usuarios/$miembro/$pregunta");
                }
                //var_dump($respuestas);
                $vista = "vermiforo.php";
                break;




        
                
            
    }
            
}
?>