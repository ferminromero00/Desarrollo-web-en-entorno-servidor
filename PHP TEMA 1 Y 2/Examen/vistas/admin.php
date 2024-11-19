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
        <h3><?php echo "Hola $_SESSION[usuario]" ?></h3>
        <h3>Cuestionarios</h3>


        <?php $ficheros = mostrarFormularios(); ?>

        <?php foreach ($ficheros as $fichero): ?>
            <form>
                <p><?php echo "$fichero <input type='submit' value='Responder' name='accion'>
                    <input type='submit' value='Agregar_Preguntas' name='accion'/>
                    <input type='submit' value='Ver_todas_las_respuestas' name='accion'/>

            <input type='hidden' name='cuestionario' value='$fichero'/>" ?></p>
            </form>
        <?php endforeach; ?>






        <form>
            <input type="submit" value="Cerrar" name="accion" />
        </form>


    </div>
</body>

</html>