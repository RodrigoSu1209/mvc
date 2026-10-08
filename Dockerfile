FROM php:8.2-apache

WORKDIR /var/www/html

COPY docker/apache-app.conf /etc/apache2/conf-available/app.conf
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && a2enconf app

COPY . .

RUN chown -R www-data:www-data /var/www/html/Public/img/carrusel

EXPOSE 80