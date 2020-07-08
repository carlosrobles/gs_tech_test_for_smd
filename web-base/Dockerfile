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
    libmcrypt-dev \
    iproute2

# install required extensions
RUN docker-php-ext-install \
    gd \
    soap \
    json \
    pdo \
    pdo_mysql

# install xdebug
# should not install in prod
RUN pecl install xdebug-2.6.1 && docker-php-ext-enable xdebug
RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20151012/xdebug.so"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9001' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini

# Enable and configure mcript
RUN pecl install mcrypt-1.0.1
RUN docker-php-ext-enable mcrypt

RUN userdel www-data
RUN groupadd -g 1000 www-data
RUN useradd -r -m -u 1000 www-data -g www-data
RUN chown -Rf www-data:www-data /var/www/html/

###### Install Composer
RUN curl -s http://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer