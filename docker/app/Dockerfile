FROM php:7.4-apache

WORKDIR /var/www/html

#RUN apt update && \
    #apt install -y default-mysql-client locales-all

# PHP で必要なライブラリをインストール
RUN apt-get update \
  && apt-get install -y libonig-dev libzip-dev unzip mariadb-client locales-all \
  && docker-php-ext-install pdo_mysql mysqli mbstring zip

ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL ja_JP.UTF-8

# composer のインストール
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# ファイルのコピー
COPY ./ /var/www/html
COPY ./docker/app/php.ini /usr/local/etc/php/php.ini
