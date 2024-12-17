<?php foreach ($respuestas as $clave => $valor): ?>
    <h3><?php echo $clave ?></h3>
    <?php foreach ($valor as $res): ?>
        <p><?php echo $res ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>