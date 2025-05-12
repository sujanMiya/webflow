FROM php:8.3-fpm-alpine

WORKDIR /var/www

# Install system dependencies
RUN apk update && apk add \
    build-base \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql bcmath pcntl zip

COPY --chown=www:www . /var/www/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create non-root user
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

# Copy composer files first to leverage Docker cache
# COPY --chown=www:www composer.json composer.lock* /var/www/

# Install dependencies (as root first to allow writing to vendor directory)
# RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy the rest of the application
COPY --chown=www:www . /var/www/

# Set permissions
RUN chown -R www:www /var/www

# Switch to non-root user
USER www

EXPOSE 9000
CMD ["php-fpm"]