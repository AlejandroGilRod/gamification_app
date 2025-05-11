FROM node:18 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install
COPY resources resources
COPY tailwind.config.js vite.config.js ./
RUN npm run build


FROM php:8.3-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    sqlite3 \
    libzip-dev \
    zip \
    curl

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_sqlite zip

WORKDIR /var/www

COPY . .

# Instalar dependencias PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copiar archivos frontend generados
COPY --from=frontend /app/public/build public/build

# Dar permisos
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
