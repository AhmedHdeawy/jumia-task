FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# RUN  cd /var/www/ && chown -R www-data:www-data storage && chmod -R 777 storage/*