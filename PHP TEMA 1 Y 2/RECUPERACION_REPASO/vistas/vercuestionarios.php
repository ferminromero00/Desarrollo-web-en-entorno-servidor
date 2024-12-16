<h1>Bienvenido <?php echo $_SESSION["persona"] ?> </h1>

<?php if ($_SESSION["persona"] == "1234") { ?>
    <table>
        <?php foreach ($cuestionarios as $cuestion): ?>
            <tr>
                <td><?php echo $cuestion ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="accion" value="Responder">
                        <input type="submit" name="accion" value="Agregar Pregunta">
                        <input type="submit" name="accion" value="Ver todas las Respuestas">
                        <input type="hidden" name="cuestionario" value="<?php echo $cuestion ?>">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php } else { ?>
    <table>
        <?php foreach ($cuestionarios as $cuestion): ?>
            <tr>
                <td><?php echo $cuestion ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="accion" value="Responder">
                        <input type="hidden" name="cuestionario" value="<?php echo $cuestion ?>">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php } ?>



<form method="post">
    <input type="submit" name="accion" value="Cerrar">
</form>