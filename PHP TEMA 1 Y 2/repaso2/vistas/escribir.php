<?php
// Asegúrate de usar POST para obtener la variable

if (isset($_POST["asignatura"])) {
    $_SESSION["asignatura"] = $_POST["asignatura"];
}
$asignatura = isset($_SESSION["asignatura"]) ? $_SESSION["asignatura"] : null;

if (!$asignatura) {
    echo "No se ha recibido la asignatura. Por favor, vuelve atrás.";
    exit;
}




?>

<h1><?php echo "Fichero de ". $asignatura; ?></h1>
<form method="POST">
    <table>
        <tr>
            <td><textarea name="respuesta" id="respuesta" rows="10" cols="40"></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" value="Guardar fichero" name="accion"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Guardar fichero y finalizar" name="accion"></td>
        </tr>
    </table>
</form>
