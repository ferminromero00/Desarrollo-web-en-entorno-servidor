

<h2>Usuario activo: <?php echo $_SESSION["persona"] ?></h2>
<h1>Cuestionario de <?php echo $_SESSION["nameCuestionario"] ?></h1>

<br>

<h1> PREGUNTA: <?php echo $_SESSION["pregunta"] ?></h1>

<form method="post">
    <textarea name="respuesta" cols="90" rows="10"></textarea><br>
    <input type="submit" name="accion" value="Enviar Respuesta">
</form>