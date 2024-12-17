<h1><?php echo "Bienvenido " . $_SESSION["usuario"] ?></h1>

<h2>Notas de tu directorio: "<?php echo $_SESSION["direct"] ?>"</h2>

<?php foreach ($seleccion as $nota): ?>
    <tr>
        <td>

            <form method="post">
                <?php echo $nota ?>
                <input type="submit" name="accion" value="Quitar">
                <input type="hidden" name="nota" value="<?php echo $nota ?>">
            </form>
        </td>
    </tr>
<?php endforeach; ?>

<form method="post">
    <input type="text" name="newNota">
    <input type="submit" name="accion" value="Nueva nota">

    <br><br>

    <input type="submit" name="accion" value="Volver">
    <input type="submit" name="accion" value="Cerrar">
</form>