FROM php:8.3.20-fpm-alpine3.20

WORKDIR /var/www/html

RUN apk add libzip-dev zip freetype-dev

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install gd

COPY setup/config/php-file-size-post.ini /usr/local/etc/php/conf.d

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www
