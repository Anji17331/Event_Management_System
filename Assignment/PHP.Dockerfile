FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    ssmtp \
    build-essential \
    autoconf \
    pkg-config \
    re2c \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql zip \
    && docker-php-ext-enable mysqli

# Install and enable Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configure SSMTP for Maildev
RUN echo "root=mailer@v.je" > /etc/ssmtp/ssmtp.conf \
    && echo "mailhub=maildev:1025" >> /etc/ssmtp/ssmtp.conf \
    && echo "hostname=localhost" >> /etc/ssmtp/ssmtp.conf \
    && echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf

# PHP configuration overrides
RUN echo "post_max_size=5000M" > /usr/local/etc/php/conf.d/php-uploadsize.ini \
    && echo "upload_max_filesize=5000M" >> /usr/local/etc/php/conf.d/php-uploadsize.ini \
    && echo "short_open_tag=Off" > /usr/local/etc/php/conf.d/opentags.ini

# Set working directory
WORKDIR /websites

# Expose the FPM port (not needed for Docker DNS, but for clarity)
EXPOSE 9000

CMD ["php-fpm"]
