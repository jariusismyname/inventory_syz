#!/bin/sh
set -e

echo "Waiting for database..."

# Simple DB retry loop (optional)
until php artisan migrate:status > /dev/null 2>&1; do
    echo "DB not ready, retrying in 5s..."
    sleep 5
done

echo "Caching config..."
php artisan config:clear
php artisan config:cache

echo "Starting PHP-FPM in foreground..."
# php-fpm must run in foreground, not background
exec php-fpm
