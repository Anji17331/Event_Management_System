FROM php:8.2-cli

# Install system packages
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory
WORKDIR /websites/default/public

# Start PHP built-in server on container start
CMD ["php", "-S", "0.0.0.0:8000"]
