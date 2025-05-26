# GameTask 🎮📋

GameTask es una aplicación web de **gestión de tareas gamificada**. Está inspirada en los videojuegos RPG y permite a los usuarios convertir su rutina diaria en misiones, ganar experiencia, oro y mejorar atributos de personaje como fuerza, defensa o inteligencia. Su objetivo es combatir la procrastinación y fomentar la constancia mediante una experiencia visualmente atractiva y motivadora.

## 🛠 Tecnologías utilizadas

- **Backend**: Laravel 10+
- **Frontend**: Blade, TailwindCSS, Alpine.js
- **Build tools**: Vite
- **Base de datos**: SQLite
- **Contenedores**: Docker + Docker Compose
- **Autenticación**: Laravel Fortify + Jetstream
- **Notificaciones**: SweetAlert2, Toastr

## ⚙️ Requisitos previos

Asegúrate de tener instalado:

- Docker
- Docker Compose
- (Opcional para entorno local) PHP 8.1+, Composer, Node.js, NPM

## 🚀 Instalación y ejecución con Docker

1. Clona el repositorio o descomprime el proyecto:

   ```bash
   git clone <url_del_repositorio>
   cd gamification_app

    Copia el archivo de entorno y modifica si es necesario:

cp .env.example .env

Crea los contenedores y levanta el proyecto:

docker-compose up --build

Accede a la aplicación en tu navegador:

    http://localhost

🧪 Uso en entorno local (sin Docker)

    Instala dependencias de PHP y JS:

composer install
npm install

Copia el entorno y genera la clave de app:

cp .env.example .env
php artisan key:generate

Ejecuta migraciones:

php artisan migrate

Inicia el servidor de desarrollo y compilación:

    php artisan serve
    npm run dev

    Visita http://127.0.0.1:8000 en tu navegador.

📦 Estructura del proyecto

    app/Http/Controllers: Lógica del sistema (tareas, tienda, estadísticas…)

    resources/views: Plantillas Blade

    routes/web.php: Rutas principales

    database/migrations: Tablas y estructura de base de datos

    public/images: Avatares, iconos y elementos RPG

    docker-compose.yml y Dockerfile: Configuración de contenedores

📈 Funcionalidades destacadas

    Gestión de tareas con repetición y dificultad

    Recompensas en forma de XP, oro y subida de nivel

    Penalizaciones automáticas por no cumplir tareas

    Tienda de objetos que modifican atributos

    Estadísticas visuales del personaje

📌 Notas

    La base de datos por defecto es SQLite, para facilidad de uso en desarrollo.

    Puedes usar php artisan migrate:fresh --seed para reiniciar la base de datos con datos iniciales.

    Si usas Windows, asegúrate de configurar correctamente el entorno .env para que Docker y Laravel funcionen sin conflictos.

¡Gracias por probar GameTask! 💪
