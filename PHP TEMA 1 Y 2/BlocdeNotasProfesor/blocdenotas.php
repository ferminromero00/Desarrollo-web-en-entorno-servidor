<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
</head>
<body>
    <h4>
        <?php 
            if (isset($_SESSION["mensaje"])) {
                echo $_SESSION["mensaje"];
                unset($_SESSION["mensaje"]);
            } 
        ?>
    </h4>
    <form action="controladorUsuarios.php">
        <input type="submit" value="Cerrar sesión" name="accion"/>
    </form>
    <form action="controladorBloc.php">
        <div>
            <textarea rows="10" cols="120" name="contenido"><?php if (isset($_SESSION["contenido"])) echo $_SESSION["contenido"]; ?></textarea>
        </div>
        <label>Fichero</label>
        <input type="text" name="nombre_fichero" value="<?php if (isset($_SESSION["nombre_fichero"])) echo $_SESSION["nombre_fichero"]; ?>" />
        <input type="submit" value="Abrir" name="accion"/>
        <input type="submit" value="Guardar" name="accion"/>
        <input type="submit" value="Imprimir en pdf" name="accion"/>
        <input type="submit" value="Explorar" name="accion"/>
        <input type="submit" value="Copiar" name="accion"/>
        <input type="submit" value="Descargar" name="accion"/>
        <input type="submit" value="Subir fichero" name="accion"/>
        
    <form>
        
</body>
</html>