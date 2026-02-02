#!/bin/sh

echo "Waiting for database..."

for i in 1 2 3 4 5
do
  php artisan config:clear
php artisan config:cache

done

#!/bin/sh

#!/bin/sh

set -e

echo "Starting PHP-FPM..."
php-fpm &

