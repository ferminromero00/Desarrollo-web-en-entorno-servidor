<form>
    <input type="submit" value="volver"/>
</form>
<ul>
    <?php foreach ($ficheros as $fichero): ?>
        <?php if (!is_dir($fichero)): ?>
            <li>
                <a href="?accionbloc=abrir&nombre_fichero=<?php echo $fichero; ?>">
                    <?php echo $fichero; ?>
                </a>
                <form action="">
                    <input type="hidden" name="nombre_fichero" value="<?php echo $fichero ?>" />
                    <input type="submit" name="accionbloc" value="Abrir"/>
                    <input type="submit" name="accionbloc" value="Eliminar"/>
                </form>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
