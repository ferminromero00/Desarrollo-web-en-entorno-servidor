<h1>RESPONDER</h1>
<section>
    <form>
        <textarea name="contenido" id="contenido" cols="40" rows="5" readonly><?php echo $contenido; ?></textarea> <br>
        <textarea name="respuesta" id="respuesta" cols="40" rows="10"></textarea> <br>
        <input type="hidden" name="fichero" value="<?php echo $_REQUEST["fichero"]; ?>">
        <input type="hidden" name="usuarioVisto" value="<?php echo $_GET["ver"]; ?>">
        <input type="submit" name="accionMuro" value="Aceptar">
        <input type="submit" name ="accionMuro" value="Cancelar">
    </form>
</section>