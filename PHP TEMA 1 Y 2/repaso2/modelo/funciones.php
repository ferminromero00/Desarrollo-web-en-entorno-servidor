<?php
    function escribirUsuario(){
        $nombre = $_SESSION["nombre"];
        $password = $_SESSION["password"];

        $f = fopen("./"."usuarios/"."usuarios.ini", "a+");
                fwrite($f, "$nombre:$password" . PHP_EOL);
                fclose($f);
        $usuario = mkdir("./"."usuarios/".$nombre);
    }

    function acceder($nombre, $password) {
        $archivo = "./usuarios/usuarios.ini";
    
        $f = fopen($archivo, "r");
        if ($f) {
            // Leemos línea por línea
            while (($linea = fgets($f)) !== false) {
                $linea = trim($linea); // Eliminamos espacios en blanco y saltos de línea
    
                // Verificamos si la línea coincide con el formato "nombre:password"
                if ($linea === "$nombre:$password") {
                    fclose($f);
                    return true; // Credenciales correctas
                }
            }
            fclose($f);
        }
        return false; // Credenciales incorrectas
    }



    function leerUsuarios($ruta) {
        $arrUsuarios = []; // Inicializar un array vacío para almacenar usuarios
    
            $contenido = scandir($ruta); // Obtener los contenidos del directorio
    
            foreach ($contenido as $usuario) {
                // Filtrar los elementos '.' y '..'
                if ($usuario != ".." && $usuario != "." && $usuario != "usuarios.ini") {
                    // Añadir el nombre del usuario al array
                    $arrUsuarios[] = $usuario;
                }
            }
        
        
        return $arrUsuarios; // Retornar la lista de usuarios
    }

    function leerFicheros($ruta){
        $arrFicheros=[];

        $contenido = scandir($ruta);

        foreach($contenido as $fichero){
            if($fichero != ".." && $fichero != "."){
                $arrFicheros[] = $fichero;

            }
        }
        return $arrFicheros;
    }
    
    
    function guardarRespuesta(){
        $nombre = $_SESSION["nombre"];
                $nombreFichero = $_SESSION["nombre-fichero"];
                $asignatura = $_SESSION["asignatura"];
        
                $respuesta = $_REQUEST["respuesta"];
                $ruta = "usuarios/$nombreFichero/$asignatura";
        
                $formateoRespuesta = $nombre.":".$respuesta."\n";
        
                $abrirArchivo=fopen($ruta,"a+");
                fwrite($abrirArchivo,$formateoRespuesta);
                fclose($abrirArchivo); 


    }


?>