<?php

// Encapsula la apertura y liberacion de una conexion PDO a MySQL o MariaDB.
class Conexion
{
    // Conserva la instancia PDO mientras se ejecuta una operacion del modelo.
    public $conexion;


    // Abre la conexion usando las constantes definidas en Modelo/config.php.
    public function conectar()
    {
        try {
            // El DSN identifica el motor, servidor, base de datos y codificacion de caracteres.
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            // Configura PDO para lanzar excepciones si falla la conexion o una consulta.
            $opciones = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->conexion = new PDO($dsn, DB_USER, DB_PASSWORD, $opciones);
            // echo "Se entablo correctamente la conexión a la base de datos"; 
            return $this->conexion;
        } catch (PDOException $e) {
            // En desarrollo se muestra el error; en produccion debe registrarse sin exponer detalles al visitante.
            echo $e->getMessage();
        }
    }

    // Libera la referencia PDO; PHP cerrara la conexion cuando ya no se utilice.
    public function desconectar() {
        $this->conexion=null; 
    }
}
