FROM php:7.4.16-apache-buster

COPY . /var/www/html/
WORKDIR /var/www/html/
EXPOSE 80
CMD ["apache2-foreground"]