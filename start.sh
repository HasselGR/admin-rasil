#!/bin/bash

# Wait for database to be ready
echo "Waiting for database..."
until PGPASSWORD=$PGPASSWORD psql -h "$PGHOST" -U "$PGUSER" -d "$PGDATABASE" -c '\q'; do
  >&2 echo "Database is unavailable - sleeping"
  sleep 1
done

>&2 echo "Database is up - executing command"

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Start Apache
exec apache2-foreground