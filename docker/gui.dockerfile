FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install -y \
    curl libpng-dev libonig-dev \
    libxml2-dev zip unzip \
    nano git libpq-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql 

RUN docker-php-ext-install \
    pdo_mysql \
    pdo pdo_pgsql pgsql \
    mbstring \
    exif \
    bcmath \
    pcntl \
    gd

# install composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# add artisan auto completion
ADD docker/artisan/autocomplete.txt /autocomplete.txt
RUN touch /root/.bashrc && cat /autocomplete.txt >> /root/.bashrc

RUN apt autoremove
WORKDIR /var/www