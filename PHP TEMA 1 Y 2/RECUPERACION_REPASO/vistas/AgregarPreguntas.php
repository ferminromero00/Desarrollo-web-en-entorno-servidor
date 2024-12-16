<?php unset($_SESSION["msj"]) ?>
<h2>Usuario activo: <?php echo $_SESSION["persona"] ?> </h2>
<h1>Cuestionario de <?php echo $_SESSION["nameCuestionario"] ?> </h1>

<form method="post">
    <label for="nuevapregunta">Nueva pregunta</label>
    <input type="text" name="nuevapregunta">
    <input type="submit" name="accion" value="Agregar">
</form>


<form method="post">
    <input type="submit" name="accion" value="Cerrar">
</form>