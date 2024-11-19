<h1>Mensajes Recibidos</h1>
<table class="table table-striped mt-3">
<thead>
    <th>Remitente</th>
    <th>Asunto</th>
    <th>Cuerpo</th>
</thead>
<tbody>
<?php 
    // recogemos los mensajes recibidos del usuario a traves de la sesión
    $mensajes = $_SESSION["usuario"]->getRecibidos();

    // recorremos los mensajes
    foreach ($mensajes as $mensaje) {
        ?>
        <!-- Creamos un elemento html con la informacion del mensaje -->
        <tr>
        <td><?php echo $mensaje->getRemitente() ?></td>
        <td><?php echo $mensaje->getAsunto() ?></td>
        <td>
            <form action="">
                <input type="submit" value="Ver" name="accion">
                <input type="hidden" name="id" value="<?php echo $mensaje->getId()?>"/>
                <input type="hidden" name="login" value="<?php echo $_SESSION["usuario"]->getLogin()?>"/>
            </form>
        </td>
        </tr>
        <?php
    }
?>
</tbody>
</table>