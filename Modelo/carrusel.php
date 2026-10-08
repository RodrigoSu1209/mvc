<?php
class Carrusel
{
    // Conexion usada para ejecutar las consultas y filas obtenidas por buscar().
    private $_db;
    private $lista = [];

    // Prepara el objeto de conexion; esta se abre al ejecutar cada operacion.
    public function __construct()
    {
        $this->_db = new Conexion();
    }

    // Busca registros y los devuelve como objetos PHP.
    public function buscar($condicion)
    {
        $this->_db->conectar();
        // La condicion se concatena al SQL; debe reemplazarse por un parametro PDO preparado.
        $consulta = $this->_db->conexion->prepare("SELECT * FROM carrusel WHERE id=" . $condicion);
        $consulta->execute();

        // FETCH_OBJ entrega cada fila como un objeto con una propiedad por columna.
        while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
            $this->lista[] = $row;
        }
        $this->_db->desconectar();
        return $this->lista;
    }

    // Inserta una fila; $data contiene actualmente valores en formato de texto SQL.
    public function insertar($data)
    {
        $this->_db->conectar();
        // query ejecuta el SQL directamente; para datos variables se deben usar parametros preparados.
        $consulta = $this->_db->conexion->query("insert into carrusel values (NULL," . $data . ")");
        $this->_db->desconectar();

        if ($consulta)
            return true;
        else
            return false;
    }

    // Actualiza las columnas indicadas en $data para las filas que cumplen $condicion.
    public function editar($data, $condicion)
    {
        $this->_db->conectar();
        // Los valores y la condicion se concatenan; no es seguro con datos no confiables.
        $consulta = $this->_db->conexion->query("UPDATE carrusel set " . $data . " WHERE ". $condicion);
        $this->_db->desconectar();

        if ($consulta)
            return true;
        else
            return false;
    }

    // Elimina las filas coincidentes; el controlador actual no expone esta operacion.
    public function eliminar($data, $condicion)
    {
        $this->_db->conectar();
        $consulta = $this->_db->conexion->query("DELETE FROM carrusel WHERE " . $condicion);
        $this->_db->desconectar();

        if ($consulta)
            return true;
        else
            return false;
    }
}
