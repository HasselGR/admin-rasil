# -------------------------
# Imagen base con PHP 8.2 y Apache
# -------------------------
FROM php:8.2-apache

# -------------------------
# Directorio de trabajo
# -------------------------
WORKDIR /var/www/html

# -------------------------
# Habilitar mod_rewrite
# -------------------------
RUN a2enmod rewrite

# -------------------------
# Instalar extensiones PHP necesarias para Laravel + PostgreSQL
# -------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring bcmath xml zip gd intl opcache \
    && docker-php-ext-configure gd --with-jpeg --with-freetype

# -------------------------
# Instalar Composer
# -------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------------------------
# Copiar todo el proyecto
# -------------------------
COPY . .

# -------------------------
# Instalar dependencias de Laravel
# -------------------------
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# -------------------------
# Ajustar DocumentRoot de Apache a public y configurar permisos correctos
# -------------------------
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|<Directory /var/www/html/>|<Directory /var/www/html/public/>|' /etc/apache2/apache2.conf \
 && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
 && echo "<Directory /var/www/html/public/> \n\
    AllowOverride All \n\
    Require all granted \n\
</Directory>" >> /etc/apache2/apache2.conf

# -------------------------
# Permisos Laravel
# -------------------------
RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# -------------------------
# Exponer puerto 80
# -------------------------
EXPOSE 80

# -------------------------
# Comando por defecto
# -------------------------
CMD ["apache2-foreground"]