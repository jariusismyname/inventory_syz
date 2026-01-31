#!/bin/sh

echo "Waiting for database..."

for i in 1 2 3 4 5
do
  php artisan migrate --force && break
  echo "DB not ready, retrying in 5s..."
  sleep 5
done

php-fpm -D
nginx -g "daemon off;"
