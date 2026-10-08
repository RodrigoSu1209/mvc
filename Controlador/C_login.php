<?php
require 'Modelo/login.php';
session_start();

class LoginController
{
    public function index()
    {
        if (isset($_SESSION['login']))
            header('Location: ' . urlsite);
        require __DIR__ . '/../Vista/front/formlogin.php';
        // Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\front\formlogin.php
    }

    public function login()
    {
        $_modelo = new Login();
        $_email = trim($_POST['txtemail']);
        $_passw = md5(trim($_POST['txtpassword']));

        $_resultado = $_modelo->login($_email, $_passw);
        if ($_resultado) {
            $_SESSION['login'] = $_email;
            header('Location: ' . urlsite . "?page=admin");
        } else {
            header('Location: ' . urlsite . "?msg=No coinciden las credenciales");
        }
    }
   
    public function logout()
    {
        if (!isset($_SESSION['login']))
            header('Location: ' . urlsite);
        unset($_SESSION['login']);
        session_destroy();
        header('Location:' . urlsite);
    }
}
