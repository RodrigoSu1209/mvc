<?php
require __DIR__ . '/../../../Vista/layouts/header.php';
// Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\layouts\header.php
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5 mb-5">
            <form action="<?php echo urlsite ?>?page=carrusel&opcion=guardar" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <input type="text" required class="form-control" name="txtdescripcion" placeholder="Descripción">
                </div>
                <div class="form-group">
                    <input type="url" class="form-control" name="txtlink" placeholder="URL de la imagen">
                </div>
            
                <div class="form-group">
                    <input type="number" required class="form-control" name="txtorden" placeholder="Orden">
                </div>
                <div class="form-group">
                    <input type="file" required class="form-control" name="urlfoto">
                </div>
                <input type="submit" value="Guardar" class="btn btn-primary btn-block" name="btnGuardar">
            </form>

            <p class="text-danger"><?php echo ((isset($_GET['msg']))) ? $_GET['msg'] : "" ?> </p>


        </div>
    </div>
</div>

<?php
require __DIR__ . '/../../../Vista/layouts/footer.php';
// Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\layouts\footer.php
?>