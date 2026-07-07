FROM php:8.3-fpm

# Instala dependências de sistema necessárias para compilar extensões PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    default-mysql-client

# Instala as extensões PHP que o Laravel precisa
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Instala o Node.js 24 LTS (via NodeSource) para compilar assets do Laravel (Tailwind/Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_24.x | bash - \
    && apt-get install -y nodejs

# Instala o Composer dentro da imagem (copiando da imagem oficial do Composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define a pasta de trabalho dentro do container
WORKDIR /var/www

# Copia todo o código da aplicação para dentro do container
COPY . /var/www

# Ajusta permissões das pastas que o Laravel precisa escrever (cache, logs, sessions)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true

EXPOSE 9000
CMD ["php-fpm"]
