<?php require "./vistas/nav.php"; ?>
<section>
    <?php if ($usuarioVisto == $_SESSION["usuario"]): ?>
        <form method="post">
            <textarea name="publicacion" id="publicacion" cols="50" rows="5" placeholder="¿En qué estas pensando? ..."></textarea> <br><br>
            <input type="submit" name="accionMuro" value="Publicar">
        </form>
    <?php endif; ?>
    <?php
    $ficheros = leer("usuarios" . DIRECTORY_SEPARATOR . $usuarioVisto);
    arsort($ficheros);
    foreach ($ficheros as $fichero):
        $contenido = file_get_contents("usuarios" . DIRECTORY_SEPARATOR . $usuarioVisto . DIRECTORY_SEPARATOR . $fichero);
        $segundos = (int) substr($fichero, 0, -4);
        $fechaFormat = date('d-m-Y', $segundos);
        ?>
        <section class="publicacion">
            <h3>Publicación:</h3>
            <pre><?php echo $contenido; ?></pre>
            <br>
            <h5>Creado por: <?php echo $usuarioVisto; ?></h5>
            <h6>
                El día: <?php echo $fechaFormat; ?>
            </h6>
            <br>
            <form method="post">
                <input type="submit" name="accionMuro" value="Responder">
                <input type="hidden" name="fichero" value="<?php echo $fichero; ?>">
                <?php if ($usuarioVisto == $_SESSION["usuario"]): ?>
                    <input type="submit" name="accionMuro" value="Eliminar">
                <?php endif; ?>
            </form>
        </section>
    <?php endforeach; ?>
    <?php if ($usuarioVisto != $_SESSION["usuario"]): ?>
        <a href="?ver=<?php echo $_SESSION["usuario"]; ?>">Volver a mis publicaciones</a>
    <?php endif; ?>
</section>