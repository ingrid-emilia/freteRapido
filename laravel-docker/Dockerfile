FROM php:8.2-apache

RUN a2enmod rewrite

WORKDIR /app

COPY . /app

RUN chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

CMD php artisan serve
