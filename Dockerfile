FROM php:8.2-fpm

# 1. Install system dependencies (Added nginx and libsqlite3-dev)
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. Get Composer from the official image (Only need this once)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Set working directory
WORKDIR /var/www

# 4. Copy application files
COPY . .

# 5. Install Laravel dependencies
# We run this after copying files so composer.json is present
RUN composer install --no-dev --optimize-autoloader

# 6. Set Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 7. Nginx config
COPY nginx.conf /etc/nginx/sites-available/default
# Ensure the symlink for Nginx is correct (standard for Debian/Ubuntu)
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# 8. Expose port
EXPOSE 80

# 9. Start Nginx and PHP-FPM
# Using -g 'daemon off;' is vital so the container doesn't exit immediately
CMD service nginx start && php-fpm