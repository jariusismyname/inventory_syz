#!/bin/sh

echo "Waiting for database..."



#!/bin/sh

#!/bin/sh

set -e

echo "Starting PHP-FPM..."
php-fpm &

echo "Starting Nginx (foreground)..."
exec nginx -g "daemon off;"

