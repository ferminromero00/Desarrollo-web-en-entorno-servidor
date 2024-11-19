<?php
    // recogemos el id del mensaje solicitado
    $id = $_REQUEST["id"];

    // buscamos el mensaje en concreto con el Objeto usuario de la sesion y el metodo getMensaje pasandole el id recogido
    $mensaje = $_SESSION["usuario"]->getMensaje($id);
?>

<!-- Creamos  el elemento html que nos va a mostrar la informacion-->
<table class="table">
        <tr>
            <td>Remitente</td>
            <!-- Del mensaje recogido utilizamos sus metodos get para obtener los datos del mensaje -->
            <td><?php echo $mensaje->getRemitente() ?></td>
        </tr>
        <tr>
            <td>Asunto</td>
            <td><?php echo $mensaje->getAsunto() ?></td>
        </tr>
        <tr>
            <td>Cuerpo</td>
            <td><?php echo $mensaje->getCuerpo() ?></td>
    </tr>
</table>
