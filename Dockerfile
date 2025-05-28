FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing app
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port (if needed)
EXPOSE 8080

# Command to run app (adjust if using a server like nginx or php -S)
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
