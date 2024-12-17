<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3>Bienvenido <?php echo $_SESSION["usuario"]; ?> </h3>


    <table>
        <?php foreach ($miembros as $miembro): ?>
            <tr>
                <form>
                    <td><label><?php echo $miembro ?></label></td>
                    <td><input type="submit" value="Responder" name="accion" /></td>
                    <?php if ($miembro == $_SESSION["usuario"]): ?>
                        <td><input type="submit" value="Agregar Pregunta" name="accion" /></td>
                        <td><input type="submit" value="Ver mi Foro" name="accion" /></td>
                    <?php endif; ?>
                    <td><input type="hidden" name="miembro" value="<?php echo $miembro ?>" />
                </form>
            </tr>
        <?php endforeach; ?>
    </table>

    <form>
        <input type="submit" value="Cerrar sesion" name="accionusuario" />
    </form>
</body>

</html>