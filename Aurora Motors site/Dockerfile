FROM php:7.4-apache

# Установка расширений PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Установка дополнительных расширений для работы с изображениями
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Включение модуля rewrite
RUN a2enmod rewrite

# Установка прав на директорию
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Копирование php.ini с настройками
RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "display_errors = On" >> /usr/local/etc/php/conf.d/error.ini \
    && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/error.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/error.ini

EXPOSE 80

CMD ["apache2-foreground"]