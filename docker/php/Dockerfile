FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    nodejs npm \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
 && apt-get clean

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
