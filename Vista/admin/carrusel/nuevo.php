<?php
// Formulario de alta que comparte la cabecera y el pie del sitio.
require __DIR__ . '/../../../Vista/layouts/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5 mb-5">
            <!-- multipart/form-data permite enviar el archivo junto con los campos de texto. -->
            <form action="<?php echo urlsite ?>?page=carrusel&opcion=guardar" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <!-- Estos nombres de campo son leidos por CarruselController::guardar(). -->
                    <input type="text" required class="form-control" name="txtdescripcion" placeholder="Descripción">
                </div>
                <div class="form-group">
                    <input type="url" class="form-control" name="txtlink" placeholder="URL de la imagen">
                </div>
            
                <div class="form-group">
                    <input type="number" required class="form-control" name="txtorden" placeholder="Orden">
                </div>
                <div class="form-group">
                    <!-- El nombre urlfoto debe coincidir con la clave usada en $_FILES. -->
                    <input type="file" required class="form-control" name="urlfoto">
                </div>
                <input type="submit" value="Guardar" class="btn btn-primary btn-block" name="btnGuardar">
            </form>

            <p class="text-danger"><?php echo ((isset($_GET['msg']))) ? $_GET['msg'] : "" ?> </p>


        </div>
    </div>
</div>

<?php
// Cierra la plantilla HTML compartida.
require __DIR__ . '/../../../Vista/layouts/footer.php';
?>