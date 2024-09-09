FROM php:8.2-cli

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apt-get update \
    && apt-get install -y libpq-dev libzip-dev zip libxslt1-dev librabbitmq-dev libssl-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql opcache zip xsl \
    && install-php-extensions zip amqp

RUN groupadd -g 1000 app && useradd -u 1000 -ms /bin/bash -g app app

WORKDIR /app

USER app
