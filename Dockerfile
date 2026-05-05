FROM php:8.2-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set permissions for uploads directory
RUN mkdir -p public/uploads && chmod -R 777 public/uploads

# Expose port 80
EXPOSE 80
