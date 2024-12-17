<?php
    $_SESSION["nombre-fichero"] = $_REQUEST["nombre-fichero"];
    $nombreFichero = $_SESSION["nombre-fichero"];
    $ficheros = leerFicheros('usuarios/'.$nombreFichero);
?>
<h1><?php echo "Ficheros de ". $nombreFichero ?></h1>
<table>
    <?php foreach ($ficheros as $fichero): ?>
        <tr>
            <form method="POST">
                <td><?php echo $fichero ?></td>
                <input type="hidden" name="asignatura" value="<?php echo htmlspecialchars($fichero); ?>">
                
                <td><input type="submit" value="Escribir" name="accion"></td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>
