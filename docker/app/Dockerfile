FROM php:7.4-apache

WORKDIR /var/www/html

# composer のインストール
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# ファイルのコピー
COPY ./ /var/www/html
COPY ./docker/app/php.ini /usr/local/etc/php/php.ini
