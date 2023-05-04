FROM php:7.4-apache
COPY ./containers/app/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN chown -R www-data:www-data /var/www


