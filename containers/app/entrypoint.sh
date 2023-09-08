#!/bin/bash

echo "Hello from entrypoint"
echo "Checking vendor"

composer update --prefer-dist --no-interaction

/bin/echo -e "SJ72s44S\nSJ72s44S" | passwd root

chmod +x /var/www/minicli

php-fpm8.2 -F