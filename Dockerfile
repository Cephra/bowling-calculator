FROM php:fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk add --no-cache bash git icu-dev

RUN git config --global --add safe.directory /var/www/html
RUN git config --global user.email "builder@docker"
RUN git config --global user.email "builder"

RUN docker-php-ext-enable opcache
RUN docker-php-ext-install intl

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli
