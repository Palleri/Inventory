#!/bin/sh
trap "exit" SIGINT
trap "exit" SIGTERM


echo "# Starting Inventory system #"

cp /app/php.ini /etc/php7/php.ini
mkdir -p /run/lighttpd/
chown www-data:www-data /run/lighttpd/
cp /app/src/* /var/www/

chown -R www-data:www-data /var/www/*
php-fpm7 -D


exec lighttpd -D -f /etc/lighttpd/lighttpd.conf