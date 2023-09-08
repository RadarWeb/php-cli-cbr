FROM phpdockerio/php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    vim  \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    php8.2-mbstring \
    php8.2-exif \
    php8.2-gd; \
	apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /run/php

WORKDIR /var/www

COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
