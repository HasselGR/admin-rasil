FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    postgresql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache modules
RUN a2enmod rewrite headers

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# CRITICAL: Remove any .env files that might have slipped through
RUN rm -f .env .env.production .env.local .env.staging || true

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm ci --only=production && npm run build && rm -rf node_modules

# Create proper Apache configuration
COPY <<EOF /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/html/public
    
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
        Options -Indexes
    </Directory>
    
    # Security headers
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
    
    # Logs
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
    LogLevel warn
</VirtualHost>
EOF

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    chmod -R 775 /var/www/html/storage && \
    chmod -R 775 /var/www/html/bootstrap/cache

# Create startup script
COPY <<EOF /usr/local/bin/start-app.sh
#!/bin/bash
set -e

echo "🚀 Starting Admin Rasil deployment..."

# Verify no .env files exist
if [ -f "/var/www/html/.env" ] || [ -f "/var/www/html/.env.production" ]; then
    echo "❌ Found .env files, removing them..."
    rm -f /var/www/html/.env /var/www/html/.env.production
fi

# Wait for database connection
echo "⏳ Waiting for database connection..."
until pg_isready -h "\$DB_HOST" -p "\$DB_PORT" -U "\$DB_USERNAME" -d "\$DB_DATABASE"; do
    echo "Database not ready, waiting..."
    sleep 2
done
echo "✅ Database connection established"

# Clear any cached config that might reference old .env files
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Generate APP_KEY if not set
if [ -z "\$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Create storage link
php artisan storage:link || true

# Cache configuration for production
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Final permission check
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✅ Application ready! Starting Apache..."
exec apache2-foreground
EOF

# Make startup script executable
RUN chmod +x /usr/local/bin/start-app.sh

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Expose port
EXPOSE 80

# Use our startup script
CMD ["/usr/local/bin/start-app.sh"]