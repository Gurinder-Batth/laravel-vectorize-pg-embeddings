FROM php:8.2.1-apache-buster

# Set working directory
WORKDIR /var/www/html

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    zip \
    curl \
    unzip \
    gnupg \
    libpq-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mysqli zip pdo_pgsql pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Enable Apache mod_rewrite and SSL modules
RUN a2enmod rewrite ssl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Install Docker 20.10 (which includes the `docker compose` command)
RUN curl -fsSL https://get.docker.com | sh

# Restart Docker service after installation
RUN systemctl enable docker

RUN usermod -aG docker www-data

# Create directories for phpMyAdmin
RUN mkdir -p /var/www/phpMyAdmin/bash /var/www/phpMyAdmin/src && \
    touch /var/www/phpMyAdmin/bash/bash.sh

# Generate self-signed SSL certificate
RUN mkdir -p /etc/apache2/ssl && \
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/server.key \
    -out /etc/apache2/ssl/server.crt \
    -subj "/C=US/ST=State/L=City/O=Company/OU=Department/CN=localhost"

RUN echo 'memory_limit = 2G' > /usr/local/etc/php/conf.d/docker-php-memory-limit.ini
RUN echo 'post_max_size = 2G' >> /usr/local/etc/php/conf.d/docker-php-post-max-size.ini
RUN echo 'upload_max_filesize = 2G' >> /usr/local/etc/php/conf.d/docker-php-upload-max-filesize.ini

# Expose ports
EXPOSE 80 443 5173

# Define the default command to run
CMD ["apache2-foreground"]
