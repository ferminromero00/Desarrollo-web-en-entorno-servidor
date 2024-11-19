<?php

$usuario_sesion = $_SESSION["usuario"];
$usuario_muro = $_GET["usuario"] ?? $usuario_sesion;
$rutaPublicaciones = "usuarios/$usuario_muro/";

if (is_dir($rutaPublicaciones)) {
    $carpetas = glob($rutaPublicaciones . "*", GLOB_ONLYDIR);
    $publicaciones = [];

    foreach ($carpetas as $carpeta) {
        $archivos = glob($carpeta . "/*.txt");
        foreach ($archivos as $archivo) {
            $contenido = file_get_contents($archivo);

            // Extraer la hora de la publicación si está en el formato esperado
            $horaPublicacion = "";
            if (preg_match("/^\[(\d{2}:\d{2}:\d{2})\]\s*(.*)$/", $contenido, $matches)) {
                $horaPublicacion = $matches[1];
                $contenido = $matches[2]; // Obtener solo el contenido sin la hora
            }

            $publicaciones[] = [
                'contenido' => $contenido,
                'hora' => $horaPublicacion,
                'ruta' => $archivo,
                'respuestas' => []
            ];

            // Leer todas las respuestas correspondientes
            $respuestas_archivos = glob(str_replace('.txt', '_*.docx', $archivo));
            foreach ($respuestas_archivos as $respuesta_archivo) {
                $respuesta_contenido = file_get_contents($respuesta_archivo);
                $publicaciones[count($publicaciones) - 1]['respuestas'][] = [
                    'contenido' => $respuesta_contenido,
                    'ruta' => $respuesta_archivo
                ];
            }
        }
    }
}

$usuarios = parse_ini_file("usuarios/usuarios.ini");

?>
