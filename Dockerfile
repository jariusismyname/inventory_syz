FROM php:8.2-fpm

# Install system deps
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev
    && docker-php-ext-install zip
# Example for a Debian/Ubuntu-based PHP image
RUN php -d memory_limit=-1 /usr/bin/composer install --no-dev --optimize-autoloader
# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring bcmath gd zip fileinfo

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app
COPY . .

# Install Laravel deps
RUN composer install --no-dev --optimize-autoloader -vvv

# Nginx config
COPY nginx.conf /etc/nginx/sites-available/default

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Expose HTTP port
EXPOSE 80

# Start Nginx + PHP-FPM
CMD service nginx start && php-fpm
