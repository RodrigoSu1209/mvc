<?php
// Pantalla inicial del area administrativa; reutiliza cabecera y pie comunes.
require __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <!-- El enlace solicita la accion logout para cerrar la sesion actual. -->
    <a href="<?php echo urlsite ?>?page=logout">Cerrar Sesion</a>
</div>

<?php
// Incluye el cierre del documento HTML.
require __DIR__ . '/../layouts/footer.php';
?>
