FROM php:8.4-fpm-alpine
WORKDIR /app
RUN apk add --no-cache \
    bash
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
