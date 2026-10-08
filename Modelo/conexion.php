<?php

class Conexion
{
    public $conexion;


    public function conectar()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $opciones = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->conexion = new PDO($dsn, DB_USER, DB_PASSWORD, $opciones);
            // echo "Se entablo correctamente la conexión a la base de datos"; 
            return $this->conexion;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function desconectar() {
        $this->conexion=null; 
    }
}
