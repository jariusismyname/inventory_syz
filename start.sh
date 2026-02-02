#!/bin/sh
set -e

echo "Waiting for database..."
until php artisan migrate:status > /dev/null 2>&1; do
    echo "DB not ready, retrying in 5s..."
    sleep 5
done

echo "Caching config..."
php artisan config:clear
php artisan config:cache

echo "Starting PHP-FPM..."
exec php-fpm -F
