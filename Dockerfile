# THIS LINE IS MISSING:
FROM php:8.4-fpm

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# 2. Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip bcmath gd

# 3. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set Workdir
WORKDIR /var/www

# 5. Copy and Install
COPY . .
RUN composer install --no-dev --optimize-autoloader