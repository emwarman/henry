FROM php:8.3-apache

COPY index.php /var/www/html/index.php

RUN mkdir -p /data && chown www-data:www-data /data

ENV DATA_FILE=/data/messages.csv

EXPOSE 80
