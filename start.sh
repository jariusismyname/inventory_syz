#!/bin/sh

# Run migrations (safe for free tier)
php artisan migrate --force || true

# Start Nginx in background
nginx -g "daemon off;" &

# Start PHP-FPM in foreground
php-fpm
