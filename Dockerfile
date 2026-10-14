FROM php:8.3-apache

RUN a2dismod mpm_event mpm_worker 2>/dev/null; a2enmod mpm_prefork

COPY index.php /var/www/html/index.php

RUN mkdir -p /data && chown www-data:www-data /data

ENV DATA_FILE=/data/messages.csv

EXPOSE 80
