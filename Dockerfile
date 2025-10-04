FROM php:8.0-apache

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

EXPOSE 80

CMD ["apache2-foreground"]
