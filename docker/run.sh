#!/bin/sh
php /var/www/html/artisan cache:clear

/usr/bin/supervisord -c /etc/supervisord.conf
