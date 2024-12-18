<?php unset($_SESSION["alerta"]) ?>

<h3>Identificación y registro</h3>
<form>
    <label>Usuario</label>
    <input type="text" name="usuario"/>
    <label>Clave</label>
    <input type="password" name="clave"/>
    <div>
        <input type="submit" name="accion" value="Entrar"/>
        <input type="submit" name="accion" value="Registrarse"/>
    </div>
</form>

