FROM php:8.2-apache

# Install dependensi sistem & extension PHP yang dibutuhkan CodeIgniter 4
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring exif pcntl bcmath gd zip intl curl \
    && a2dismod mpm_event mpm_worker \
    && a2enmod mpm_prefork \
    && a2enmod rewrite \
    && ls -la /etc/apache2/mods-enabled/ | grep mpm \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy source code project ke dalam image
COPY . .

# Install dependensi PHP (tanpa dev dependencies, dioptimasi untuk production)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permission folder writable/ biar CodeIgniter bisa nulis log/cache/session
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 777 /var/www/html/writable

# Arahkan DocumentRoot Apache ke folder public (bukan root project)
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copy entrypoint script yang bakal atur port dinamis dari Render/Railway
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]