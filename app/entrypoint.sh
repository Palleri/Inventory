#!/bin/sh
trap "exit" SIGINT
trap "exit" SIGTERM


echo "# Starting Inventory system #"

cp /app/php.ini /etc/php7/php.ini
mkdir -p /run/lighttpd/
chown www-data:www-data /run/lighttpd/
cp /app/src/* /var/www/
cp /app/bin/notify.sh
cp /app/bin/root /etc/crontabs/root
chmod +x /etc/crontabs/root
chmod +x /app/bin/notify.sh



chown -R www-data:www-data /var/www/*
php-fpm7 -D

crond

exec lighttpd -D -f /etc/lighttpd/lighttpd.conf