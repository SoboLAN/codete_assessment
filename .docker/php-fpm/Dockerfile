FROM php:8.1-fpm-alpine
WORKDIR /var/www/app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ git bash icu-dev libzip-dev linux-headers

RUN pecl install xdebug-3.2.2

RUN docker-php-ext-install -j$(nproc) \
        bcmath \
        opcache \
        intl \
        zip \
        pdo_pgsql

RUN docker-php-ext-enable apcu opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer

COPY etc/infrastructure/php/ /usr/local/etc/php/

# allow non-root users have home
RUN mkdir -p /opt/home
RUN chmod 777 /opt/home
ENV HOME /opt/home
