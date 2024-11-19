<h4>
    <?php
    $mensaje = $_SESSION["mensaje1"] ?? "";
    if ($mensaje) {
        echo $mensaje;
        unset($_SESSION["mensaje1"]);
    }
    ?>
</h4>

<div class="lateral">
    <h3 class="usuarios-barra">Social</h3>
    <ul class="usuarios-barra">
        <?php foreach ($usuarios as $nombreUsuario => $contraseña): ?>
            <li>
                <a href="index.php?usuario=<?php echo $nombreUsuario; ?>">
                    <?php echo $nombreUsuario; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php if ($usuario_muro == $usuario_sesion): ?>
    <form method="POST">
        <div>
            <textarea rows="10" cols="50" name="muro" placeholder="¿Qué quieres compartir?"></textarea>
        </div>
        <br>
        <input type="submit" value="Publicar" name="accionPag" />
    </form>
<?php endif; ?>

<h3>Publicaciones de <?php echo $usuario_muro; ?></h3>
<ul>
    <?php if (!empty($publicaciones)): ?>
        <?php foreach ($publicaciones as $publicacion): ?>
            <li>
                <strong><?php echo $publicacion['hora']; ?></strong> - <?php echo $publicacion['contenido']; ?>
            </li>

            <form method="POST" action="">
                <textarea name="respuesta" placeholder="Escribe tu comentario..."></textarea>
                <input type="hidden" name="ruta_publicacion" value="<?php echo $publicacion['ruta']; ?>">
                <input type="submit" value="Responder">
            </form>

            <?php if ($usuario_muro == $usuario_sesion): ?>
                <form method="POST" action="">
                    <input type="hidden" name="ruta_publicacion" value="<?php echo $publicacion['ruta']; ?>">
                    <input type="submit" value="Eliminar Publicación" name="eliminar_publicacion">
                </form>
            <?php endif; ?>

            <hr>

            <?php if (!empty($publicacion['respuestas'])): ?>
                <h4>Respuestas:</h4>
                <ul>
                    <?php foreach ($publicacion['respuestas'] as $respuesta): ?>
                        <li><?php echo $respuesta['contenido']; ?></li>
                    <?php endforeach; ?>
                </ul>
                <br><br><br><br><br><br><br><br><br>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No hay publicaciones disponibles.</li>
    <?php endif; ?>
</ul>
