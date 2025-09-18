FROM node:latest AS node
FROM php:8.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Set document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable rewrite module
RUN a2enmod rewrite

# Install nodejs
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
RUN npm install -g npx

ARG USER=dev

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libmagickwand-dev \
    libxslt-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install image transformation libraries
RUN apt install -y libpng-dev \
    libjpeg-dev \
	libjpeg62-turbo-dev

# Install PHP extensions
RUN docker-php-ext-install xsl intl mysqli pdo pdo_mysql mbstring exif pcntl bcmath gd zip soap
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install -j$(nproc) gd

# Install imagick extension
ARG IMAGICK_VERSION=3.8.0
RUN curl -L -o /tmp/imagick.tar.gz https://github.com/Imagick/imagick/archive/refs/tags/${IMAGICK_VERSION}.tar.gz \
    && tar --strip-components=1 -xf /tmp/imagick.tar.gz \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && echo "extension=imagick.so" > /usr/local/etc/php/conf.d/ext-imagick.ini \
    && rm -rf /tmp/*

# Install xdebug
RUN pecl install xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -d /home/$USER $USER
RUN mkdir -p /home/$USER/.composer && \
    chown -R $USER:$USER /home/$USER

# Add scripts directory
COPY .docker/php/scripts /home/$USER/scripts
RUN mkdir /usr/local/etc/php/disabled
RUN chmod -R 777 /usr/local/etc/php
# Override files
COPY .docker/php/files/usr/local/etc/php/disabled/docker-php-ext-xdebug.ini /usr/local/etc/php/disabled/docker-php-ext-xdebug.ini

WORKDIR /var/www
