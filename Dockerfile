FROM php:7.2-apache
COPY *.php /var/www/html/
COPY php.ini /var/www/html/
RUN mkdir -p /var/www/html/pics
RUN chown www-data:www-data /var/www/html/pics
RUN chmod 775 /var/www/html/pics