#!/bin/sh

# 1. Start Nginx using the global 'daemon off' flag 
# This tells Nginx to stay in the foreground so we can see its logs
nginx -g "daemon off;" &

# 2. Start PHP-FPM in the foreground
php-fpm