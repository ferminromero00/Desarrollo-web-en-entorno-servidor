<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificacion</title>
    <style>
        <?php include "style.css"; ?>
    </style>
</head>
<body>
    <form method="POST" action="index.php"> <!-- Usar POST para enviar datos -->
        <h1>IDENTIFICACION DE USUARIOS</h1>
        <?php if (!empty($mensaje)): ?>
            <h4><?php echo $mensaje; ?></h4>
        <?php endif; ?>

        <label>Usuario</label>
        <input type="text" name="usuario" /><br><br>

        <label>Clave</label>
        <input type="password" name="clave" /><br><br>
        <input type="submit" name="accion" value="Acceder" />
        <input type="submit" name="accion" value="Registrarme" />
    </form>
</body>
</html>
