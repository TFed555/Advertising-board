FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y \
        procps \
        net-tools \
        libzip-dev \
        zip \
        unzip \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql zip gd


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY . /var/www

RUN composer install --no-interaction


CMD ["php-fpm", "-F"]