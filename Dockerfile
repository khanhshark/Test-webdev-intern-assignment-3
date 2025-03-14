# Sử dụng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài đặt các extension PHP cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip mysqli

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Sao chép mã nguồn Laravel vào container
WORKDIR /var/www/html
COPY . .

# Cài đặt dependencies của Laravel
RUN composer install --no-dev --optimize-autoloader

# Cấp quyền cho storage và bootstrap/cache (có thể cần điều chỉnh quyền)
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Bật mod_rewrite trong Apache để hỗ trợ Laravel routes
RUN a2enmod rewrite

# Cấu hình Apache cho Laravel (đảm bảo DocumentRoot trỏ vào thư mục public)
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Expose port
EXPOSE 80

# Lệnh khởi động Apache khi container chạy
CMD ["apache2-foreground"]
