<?php
// El listado reutiliza los elementos visuales comunes de la aplicacion.
require __DIR__ . '/../../../Vista/layouts/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 border">
           
        <!-- Abre el formulario que crea un elemento nuevo del carrusel. -->
        <a href="<?php echo urlsite ?>?page=carrusel&opcion=nuevo">Nuevo registro</a>
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>s

                <tbody>
                    <!-- Si el controlador no entrego filas, se recorre una lista vacia. -->
                    <?php $datos = isset($datos) ? $datos : []; ?>
                    <?php foreach ($datos as $v): ?>
                        <tr>
                            <!-- Los campos se imprimen desde la fila devuelta por el modelo. -->
                            <td><?php echo $v->orden; ?></td>
                            <td><?php echo $v->descripcion; ?></td>
                            <td>
                                <a href="<?php echo urlsite ?>?page=carrusel&opcion=editar&id=<?php echo $v->id; ?>">Editar</a>
                                <a href="<?php echo urlsite ?>?page=carrusel&opcion=eliminar&id=<?php echo $v->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
 
            </table>
        </div>
    </div>
</div>



<?php
// Incluye el cierre comun del documento HTML.
require __DIR__ . '/../../../Vista/layouts/footer.php';
?>