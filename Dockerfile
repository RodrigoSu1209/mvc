# Imagen base que ya incluye PHP 8.2 y el servidor Apache.
FROM php:8.2-apache

# Directorio raiz que Apache publica dentro del contenedor.
WORKDIR /var/www/html

# Copia la configuracion que permite usar las reglas del .htaccess.
COPY docker/apache-app.conf /etc/apache2/conf-available/app.conf
# Instala el driver PDO de MySQL, activa reescritura de URL y habilita la configuracion anterior.
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && a2enconf app

# Incorpora el codigo de la aplicacion a la imagen.
COPY . .

# Da a Apache permiso de escritura en la carpeta donde se cargan imagenes.
RUN chown -R www-data:www-data /var/www/html/Public/img/carrusel

# Documenta que el contenedor escucha HTTP en el puerto 80.
EXPOSE 80