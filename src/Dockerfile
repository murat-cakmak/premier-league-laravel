FROM php:8.1.1-fpm

RUN apt-get update
RUN apt-get install -y \
    git \
    sudo \
    supervisor \
    libzip-dev \
    unzip \
    cron

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install \
    opcache \
    pdo_mysql \
    zip

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer

RUN rm -rf /var/cache/apk/*

RUN chown -R www-data:www-data /var/www
RUN usermod -u 1000 www-data

COPY cron /etc/cron.d/cron

COPY ./supervisor/laravel-worker.conf /etc/supervisor/conf.d/
COPY ./ /var/www
WORKDIR /var/www

RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron
RUN touch /var/log/cron.log

EXPOSE 9000

CMD ["sh", "-c", "/usr/bin/supervisord -c /etc/supervisor/supervisord.conf && php-fpm && crond", "-f", "-d"]
