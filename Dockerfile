# Use PHP 8.2 with FPM
FROM php:8.2-fpm

# Install necessary dependencies for Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_pgsql

# Set up the working directory inside the container
COPY . /var/www/html
WORKDIR /var/www/html

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Start PHP-FPM process
CMD ["php-fpm"]
