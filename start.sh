#!/bin/sh
set -e

# 1. Wait for database and clear/cache config
echo "Configuring Laravel..."
php artisan config:clear
php artisan config:cache

# 2. RUN MIGRATIONS (This fixes the 'table does not exist' error)
echo "Running migrations..."
php artisan migrate --force

# 3. Start PHP-FPM in the background
echo "Starting PHP-FPM..."
php-fpm -D

# 4. Start Nginx in the foreground
echo "Starting Nginx..."
exec nginx -g "daemon off;"