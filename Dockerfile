# Usa PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite

# Copia composer desde su imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia todos los archivos del proyecto al contenedor
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Ajusta permisos para storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Comando por defecto (el apache de php ya arranca)
CMD ["apache2-foreground"]
