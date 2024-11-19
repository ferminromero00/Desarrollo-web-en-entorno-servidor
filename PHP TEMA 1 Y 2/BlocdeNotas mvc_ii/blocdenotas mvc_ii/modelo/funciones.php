<?php 

require 'vendor/autoload.php';

use Dompdf\Dompdf;

/* guarda en un fichero de nombre nombre_fichero el contenido 
que se le pasa como parámetro */
function guardar($nombre_fichero, $contenido) {
    
   
    $ok = file_put_contents($nombre_fichero, $contenido);
    return $ok;
}

function abrir($nombre_fichero) {

    if (file_exists($nombre_fichero)) {
        return file_get_contents($nombre_fichero);
    }else{
        return false;
    }
}

/* Función 'existe' que recibe el nombre de un usuario y devuelve:

a) La contraseña del usuario si éste existe

 b) NULL si el usuario no existe */

function existe($usuario) {

    // Partimos de la hipótesis de que el usuario no va a existir
    
    $ok = NULL;
    
    // Cargamos en un array asociativo el fichero de usuarios
    
    $usuarios = parse_ini_file("usuarios.ini");
    
    // Preguntamos si existe la clave $usuario dentro del array
    
    if (isset($usuarios[$usuario])) {
    
        // Si existe guardamos su contraseña para devolverla
        
        $ok = $usuarios[$usuario];
    
    }
    
    return $ok;
    
}
    
// Función 'acceder' que devuelve true si el usuario existe y coincide su contraseña o false en caso contrario
    
function acceder($usuario, $clave) {
    
    // Partimos de la hipótesis de que el usuario no existe
    
    $ok = false;
    
    // Llamamos a la función existe para recoger la contraseña del usuario si existe 
    
    // o NULL en caso contrario
    
    $clave_usuario = existe($usuario);
    
    // Si es distinto de NULL comparamos con la clave introducida en el formulario
    
    if ($clave_usuario != NULL && $clave_usuario == $clave) {
    
        // Si coinciden, devolveremos true como valor indicativo de acceso autorizado 
        
        $ok = true;
    
    }
    
    return $ok;
    
    }
    
// Función que graba un usuario y su clave en el fichero de usuarios

function grabar($usuario, $clave) {

    // Pensamos que algo puede fallar
    
    $ok = false;
    
    // Abrimos el fichero en modo de añadir "a+" Ver los diferentes modos de apertura: 
    // https://www.php.net/manual/es/function.fopen.php
    // Abrimos el fichero y obtenemos un descriptor de fichero a través del cual realizar las operaciones de lectura, escritura, cierre, etc
    
    $f = fopen("usuarios.ini", "a+");
    
    // si se ha podido abrir ....
    
    if ($f != NULL) {
    
        // Grabamos la línea
        
        $ok = fwrite($f, "$usuario=$clave".PHP_EOL); // ok tomará el valor false si no se ha podido grabar
        
        // Cerramos el fichero 
        
        fclose($f);
    
    }
    
    return $ok;
    
}
    
// Función 'registrar' que comprueba que el usuario no existe para después añadirlo 
// al fichero de usuarios y crear su directorio de trabajo
// Devuelve true si se ha podido registrar y false en caso contrario 
    
function registrar($usuario, $clave) {
    
    // Pensamos que no se va a poder registrar
    
    $ok = false;
    
    // Preguntamos si existe, nos devuelve NULL si el usuario no existe
    
    if (existe($usuario) == NULL) { // se podría expresar if (!existe($usuario)) { .....
    
        $ok = grabar($usuario, $clave);
        
        // Si se ha podido grabar 
        
        if ($ok != false) {
        
            // Creamos la carpeta con el nombre de usuario
            
            $ok = mkdir($usuario, 0777, true); // La carpeta se crea en el mismo directorio en el que se está ejecutando el script
            
            // Si todo ha ido bien $ok tendrá el valor true
        
        }
    
    }
    
    return $ok;
    
}

function imprimirPDF($fichero) {
    
    // Introducimos HTML de prueba
    $html = file_get_contents($_SESSION["usuario"].DIRECTORY_SEPARATOR.$fichero);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new Dompdf();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("A4", "portrait");
    
    // Cargamos el contenido HTML.
    $pdf->load_html(utf8_decode($html));
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream($fichero.".pdf");

}

function descargar($nombre_fichero) {


    header("Content-type: application/txt");
    header("Content-Disposition: attachment; filename=".$nombre_fichero);
    readfile($_SESSION["usuario"].DIRECTORY_SEPARATOR.$nombre_fichero);


}