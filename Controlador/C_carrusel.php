<?php
require 'Modelo/carrusel.php';

class CarruselController
{

    public  function listado()
    {
        $_modelo = new Carrusel();
        $datos = $_modelo->buscar("1");
        require __DIR__ . '/../Vista/admin/carrusel/listado.php';
        // Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\front\carrusel.php
    }

    public function nuevo()
    {
        require __DIR__ . '/../Vista/admin/carrusel/nuevo.php';
        // Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\front\carrusel.php     


    }

    public function guardar()
    {
        $_descripcion = $_REQUEST['txtdescripcion'];
        $_link = $_REQUEST['txtlink'];
        $_orden = $_REQUEST['txtorden'];
        $_urlfoto = $_FILES['urlfoto']['name'];


        $dir_subida = 'Public/img/carrusel/';
        $fichero_subido = $dir_subida . basename($_FILES['urlfoto']['name']);

        echo '<pre>';
        if (move_uploaded_file($_FILES['urlfoto']['tmp_name'], $fichero_subido)) {
            echo "El fichero es válido, y ha sido cargado con éxito. Aquí hay más información :\n";
        } else {
            echo "Ataque potencial por carga de ficheros. Aquí hay más información :\n";
        }

        $carrusel = new Carrusel();
        $data = "'" . $_descripcion . "','" . $_urlfoto . "','" . $_link . "','" . $_orden . "'";

        $accion = $carrusel->insertar($data);
        if ($accion) {
            header('Location: ' . urlsite . "?page=carrusel");
        } else {
            echo "Error al guardar el registro";
        }
    }
    public function editar()
    {
        $_id = $_REQUEST['id'];
        $carrusel = new Carrusel();
        $datos = $carrusel->buscar($_id);
        require __DIR__ . '/../Vista/admin/carrusel/editar.php';
    }
public function actualizar()
    {
        $_id = $_REQUEST['txtid'];
        $_descripcion = $_REQUEST['txtdescripcion'];
        $_link = $_REQUEST['txtlink'];
        $_orden = $_REQUEST['txtorden'];
        $_urlfoto = "";

        if (isset($_FILES['urlfoto']) && $_FILES['urlfoto']['error'] === UPLOAD_ERR_OK) {
            $dir_subida = 'Public/img/carrusel/';
            $fichero_subido = $dir_subida . basename($_FILES['urlfoto']['name']);

            if (move_uploaded_file($_FILES['urlfoto']['tmp_name'], $fichero_subido)) {
                $_urlfoto = ", urlfoto='" . $_FILES['urlfoto']['name'] . "'";
            }
        }


        $carrusel = new Carrusel();
        $data = "descripcion='" . $_descripcion . "', link='" . $_link . "', orden='" . $_orden . "'" . $_urlfoto;
        $accion = $carrusel->editar($data, "id=" . $_id);
        
        if($accion) 
            header('Location: ' . urlsite ."?page=carrusel");
        else 
            header('Location: ' . urlsite ."?page=carrusel&msg=Error al actualizar el registro. No se pudo");
        
    }
}

