FROM php:8.3.20-fpm-alpine3.20

WORKDIR /var/www/html

RUN apk add libzip-dev zip freetype-dev icu-dev

RUN docker-php-ext-install zip \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

COPY setup/config/php-file-size-post.ini /usr/local/etc/php/conf.d

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www
