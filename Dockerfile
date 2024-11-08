FROM php:8.2-cli
COPY . /usr/src/adventcalendar
WORKDIR /usr/src/adventcalendar
CMD [ "php", "./your-script.php" ]
