#!/bin/bash
MYSQL_HOST=emdad_db
MYSQL_USER=root
MYSQL_PASS=control@123

cd app/

# Edit .env file
sed -i "/DB_HOST=.*/c\DB_HOST=${MYSQL_HOST}" .env
sed -i "/DB_USERNAME=.*/c\DB_USERNAME=${MYSQL_USER}" .env
sed -i "/DB_PASSWORD=.*/c\DB_PASSWORD=${MYSQL_PASS}" .env


# Install PHP modules
if [ ! -d "vendor" ]; then
composer update
fi

chown -R nobody. ../emdad-backend

if [ -d "vendor" ]; then
#        if [ -f "Done.txt" ]; then
#                php artisan optimize
#                php artisan view:cache
#        else
#                php artisan migrate
#                php artisan l5-swagger:generate
#                php artisan optimize
#                php artisan view:cache
#                touch Done.txt
#        fi
        if [ ! -f "Done.txt" ]; then
                php artisan migrate
                php artisan l5-swagger:generate
                touch Done.txt
        fi
        rm -f  public/storage
        php artisan storage:link
        php artisan optimize
        php artisan view:cache
        php artisan storage:link
        php artisan queue:work &
fi

exec supervisord -c /etc/supervisord.conf
