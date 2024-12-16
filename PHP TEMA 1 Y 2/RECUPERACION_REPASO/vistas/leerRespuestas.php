<?php unset($_SESSION["msj"]) ?>
<h2>Usuario activo: <?php echo $_SESSION["persona"] ?> </h2>
<h1>Cuestionario de <?php echo $_SESSION["nameCuestionario"] ?> </h1>

<table>
    <?php foreach ($seleccion as $a): ?>
        <tr>
            <td><?php echo $a ?></td>
            <td>
                <form method="post">
                    <input type="submit" name="accion" value="Ver Respuestas">
                    <input type="hidden" name="nombrepregunta" value="<?php echo $a ?>">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<form method="post">
    <input type="submit" name="accion" value="Cerrar">
</form>