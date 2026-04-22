FROM php:8.2-apache

# Update packages and install dependencies for PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install and enable required PHP extensions for PostgreSQL (Supabase)
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache mod_rewrite for nice URLs if needed
RUN a2enmod rewrite

# Copy the entire project to the Apache document root
COPY . /var/www/html/

# Update permissions so Apache can serve and read the files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 for web traffic
EXPOSE 80
