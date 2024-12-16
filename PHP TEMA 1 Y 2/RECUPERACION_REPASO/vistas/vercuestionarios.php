<?php unset($_SESSION["msj"]) ?>

<h1>Bienvenido <?php echo $_SESSION["persona"] ?> </h1>

<?php if (isset($_SESSION["persona"])): ?>
    <table>
        <?php foreach ($cuestionarios as $cuestion): ?>
            <tr>
                <td><?php echo $cuestion ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="accion" value="Responder">
                        <?php if ($_SESSION["persona"] == "1234"): ?>
                            <input type="submit" name="accion" value="Agregar Pregunta">
                            <input type="submit" name="accion" value="Ver todas las Respuestas">
                        <?php endif; ?>
                        <input type="hidden" name="cuestionario" value="<?php echo $cuestion ?>">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>



<form method="post">
    <input type="submit" name="accion" value="Cerrar">
</form>