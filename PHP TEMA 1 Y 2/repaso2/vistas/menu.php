<?php
    $nombre = $_SESSION["nombre"];

?>


<h1><?php echo "hola ".$nombre ?></h1>
<table>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo htmlspecialchars($usuario); ?></td>
            <td></td>
                <form method="POST">
            <td><input type="submit" value="ver ficheros" name="accion"></td>
                <input type="hidden" name="nombre-fichero" value="<?php echo htmlspecialchars("$usuario")?>">
                </form>
            <?php if($usuario == "javier"){ ?>
                    <form method="POST">
                <td><input type="submit" value="eliminar usuarios" name="accion"></td>
                <td><a href="?accion">ver todos los ficheros</a></td>
                    </form>
            <?php } ?>
        </tr>
    <?php endforeach; ?>
</table>
    <form method="POST">
        <input type="submit" value="Cerrar sesion" name="accion">
        <input type="submit" value="checkbox" name="accion">
    </form>
