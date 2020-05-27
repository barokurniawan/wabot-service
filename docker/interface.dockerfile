FROM php:7.2-fpm
WORKDIR /var/www

RUN apt-get update && apt-get upgrade -y 
RUN apt-get install -y zip libzip-dev

RUN docker-php-ext-configure zip --with-libzip 

RUN docker-php-ext-install mbstring 
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN export COMPOSER_ALLOW_SUPERUSER=1