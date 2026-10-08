<?php
// El controlador envia las filas encontradas; se usa la primera porque la busqueda es por ID.
$dato = $datos[0] ?? null;
if ($dato === null) {
    // Si el identificador no existe, vuelve al listado con un mensaje y no dibuja el formulario.
    header('Location: ' . urlsite . '?page=carrusel&msg=Registro%20no%20encontrado');
    exit;
}
require __DIR__ . '/../../../Vista/layouts/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5 mb-5">
            <!-- El formulario envia los cambios a la accion actualizar del controlador. -->
            <form action="<?php echo urlsite ?>?page=carrusel&opcion=actualizar" enctype="multipart/form-data" method="post">
                <!-- El ID no se muestra, pero identifica que registro debe actualizarse. -->
                <input type="hidden" name="txtid" value="<?php echo $dato->id; ?>">
                <div class="form-group">
                    <!-- htmlspecialchars codifica caracteres especiales antes de insertarlos en HTML. -->
                    <input type="text" required class="form-control" name="txtdescripcion" 
                    value="<?php echo htmlspecialchars($dato->descripcion); ?>">
                </div>
                <div class="form-group">
                    <input type="url" class="form-control" name="txtlink" 
                    value="<?php echo htmlspecialchars($dato->link); ?>">
                </div>
            
                <div class="form-group">
                    <input type="number" required class="form-control" name="txtorden" 
                    value="<?php echo $dato->orden; ?>" >
                </div>

                <div class="form-group">
                    <!-- La imagen actual se muestra; elegir un archivo nuevo es opcional. -->
                    <img src="<?php echo urlsite ?>Public/img/carrusel/<?php echo htmlspecialchars($dato->urlfoto); ?>" width="100px" height="100px">
                    <input type="file" class="form-control" name="urlfoto">
                </div>

                <input type="submit" value="Actualizar" class="btn btn-primary btn-block" name="btnActualizar">
            </form>

            <p class="text-danger"><?php echo ((isset($_GET['msg']))) ? $_GET['msg'] : "" ?> </p>


        </div>
    </div>
</div>

<?php
// Cierra la plantilla HTML compartida.
require __DIR__ . '/../../../Vista/layouts/footer.php';
?>