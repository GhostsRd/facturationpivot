# Étape 1 : Construction et dépendances PHP
FROM php:8.2-fpm-alpine as builder

# Installer les extensions système et PHP nécessaires pour Laravel
RUN apk add --no-cache \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    bash

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip gd bcmath exif

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

# Installer les dépendances Composer pour la production
RUN composer install --no-dev --optimize-autoloader --no-progress

# Donner les bons droits d'accès aux dossiers de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]