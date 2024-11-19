<?php
session_start();
$ficheros = $_SESSION["ficheros"]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <ul>
            <?php foreach ($ficheros as $fichero): ?>
                <?php if (!is_dir($fichero)): ?>
                    <li>
                        <a href="controladorBloc.php?accion=abrir&nombre_fichero=<?php echo $fichero; ?>">
                            <?php echo $fichero; ?>
                        </a>
                        <form action="controladorBloc.php">
                            <input type="hidden" name="nombre_fichero" value="<?php echo $fichero ?>" />
                            <input type="submit" name="accion" value="Abrir"/>
                        </form>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>