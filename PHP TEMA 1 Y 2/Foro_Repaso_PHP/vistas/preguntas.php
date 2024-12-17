

<h3>Foro de: <?php echo $_SESSION["miembro"]; ?></h3>

<table>
    <?php foreach ($preguntas as $pregunta): ?>
        <tr>
            <td><label><?php echo $pregunta ?></label></td>
            <td><a href="?accion=contestarpregunta&pregunta=<?php echo $pregunta;?>">
                Contestar
            </a></td>
        </tr>
    <?php endforeach; ?>
</table>
<form>
    <input type="submit" value="Volver al Foro" name="accion"/>
</form>