-- Guarda los elementos que se muestran en el carrusel del sitio.
CREATE TABLE IF NOT EXISTS carrusel (
    -- Identificador numerico que MariaDB genera automaticamente.
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    -- Texto descriptivo que acompana a la imagen.
    descripcion VARCHAR(255) NOT NULL,
    -- Nombre o ruta relativa del archivo de imagen guardado por la aplicacion.
    urlfoto VARCHAR(255) NOT NULL,
    -- Enlace opcional asociado al elemento; vacio si no se especifica.
    link VARCHAR(2048) NOT NULL DEFAULT '',
    -- Posicion de ordenamiento definida en el formulario.
    orden INT NOT NULL DEFAULT 0,
    -- La clave primaria identifica de forma unica cada elemento.
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Guarda las credenciales que usa el formulario de inicio de sesion.
CREATE TABLE IF NOT EXISTS login (
    -- Identificador interno y autoincremental del usuario.
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    -- Correo utilizado como nombre de acceso; no se permiten duplicados.
    email VARCHAR(254) NOT NULL,
    -- Actualmente almacena una cadena de 32 caracteres compatible con el MD5 heredado.
    -- MD5 no es seguro para contrasenas de produccion y debe reemplazarse.
    password CHAR(32) NOT NULL,
    -- Define la clave primaria y asegura que cada correo aparezca una sola vez.
    PRIMARY KEY (id),
    UNIQUE KEY uq_login_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;