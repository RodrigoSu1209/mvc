# MVC CRUD

Aplicacion PHP MVC con Apache y MariaDB para desarrollo local o despliegue en Docker.

## 1. Instalar Docker

En Windows o macOS instala Docker Desktop. En Linux instala Docker Engine y el complemento Docker Compose. En Windows puede ser necesario habilitar WSL 2. Sigue la guia oficial: <https://docs.docker.com/get-started/get-docker/>.

Abre Docker Desktop y espera a que indique que Docker esta funcionando. En una terminal verifica que los comandos esten disponibles:

```powershell
docker --version
docker compose version
```

Docker ejecuta los contenedores; Compose lee `compose.yaml` y coordina la aplicacion, la base de datos, la red y los volumenes.

## 2. Obtener y preparar el proyecto

Clona el repositorio y entra en su carpeta. Si ya tienes los archivos, abre una terminal en la carpeta que contiene `compose.yaml`.

```powershell
git clone https://github.com/RodrigoSu1209/mvc.git
Set-Location mvc
```

Crea la configuracion local copiando la plantilla:

```powershell
Copy-Item .env.example .env
```

Edita `.env` y cambia `DB_PASSWORD` y `DB_ROOT_PASSWORD` por contrasenas propias. `.env` contiene configuracion privada y esta excluido de Git; no lo subas al repositorio. Los valores de ejemplo son solo para desarrollo.

## 3. Comprender Dockerfile y Compose

El `Dockerfile` construye la imagen de la aplicacion. Parte de `php:8.2-apache`, instala `pdo_mysql` para que PHP se conecte a MariaDB, activa `mod_rewrite` y copia el codigo al directorio web de Apache.

`compose.yaml` esta escrito en YAML, un formato de configuracion organizado por sangrias. Declara dos servicios:

- `app` construye la imagen usando el `Dockerfile` de esta carpeta, publica el puerto `80` del contenedor como `8080` en el equipo y recibe la configuracion de PHP.
- `db` utiliza `mariadb:11.4`, crea la base y el usuario indicados por variables de entorno y carga `database/init.sql` al inicializar una base vacia.
- `depends_on` espera a que MariaDB supere su comprobacion de salud antes de iniciar la aplicacion.
- `mariadb_data` y `carousel_uploads` son volumenes nombrados: guardan la base y las imagenes aunque los contenedores se eliminen o se vuelvan a crear.

Los contenedores comparten una red interna. PHP se conecta al host `db`, que es el nombre del servicio MariaDB. No se usa `localhost`: dentro del contenedor de PHP, `localhost` apuntaria al propio contenedor de PHP.

Apache tiene activo `mod_rewrite` y permite las reglas del `.htaccess` mediante `docker/apache-app.conf`. No necesitas instalar ni configurar Apache por separado en el equipo.

## 4. Construir e iniciar el sitio

Desde la carpeta del proyecto, comprueba primero que Compose pueda interpretar el YAML y resolver las variables:

```powershell
docker compose config
```

Construye la imagen de la aplicacion e inicia Apache/PHP y MariaDB en segundo plano:

```powershell
docker compose up --build -d
```

La primera ejecucion descarga las imagenes necesarias y construye PHP/Apache con `pdo_mysql`. Cuando termine, abre <http://localhost:8080/>.

Comprueba el estado de los servicios y consulta sus registros si alguno no inicia:

```powershell
docker compose ps
docker compose logs -f app db
```

Pulsa `Ctrl+C` para dejar de seguir los registros; esto no detiene los contenedores.

## 5. Crear una cuenta de prueba

MariaDB crea la base `dbstore` y las tablas `carrusel` y `login` durante su primera inicializacion. Abre el cliente SQL dentro del contenedor:

```powershell
docker compose exec db mariadb -u mvc -p dbstore
```

Cuando se solicite, escribe el valor de `DB_PASSWORD` definido en `.env`. En el indicador de MariaDB crea una cuenta compatible con el inicio de sesion actual:

```sql
INSERT INTO login (email, password)
VALUES ('admin@local.test', MD5('cambia-esta-contrasena'));
```

Escribe `exit` para salir. Usa una contrasena propia incluso en las pruebas. La aplicacion almacena actualmente las contrasenas con MD5, que no es adecuado para produccion; antes de publicar el sitio, cambia a un algoritmo moderno para contrasenas.

## 6. Detener y conservar los datos

Deten los contenedores sin borrar los datos:

```powershell
docker compose down
```

Para iniciarlos de nuevo:

```powershell
docker compose up -d
```

Los volumenes conservan la base y las imagenes entre reinicios. El SQL de inicializacion solo se ejecuta cuando MariaDB crea un volumen vacio; editar `database/init.sql` no actualiza una base que ya existe.

Para borrar los contenedores y tambien sus volumenes usa `docker compose down -v`. **Esto elimina permanentemente la base de datos y las imagenes subidas.**

## Solucion de problemas

- Si el puerto `8080` ya esta ocupado, cambia el lado izquierdo de `8080:80` en `compose.yaml`, por ejemplo a `8081:80`, y abre `http://localhost:8081/`.
- Si PHP no conecta con MariaDB, revisa `docker compose ps` y `docker compose logs db`. El host debe ser `db` y las credenciales deben coincidir con las usadas cuando se inicializo el volumen.
- Cambiar una contrasena en `.env` no modifica una cuenta existente en una base ya inicializada. Para empezar de cero puedes ejecutar `docker compose down -v` y luego `docker compose up --build -d`; perderas todos los datos guardados.
- Si aparece un error de PHP, revisa `docker compose logs app`.

## Usar XAMPP sin Docker

Tambien puedes ejecutar el sitio con Apache y MySQL/MariaDB de XAMPP. Crea la base `dbstore` e importa `database/init.sql` desde phpMyAdmin. Si no defines variables `DB_*`, la aplicacion usa `localhost`, el usuario `root` y contrasena vacia. Esos valores predeterminados son solo para desarrollo local.

Si despliegas detras de un proxy, configura `APP_URL` en `.env` con la URL publica completa y una barra final, por ejemplo `https://ejemplo.test/`.