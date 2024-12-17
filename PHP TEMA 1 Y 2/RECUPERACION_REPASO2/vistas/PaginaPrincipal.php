

<h1><?php echo "Bienvenido " . $_SESSION["usuario"] ?></>

<h2>Tus notas:</h2>

<?php foreach ($lecturaDirectorios as $directorio): ?>
    <form method="post">
        <td><?php echo $directorio ?></td>
        <input type="submit" name="accion" value="Ver">
        <input type="submit" name="accion" value="Borrar">
        <input type="hidden" name="directorio" value="<?php echo $directorio ?>">
    </form>
<?php endforeach; ?>


<form method="post">
    <input type="text" name="newQuest">
    <input type="submit" name="accion" value="Crear directorio">

    <br><br>

    <input type="submit" name="accion" value="Cerrar">
</form>