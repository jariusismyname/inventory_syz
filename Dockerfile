FROM php:8.4-fpm


# 1. Install system dependencies (Added libpq-dev for PostgreSQL)
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions (Added pdo_pgsql)
RUN docker-php-ext-install pdo_pgsql mbstring zip bcmath gd
# 3. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set Workdir
WORKDIR /var/www

# 5. Copy App and Install
COPY . .
RUN composer install --no-dev --optimize-autoloader
# Install Node.js and NPM
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Install JS dependencies and build assets
COPY package*.json ./
RUN npm install
RUN npm run build
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

