FROM php:8.2-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --quiet --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www

CMD ["apache2-foreground"]

