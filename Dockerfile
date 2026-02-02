FROM php:8.4-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    curl \
    wget \
    gnupg \
    zip \
    python3 \
    python3-pip \
    && docker-php-ext-install pdo_mysql zip

# Node.js & npm (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Configure PHP-FPM to listen on port 80
RUN sed -i 's|listen = .*|listen = 0.0.0.0:80|' /usr/local/etc/php-fpm.d/www.conf

# Workdir
WORKDIR /var/www

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies & build Vite assets
RUN npm install
RUN npm run build

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Entrypoint
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
