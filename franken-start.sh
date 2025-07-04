#!/bin/bash
/usr/bin/php artisan octane:frankenphp --caddyfile Caddyfile --workers 5 --max-requests 1000 > /dev/null &
echo "Service berjalan..."
