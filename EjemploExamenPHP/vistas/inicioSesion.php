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
        <h4>
            <?php
            $msj = isset($_SESSION["msj"]) ? $_SESSION["msj"] : "";
            echo $msj;
            ?>
        </h4>

        <div>
            <form method="POST">
                <label>Introduce tu nombre</label>
                <input type="text" name="nombre" required />

                <br><br>

                <label>Introduce tu contraseña</label>
                <input type="password" name="pass" required />

                <br><br>

                <input type="submit" value="Acceder" name="accion" />
                <input type="submit" value="Registrar" name="accion" />
            </form>
        </div>
    </div>
</body>

</html>