<h1>Mensajes de <?php echo $_SESSION["usuario"] ?> </h1>

<form>
    <input type="submit" name="accion" value="Recibidos" />
    <input type="submit" name="accion" value="Enviados" />
    <input type="submit" name="accion" value="Redactar" />
    <input type="submit" name="accion" value="Cerrar Sesion">
</form>

<br>


<?php if ($accion == "recibidos" || $accion == "enviados" || $_SESSION["seleccion"] == "Recibidos:" || $_SESSION["seleccion"] = "Enviados:") { ?>
    <h2> <?php echo $_SESSION["seleccion"] ?> </h2>

    <?php foreach ($seleccion as $a): ?>
        <form>
            <td><?php echo $a ?></td>
            <input type="submit" name="accion" value="Ver">
            <input type="hidden" name="seleccionTabla" value=" <?php echo $a ?> ">
        </form>
        <br>
    <?php endforeach; ?>
<?php } else if ($accion == "redactar") { ?>
        <form>
            <div>
                <label>Destinatario</label>
                <select name="destinatario">
                <?php foreach ($seleccion as $a): ?>
                        <option value="<?php echo $a ?>"><?php echo $a ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <br><br>
            <div>
                <label for="">Asunto</label>
                <input type="text" name="asunto">
            </div>
            <br><br>
            <div>
                <label>Contenido</label><br>
                <textarea name="contenido" rows="10" cols="80"></textarea>
            </div>

            <input type="submit" name="accion" value="Enviar mensaje" />
        </form>

<?php } else { ?>
    <?php echo $_SESSION["verResultado"] ?>
<?php } ?>


<br><br>

<form method="post">
</form>