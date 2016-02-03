FROM php:5.6-fpm
RUN docker-php-ext-install mbstring pdo pdo_mysql

ARG APP_ENV

ENV APP_ENV ${APP_ENV:-dev}
#RUN echo PHP_VERSION VAR -.from env vars.-: ${PHP_VERSION}
RUN echo ENV VAR: ${APP_ENV}

COPY . /var/www/
COPY /public /var/www/html
WORKDIR /var/www

ADD /docker-env/.env.${APP_ENV} WORKDIR/.env

RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/vendor

CMD ["php-fpm"]