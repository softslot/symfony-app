FROM php:8.2-fpm

RUN apt-get update && apt-get install -y libpq-dev libxslt1-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql opcache xsl

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions xdebug zip amqp

ENV PHP_IDE_CONFIG 'serverName=symfony-app'

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /app
