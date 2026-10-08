<?php
require "Modelo/config.php";
require "Modelo/conexion.php";


$page ="index";
if(isset($_GET['page']))
    $page = $_GET['page'];
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


    default : echo "<a href='" . urlsite . "?page=login'>Login</a>"; break;

    }
