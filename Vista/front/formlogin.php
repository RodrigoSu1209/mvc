<?php
require __DIR__ . '/../layouts/header.php';
// Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\layouts\header.php
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-5 mb-5">
            <form action="<?php echo urlsite ?>?page=loginauth" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" name="txtemail" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"  name="txtpassword" placeholder="Contraseña">
                </div>
                <input type="submit" value="login" class="btn btn-primary btn-block" name="btnM_login">
            </form>

            <p class="text-danger"><?php echo ((isset($_GET['msg']))) ? $_GET['msg'] : "" ?> </p>


        </div>
    </div>
</div>

<?php
require __DIR__ . '/../layouts/footer.php';
// Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\layouts\footer.php
?>
