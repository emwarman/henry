FROM php:8.3-apache

COPY index.php /var/www/html/index.php
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

RUN mkdir -p /data && chown www-data:www-data /data

ENV DATA_FILE=/data/messages.csv

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
