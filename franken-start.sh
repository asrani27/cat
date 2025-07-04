#!/bin/bash
/usr/bin/php artisan octane:frankenphp --caddyfile Caddyfile --max-requests 0 > /dev/null &
echo "Service berjalan..."
