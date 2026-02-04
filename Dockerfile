FROM php:8.4-fpm

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev curl \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring zip bcmath gd

# 3. Install Node.js (Done early so it's cached)
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs

# 4. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set Workdir
WORKDIR /var/www

# 6. Build Assets (This ensures manifest.json is created correctly)
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# 7. Install PHP Dependencies
RUN composer install --no-dev --optimize-autoloader

# 8. Nginx Setup
COPY nginx.conf /etc/nginx/sites-available/default
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# 9. Permissions (Crucial: Added /var/www/public)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public

# 10. Start Script Setup
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]