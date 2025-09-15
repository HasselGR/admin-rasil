mkdir -p scripts

cat > scripts/00-laravel-deploy.sh <<'EOF'
#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

echo ">>> Composer install"
composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true

echo ">>> Generating APP_KEY (if missing)"
php artisan key:generate --force || true

echo ">>> NPM install & build (Vite/Mix)"
if [ -f package.json ]; then
  npm ci || npm install --silent
  npm run build || true
fi

echo ">>> Laravel caches"
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo ">>> Migrate DB (force)"
php artisan migrate --force || true

echo ">>> Storage link"
php artisan storage:link || true

echo ">>> Fix permissions"
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

echo ">>> Deploy script finished"
EOF
