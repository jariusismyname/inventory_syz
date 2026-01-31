FROM php:8.4-fpm

# 1. Install system dependencies (ADD NGINX HERE)
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip bcmath gd

# 3. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set Workdir
WORKDIR /var/www

# 5. Copy App and Install
COPY . .
RUN composer install --no-dev --optimize-autoloader

# 6. Nginx Setup
# Copy your nginx.conf to the correct location
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# 7. Permissions (Crucial for Laravel)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 8. Start Script Setup
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]


