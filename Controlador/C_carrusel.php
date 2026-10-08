<?php
// El controlador recibe las acciones web y delega el acceso a datos al modelo Carrusel.
require 'Modelo/carrusel.php';

class CarruselController
{

    // Obtiene los registros y entrega sus datos a la vista de administracion.
    public  function listado()
    {
        $_modelo = new Carrusel();
        $datos = $_modelo->buscar("1");
        require __DIR__ . '/../Vista/admin/carrusel/listado.php';
        // Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\front\carrusel.php
    }

    // Presenta el formulario para crear un elemento nuevo.
    public function nuevo()
    {
        require __DIR__ . '/../Vista/admin/carrusel/nuevo.php';
        // Ruta absoluta: C:\xampp\htdocs\MVC\MVC_CRUD\Vista\front\carrusel.php     


    }

    // Recibe los campos del formulario y guarda un elemento y su imagen.
    public function guardar()
    {
        // Los nombres deben coincidir con los atributos name del formulario HTML.
        $_descripcion = $_REQUEST['txtdescripcion'];
        $_link = $_REQUEST['txtlink'];
        $_orden = $_REQUEST['txtorden'];
        $_urlfoto = $_FILES['urlfoto']['name'];


        // Define la carpeta publica donde se almacenan las imagenes del carrusel.
        $dir_subida = 'Public/img/carrusel/';
        $fichero_subido = $dir_subida . basename($_FILES['urlfoto']['name']);

        // move_uploaded_file comprueba que el origen sea un archivo recibido mediante una carga HTTP.
        // Este ejemplo no valida tipo, extension ni tamano; no es una carga segura para produccion.
        echo '<pre>';
        if (move_uploaded_file($_FILES['urlfoto']['tmp_name'], $fichero_subido)) {
            echo "El fichero es válido, y ha sido cargado con éxito. Aquí hay más información :\n";
        } else {
            echo "Ataque potencial por carga de ficheros. Aquí hay más información :\n";
        }

        // El modelo recibe valores concatenados como texto SQL; conviene migrarlos a parametros preparados.
        $carrusel = new Carrusel();
        $data = "'" . $_descripcion . "','" . $_urlfoto . "','" . $_link . "','" . $_orden . "'";

        // Si la insercion funciona, vuelve al listado; de lo contrario muestra un error.
        $accion = $carrusel->insertar($data);
        if ($accion) {
            header('Location: ' . urlsite . "?page=carrusel");
        } else {
            echo "Error al guardar el registro";
        }
    }
    // Busca un registro por identificador y muestra el formulario de edicion.
    public function editar()
    {
        $_id = $_REQUEST['id'];
        $carrusel = new Carrusel();
        $datos = $carrusel->buscar($_id);
        require __DIR__ . '/../Vista/admin/carrusel/editar.php';
    }
    // Actualiza los datos; la imagen solo cambia si se recibe un nuevo archivo correctamente.
    public function actualizar()
    {
        $_id = $_REQUEST['txtid'];
        $_descripcion = $_REQUEST['txtdescripcion'];
        $_link = $_REQUEST['txtlink'];
        $_orden = $_REQUEST['txtorden'];
        $_urlfoto = "";

        // La imagen es opcional al editar; si no se carga otra, se conserva la existente.
        if (isset($_FILES['urlfoto']) && $_FILES['urlfoto']['error'] === UPLOAD_ERR_OK) {
            $dir_subida = 'Public/img/carrusel/';
            $fichero_subido = $dir_subida . basename($_FILES['urlfoto']['name']);

            if (move_uploaded_file($_FILES['urlfoto']['tmp_name'], $fichero_subido)) {
                $_urlfoto = ", urlfoto='" . $_FILES['urlfoto']['name'] . "'";
            }
        }


        // El modelo ejecuta la actualizacion usando los fragmentos SQL construidos arriba.
        // Los datos recibidos del usuario deben enviarse con consultas preparadas.
        $carrusel = new Carrusel();
        $data = "descripcion='" . $_descripcion . "', link='" . $_link . "', orden='" . $_orden . "'" . $_urlfoto;
        $accion = $carrusel->editar($data, "id=" . $_id);
        
        // El resultado de la consulta determina la redireccion que recibe el navegador.
        if($accion) 
            header('Location: ' . urlsite ."?page=carrusel");
        else 
            header('Location: ' . urlsite ."?page=carrusel&msg=Error al actualizar el registro. No se pudo");
        
    }
}

