<?php
// El controlador delega las consultas de autenticacion al modelo Login.
require 'Modelo/login.php';
// La sesion permite conservar el estado de acceso entre solicitudes HTTP.
session_start();

class LoginController
{
    // Muestra el formulario, salvo que ya exista una sesion autenticada.
    public function index()
    {
        if (isset($_SESSION['login']))
            header('Location: ' . urlsite);
        // La vista genera el formulario y reutiliza la cabecera y el pie comunes.
        require __DIR__ . '/../Vista/front/formlogin.php';
        // Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\front\formlogin.php
    }

    // Comprueba las credenciales recibidas desde el formulario de inicio de sesion.
    public function login()
    {
        $_modelo = new Login();
        // trim quita espacios exteriores; MD5 se conserva por compatibilidad con la tabla actual.
        // MD5 no es apropiado para contrasenas y debe migrarse antes de usar la aplicacion en produccion.
        $_email = trim($_POST['txtemail']);
        $_passw = md5(trim($_POST['txtpassword']));

        // El modelo devuelve true cuando encuentra una fila con el correo y el hash recibidos.
        $_resultado = $_modelo->login($_email, $_passw);
        if ($_resultado) {
            // Guardar el correo en la sesion permite reconocer al usuario en futuras solicitudes.
            $_SESSION['login'] = $_email;
            header('Location: ' . urlsite . "?page=admin");
        } else {
            // Si las credenciales no coinciden, vuelve al inicio con un mensaje en la URL.
            header('Location: ' . urlsite . "?msg=No coinciden las credenciales");
        }
    }
   
    // Borra los datos de la sesion y redirige al usuario a la portada.
    public function logout()
    {
        if (!isset($_SESSION['login']))
            header('Location: ' . urlsite);
        // Quita el indicador de acceso y destruye el almacenamiento de la sesion.
        unset($_SESSION['login']);
        session_destroy();
        header('Location:' . urlsite);
    }
}
