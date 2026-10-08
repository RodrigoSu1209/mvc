<?php
class Login
{
    // Referencia al objeto que administra la conexion PDO.
    private $_db;

    // Crea el objeto de conexion usado por el metodo login().
    public function __construct()
    {
        $this->_db = new Conexion();
    }

    // Devuelve true si existe una fila con el correo y el hash recibidos.
    public function login($email, $password) {
        $this->_db->conectar();
        // Esta consulta concatena datos en SQL y puede permitir una inyeccion SQL.
        // En produccion debe usar placeholders PDO y contrasenas password_hash/password_verify.
        $r = $this->_db->conexion->prepare("SELECT * FROM login WHERE email='".$email."' AND PASSWORD='".$password."'");
        $r->execute();
        $this->_db->desconectar();
    
        // FETCH_OBJ devuelve una fila como objeto o false cuando no encuentra coincidencias.
        if ($r->fetch(PDO::FETCH_OBJ))
            return true; 
        else 
            return false;
        }
}
