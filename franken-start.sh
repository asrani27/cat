#!/bin/bash
/usr/local/bin/frankenphp artisan octane:frankenphp --caddyfile Caddyfile  --max-requests 0 > /dev/null &
echo "Service berjalan..."
