# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev

# 2. Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip bcmath gd

# 3. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set Workdir
WORKDIR /var/www

# 5. Copy ONLY composer files first (this leverages Docker caching)
COPY composer.json composer.lock ./

# 6. Install dependencies
RUN php -d memory_limit=-1 /usr/bin/composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

# 7. Copy the rest of the app
COPY . .