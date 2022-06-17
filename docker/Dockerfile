FROM composer as composer
COPY . /app
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:7.1.33-fpm

ARG user
ARG uuid

# install system dependecies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# install PHP extentions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uuid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# set working directory
WORKDIR /var/www

COPY --from=composer /app /var/www

USER $user