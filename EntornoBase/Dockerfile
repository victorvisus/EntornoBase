FROM php:8.2-apache

# Instalamos las extensiones necesarias para PHP y MySQL/MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitamos el módulo de reescritura de Apache (útil para WordPress)
RUN a2enmod rewrite

# Exponemos el puerto 80
EXPOSE 80