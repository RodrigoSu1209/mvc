# MVC CRUD

Aplicacion PHP MVC con Apache y MariaDB para desarrollo local o despliegue en Docker.

## Docker

1. Copia `.env.example` a `.env` y cambia las contrasenas antes de exponer el servicio.
2. Ejecuta `docker compose up --build -d` desde la raiz del proyecto.
3. Abre `http://localhost:8080/`.

MariaDB crea la base `dbstore` y las tablas `carrusel` y `login` en el primer inicio. Los volumenes `mariadb_data` y `carousel_uploads` conservan la base y las imagenes al recrear los contenedores. El SQL de inicializacion solo se ejecuta cuando el volumen de MariaDB esta vacio; para reinicializarlo hay que borrar ese volumen, lo que tambien elimina sus datos.

Para crear una cuenta compatible con el inicio de sesion actual, abre el cliente de MariaDB con `docker compose exec db mariadb -u mvc -pmvc_dev_password dbstore` y ejecuta. Si cambiaste estos valores en `.env`, sustituye usuario, contrasena y nombre de base en el comando:

```sql
INSERT INTO login (email, password)
VALUES ('admin@local.test', MD5('cambia-esta-contrasena'));
```

Usa una contrasena propia y no publiques las credenciales de ejemplo. La aplicacion existente almacena contrasenas con MD5; antes de usarla en produccion, hay que migrar ese mecanismo a un algoritmo de contrasenas moderno.

Si se publica detras de un proxy, define `APP_URL` en `.env` con la URL publica completa y una barra final, por ejemplo `https://ejemplo.test/`.

## Base de datos local

En XAMPP, crea la base `dbstore` y carga `database/init.sql` dentro de ella. Si las variables `DB_*` no estan definidas, la aplicacion conserva los valores locales habituales: MySQL en `localhost`, usuario `root` y contrasena vacia.