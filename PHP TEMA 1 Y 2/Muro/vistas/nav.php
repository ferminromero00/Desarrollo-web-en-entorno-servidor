<aside>
    <h2>Lista de usuarios:</h2>
    <h3>Usuario actual: <?php echo $_SESSION["usuario"]; ?></h3>
    <form method="post">
        <input type="submit" name="accionUsuario" value="Cerrar Sesion" id="cierra">
    </form>
    <br><br>
    <?php
    $userRegisters = leer("usuarios"); ?>
    <ul>
        <?php
        foreach ($userRegisters as $registrado):
            if ($registrado != $_SESSION["usuario"]): ?>
                <li><a href="?ver=<?php echo $registrado; ?>"><?php echo $registrado; ?></a></li>
        <?php
            endif;
        endforeach;
        ?>
    </ul>
</aside>