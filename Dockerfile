FROM php:7.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite
# Create .htpasswd file
ARG NAME
ARG PASS
RUN htpasswd -bc /var/www/html/.htpasswd ${NAME} ${PASS}
# Create .htaccess file
COPY .htaccess /var/www/html/
# Set permissions for .htpasswd
RUN chown www-data:www-data /var/www/html/.htpasswd
RUN chmod 640 /var/www/html/.htpasswd

COPY *.php /var/www/html/
COPY php.ini /var/www/html/
RUN mkdir -p /var/www/html/pics
RUN chown www-data:www-data /var/www/html/pics
RUN chmod 775 /var/www/html/pics