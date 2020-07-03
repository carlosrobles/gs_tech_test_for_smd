FROM php:7.2-apache

# install some bare necessities
RUN apt-get update && apt-get install -y --no-install-recommends \
    apt-utils \
    sudo \
    cron \
    curl \
    iproute2 \
    libpng-dev \
    libxml2-dev \
    libmcrypt-dev

# install required extensions
RUN docker-php-ext-install \
    gd \
    soap \
    json \
    pdo \
    pdo_mysql

# Enable and configure xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Enable and configure mcript
RUN pecl install mcrypt-1.0.1
RUN docker-php-ext-enable mcrypt

RUN userdel www-data
RUN groupadd -g 1000 www-data
RUN useradd -r -m -u 1000 www-data -g www-data
RUN chown -Rf www-data:www-data /var/www/html/