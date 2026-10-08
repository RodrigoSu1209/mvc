<?php
require __DIR__ . '/../../../Vista/layouts/header.php';
// Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\layouts\header.php
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 border">
           
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
                    <?php $datos = isset($datos) ? $datos : []; ?>
                    <?php foreach ($datos as $v): ?>
                        <tr>
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
require __DIR__ . '/../../../Vista/layouts/footer.php';
// Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\layouts\footer.php
?>