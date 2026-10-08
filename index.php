<?php
// Carga la configuracion de URL y base de datos antes de procesar una ruta.
require "Modelo/config.php";
require "Modelo/conexion.php";

// La ruta predeterminada ofrece el enlace al inicio de sesion.
$page ="index";
// El parametro GET page identifica la seccion o accion solicitada por el navegador.
if(isset($_GET['page']))
    $page = $_GET['page'];

// Este switch funciona como enrutador frontal: deriva la solicitud al controlador o vista adecuada.
switch($page){
    case 'login' : 
        require "Controlador/C_login.php";
        $_controlador = new LoginController();
        $_controlador->index();
        break;
     case 'loginauth' : 
        require "Controlador/C_login.php";
        $_controlador = new LoginController();
        $_controlador->login();
        break;
    case 'logout' :
        require "Controlador/C_login.php";
        $_controlador = new LoginController();
        $_controlador->logout();
        break;
    case 'admin' : 
        require   __DIR__ . "/Vista/layout/welcome.php";
        break; 

    case 'carrusel' :
        require   __DIR__ . "/Controlador/C_carrusel.php";
        $_controlador = new CarruselController();
        if (isset($_GET['opcion'])) {
            $metodo = $_GET['opcion'];
            if (method_exists('CarruselController', $metodo)) {
                $_controlador->{$metodo}();
            }
        } else {
            $_controlador->listado();
        }
        break;


    default :
        // Para una ruta desconocida, ofrece un enlace a la pantalla de acceso.
        echo "<a href='" . urlsite . "?page=login'>Login</a>";
        break;

    }
