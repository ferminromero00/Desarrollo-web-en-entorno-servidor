<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionarios</title>
    <style type="text/css">
        div,
        form,
        table {
            margin-top: 10px;
        }

        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div>
        <h4></h4>
        <h3><?php echo "Estudiante: $_SESSION[usuario]" ?></h3>
        <h3>Cuestionario de <?php echo $_SESSION["nombreFichero"] ?> </h3>

        <?php $respuestas = respuestas() ?>

        <?php foreach ($respuestas as $r): ?>
            <form>
                <p><?php echo "$r <a href=''>Contestar</a>" 
 ?></p>
            </form>
        <?php endforeach; ?>



        <form>
            <input type="submit" value="Cerrar" name="accion" />
        </form>

    </div>
</body>

</html>