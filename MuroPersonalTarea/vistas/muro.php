<?php

// Verifica si el usuario actual está intentando ver el muro de otro usuario
if (isset($_GET['usuario'])) {
    $usuarioVisto = $_GET['usuario'];
} else {
    $usuarioVisto = $_SESSION["usuario"];
}

// Aquí puedes agregar una validación para verificar si $usuarioVisto es un usuario válido

// HTML de bienvenida
echo "<h2>Bienvenido a la página de $usuarioVisto</h2>";

// Solo muestra el formulario de publicación si el usuario que está viendo es el mismo que el de la sesión
if ($usuarioVisto === $_SESSION["usuario"]) {
    echo '<form method="POST">
        <textarea name="contenido" rows="10" cols="40"></textarea>
        <input type="submit" value="Publicar" name="accionPagina">
    </form>';
}

// Obtener y mostrar publicaciones del usuario visto
$publicaciones = mostrarPublicaciones($usuarioVisto); // Obtener publicaciones del usuario visto

foreach ($publicaciones as $publicacion) {
    echo "<div class='publicacion'>";
    echo "<p><strong>{$publicacion['fecha']}</strong></p>";
    echo "<p>{$publicacion['contenido']}</p>";

    // Formulario para borrar la publicación solo si es el usuario propietario
    if ($usuarioVisto === $_SESSION["usuario"]) {
        echo "<form method='POST' style='display:inline;'>";
        echo "<input type='hidden' name='borrar_id' value='{$publicacion['id']}'>";
        echo "<input type='hidden' name='accionPagina' value='borrar'>";
        echo "<input type='submit' value='Borrar'>";
        echo "</form>";
    }

    // Mostrar comentarios
    if (file_exists($publicacion['rutaComentarios'])) {
        $comentarios = file($publicacion['rutaComentarios'], FILE_IGNORE_NEW_LINES);
        if ($comentarios) {
            echo "<h4>Comentarios:</h4>";
            foreach ($comentarios as $comentario) {
                // Simplemente imprimimos el comentario tal cual, ya incluye el nombre del usuario
                echo "<p>$comentario</p>";
            }
        }
    }

    // Formulario para agregar un nuevo comentario (disponible para todos los usuarios)
    echo "<form method='POST'>";
    echo "<textarea name='comentario' rows='2' cols='40' placeholder='Añade un comentario...'></textarea>";
    echo "<input type='hidden' name='comentario_id' value='{$publicacion['id']}'>";
    echo "<input type='hidden' name='usuario_visto' value='{$usuarioVisto}'>";
    echo "<input type='hidden' name='accionPagina' value='comentar'>";
    echo "<input type='submit' value='Comentar'>";
    echo "</form>";


    echo "</div><br>";
}

// Obtener y mostrar la lista de usuarios
$usuarios = obtenerUsuarios();
echo "<div style='position: absolute; top: 0;right: 0; margin-right: 50px'>";
echo "<h3>Usuarios</h3><ul>";
echo "<li><a href='index.php?usuario=$_SESSION[usuario]'>$_SESSION[usuario]</a></li>";

foreach ($usuarios as $usuario) {
    if ($usuario !== $_SESSION["usuario"]) {
        echo "<li><a href='index.php?usuario=$usuario'>$usuario</a></li>";
    }
}
echo "</ul></div>";

?>

<br><br>

<form method="POST">
    <input type="submit" value="Cerrar_Sesion" name="accion">
</form>