FROM dunglas/frankenphp

# Be sure to replace "your-domain-name.example.com" by your domain name
#ENV SERVER_NAME=cat-1.banjarmasinkota.go.id
# If you want to disable HTTPS, use this value instead:
#ENV SERVER_NAME=:80

# Enable PHP production settings
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN install-php-extensions \
        pdo_mysql \
        pcntl \
        gd \
        intl \
        zip \
        opcache

# Copy the PHP files of your project in the public directory
#COPY . /app/public
# If you use Symfony or Laravel, you need to copy the whole project instead:
COPY . /app

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host", "cat-1.banjarmasinkota.go.id", "--port", "80", "--caddyfile", "Caddyfile"]
