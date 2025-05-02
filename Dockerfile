FROM php:8.4-fpm-alpine3.21

WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy PHP-FPM configuration
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Copy composer files first for better layer caching
COPY composer.json .
RUN composer install

# Copy application files
COPY . .

# Change ownership
RUN chown -R www-data:www-data /var/www/html