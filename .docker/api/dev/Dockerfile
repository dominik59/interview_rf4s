FROM php:7.4-fpm

RUN apt-get update

# Install Postgre PDO
RUN apt-get install --no-install-recommends -y libpq-dev && \
     docker-php-ext-install pdo pgsql pdo_pgsql && \
     docker-php-ext-install opcache


RUN yes | pecl install xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-enable xdebug

COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/public

CMD ["php-fpm"]