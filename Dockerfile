# Stage 1 - Build Frontend (Vite)
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build  # outputs to /app/dist

# Stage 2 - Backend (Laravel + PHP + Composer)
FROM php:8.2-fpm AS backend

# System deps
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Laravel app files
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/dist ./public/dist

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Laravel cache clear
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

CMD ["php-fpm"]
