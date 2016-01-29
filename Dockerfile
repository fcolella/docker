FROM php:5.6-fpm

RUN docker-php-ext-install mbstring pdo pdo_mysql

ADD /laravel/env/.env.dev /var/www/env/.env

CMD [ "php-fpm" ]