#!/bin/sh
php artisan down
# update source code
git pull
# update PHP dependencies
composer update --no-interaction --no-dev --prefer-dist
php artisan up