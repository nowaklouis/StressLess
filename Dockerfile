# Dockerfile
FROM php:8.2-fpm

# Installer dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev libonig-dev zip \
    && docker-php-ext-install pdo pdo_mysql intl opcache

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-scripts --no-interaction

# Symfony cache et logs appartiennent à www-data
RUN chown -R www-data:www-data /var/www/html/var

CMD ["php-fpm"]
