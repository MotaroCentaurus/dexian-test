FROM php:8.3-cli

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y libzip-dev unzip git curl libpq-dev && \
    docker-php-ext-install zip pdo pdo_pgsql

RUN pecl channel-update pecl.php.net \
    pecl install excimer

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

COPY ./ /var/www/

RUN composer install

EXPOSE 8000

ENTRYPOINT ["php", "-S", "0.0.0.0:8000", "-t", "public"]
