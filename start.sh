#!/bin/sh

echo "Waiting for database..."

for i in 1 2 3 4 5
do
  php artisan migrate --force && break
  echo "DB not ready, retrying in 5s..."
  sleep 5
done

#!/bin/sh

#!/bin/sh

set -e

echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx (foreground)..."
exec nginx -g "daemon off;"

