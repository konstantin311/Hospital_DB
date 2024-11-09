FROM php:7.4-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Установка дополнительных расширений (если нужно)
# RUN docker-php-ext-install другие_расширения

# Копирование исходников
COPY ./src /var/www/html