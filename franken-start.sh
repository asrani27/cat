#!/bin/bash
/usr/bin/php artisan octane:frankenphp --workers=$(nproc) > /dev/null &
echo "Service berjalan..."
