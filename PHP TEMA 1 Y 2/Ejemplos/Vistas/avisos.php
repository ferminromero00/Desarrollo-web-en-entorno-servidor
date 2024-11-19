<?php if (isset($aviso)): ?>
    <div class="mt-3 alert <?php echo $tipo;?> alert-dismissible fade show" role="alert">
        <?php echo $aviso; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>