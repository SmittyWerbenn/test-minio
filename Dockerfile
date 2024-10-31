# Gunakan image PHP dengan ekstensi yang diperlukan
FROM php:8.1-cli

# Instal dependencies yang diperlukan
RUN apt-get update && apt-get install -y \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Buat direktori aplikasi
WORKDIR /var/www/html

# Salin file aplikasi ke dalam container
COPY . /var/www/html

# Install dependensi aplikasi dengan Composer
RUN composer install

# Perintah default saat container berjalan
CMD ["php", "minio_example.php"]
