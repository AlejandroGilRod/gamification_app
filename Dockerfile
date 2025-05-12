FROM node:18 AS frontend

WORKDIR /app

# Instala dependencias de JS
COPY package*.json ./
RUN npm install

# Copia recursos necesarios para Vite
COPY public public
COPY resources resources
COPY tailwind.config.js vite.config.js ./

# Compila los assets
RUN npm run build


FROM php:8.3-cli

# Instala dependencias del sistema necesarias para PHP y SQLite
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    sqlite3 \
    libzip-dev \
    libsqlite3-dev \
    zip \
    curl \
    pkg-config

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_sqlite zip

# Define directorio de trabajo en el contenedor
WORKDIR /var/www

# Copia todo el proyecto
COPY . .

# Instala dependencias PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copia los assets compilados desde la fase frontend
COPY --from=frontend /app/public/build public/build

# Permisos necesarios para que Laravel funcione correctamente
RUN chmod -R 777 storage bootstrap/cache

# Expone el puerto 8000 para acceder a la app
EXPOSE 8000

# Comando por defecto: iniciar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
