FROM php:8.2-fpm

# Define work directory
WORKDIR /var/www

# Install php extensions
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libjpeg-dev \
    zip \
    unzip \
    git \
    curl \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql gd

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www

# Set correct permissions before switching users
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www

# Switch to www-data and install dependencies
USER www-data
RUN composer install --no-dev --optimize-autoloader

# Ensuring storae and cache exist and set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy supirvisor configuration file
COPY ./supervisor/worker.conf /etc/supervisor/conf.d/worker.conf

# Expose port
EXPOSE 9000

CMD ["php-fpm", "-F"]
