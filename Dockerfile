FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip
# Example for a Debian/Ubuntu-based PHP image
# Copy the Composer binary from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Now run your install command
RUN php -d memory_limit=-1 /usr/bin/composer install --no-dev --optimize-autoloader# PHP extensions
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
