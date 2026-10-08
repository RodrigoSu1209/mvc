<?php
// La vista del formulario reutiliza la estructura comun del sitio.
require __DIR__ . '/../layouts/header.php';
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5 mb-5">
            <!-- POST envia las credenciales al enrutador, que ejecuta LoginController::login(). -->
            <form action="<?php echo urlsite ?>?page=loginauth" method="post">
                <div class="form-group">
                    <!-- El nombre txtemail es la clave que lee el controlador desde $_POST. -->
                    <input type="email" class="form-control" name="txtemail" placeholder="Email">
                </div>
                <div class="form-group">
                    <!-- El navegador oculta visualmente el valor escrito en este campo. -->
                    <input type="password" class="form-control"  name="txtpassword" placeholder="Contraseña">
                </div>
                <input type="submit" value="login" class="btn btn-primary btn-block" name="btnM_login">
            </form>

            <!-- Muestra el mensaje de estado que el controlador agrega a la URL al redirigir. -->
            <p class="text-danger"><?php echo ((isset($_GET['msg']))) ? $_GET['msg'] : "" ?> </p>


        </div>
    </div>
</div>

<?php
// Cierra la estructura HTML abierta por la cabecera compartida.
require __DIR__ . '/../layouts/footer.php';
?>
