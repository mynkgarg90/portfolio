FROM php:8.2-apache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && rm -rf /var/lib/apt/lists/*

COPY composer.json ./
RUN composer install --no-dev --optimize-autoloader

COPY . /var/www/html/

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
