FROM php:8.1.4-fpm-alpine3.14

ARG WWWGROUP=1000

WORKDIR /var/www/html

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS curl-dev openssl-dev pcre-dev pcre2-dev zlib-dev && \
    apk add --no-cache \
    libstdc++ \
    bash \
    su-exec \
    postgresql-dev \
    libnsl \
    libaio \
    libc6-compat \
    git \
    unzip \
    shadow && \
    \
    docker-php-ext-install \
    pcntl \
    pdo \
    pdo_pgsql

RUN ln -s /usr/lib/libnsl.so.2 /usr/lib/libnsl.so.1 && \
    ln -s /lib/libc.so.6 /usr/lib/libresolv.so.2 && \
    ln -s /lib/libc.musl-x86_64.so.1 /lib/ld-linux-x86-64.so.2


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN adduser -g $WWWGROUP -u 1000 -D sail

COPY ./docker/laravel/start-container /usr/local/bin/start-container
COPY ./docker/laravel/php.ini /etc/php/8.0/cli/conf.d/99-sail.ini

RUN chmod +x /usr/local/bin/start-container

COPY composer.json composer.lock /var/www/html/
RUN if [ "$APP_ENV" = "production" ] ; then \
    composer install --no-scripts --no-interaction --optimize-autoloader --no-dev; \
    else \
    composer install --no-scripts --no-interaction; \
    fi

COPY . /var/www/html/
RUN chmod 777 -R /var/www/html/storage /var/www/html/bootstrap/cache
