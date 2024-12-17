<h3>
    <?php echo "Estudiante:".$_SESSION["usuario"]; ?>    
</h3>
<h3>
    <?php echo "Foro de ".$_SESSION["miembro"]; ?>    
</h3>

<p>
    <?php echo $_SESSION["pregunta"] ?>
</p>

<form>
    <textarea name="respuesta" cols="60" rows="10"></textarea>
    <div>
        <input type="submit" name="accion" value="Guardar respuesta"/>
    </div>
</form>

<?php foreach ($respuestas as $contenido): ?>
    <p><?php echo $contenido ?></p>
<?php endforeach; ?>

<form>
    <input type="submit" name="accion" value="Volver a Preguntas">
</form>