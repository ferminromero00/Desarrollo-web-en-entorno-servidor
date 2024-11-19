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
        <?php $respuestas = respuestas() ?>

        <?php foreach ($respuestas as $r): ?>
            <form>
                <p><?php echo "$r" ?></p>
            </form>
        <?php endforeach; ?>

    </div>
</body>

</html>