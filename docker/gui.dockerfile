FROM php:7.4-fpm

ARG uid=${UID}
ARG user=${USER}

RUN apt-get update && \
    apt-get install -y \
    curl libpng-dev libonig-dev \
    libxml2-dev zip unzip \
    nano git

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    bcmath \
    pcntl \
    gd

# create system user 
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

# install composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt autoremove

WORKDIR /var/www

USER $user