#!/bin/sh
set -e

mkdir -p /var/www/html/storage/api-docs
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

exec "$@"