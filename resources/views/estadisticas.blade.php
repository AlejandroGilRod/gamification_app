<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Estadísticas</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/images/Icono2.png">

</head>

<body class="bg-gray-900 text-white min-h-screen px-6 py-12">
    <div class="max-w-3xl mx-auto bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6 text-yellow-400 text-center">📊 Tus estadísticas</h2>

        <ul class="space-y-4 text-lg">
            <li>👤 Nombre: <strong>{{ Auth::user()->name }}</strong></li>
            <li>🎚 Nivel: <strong>{{ Auth::user()->level }}</strong></li>
            <li>⚡ XP actual: <strong>{{ Auth::user()->experience }}/100</strong></li>
            <li>💪 Fuerza: <strong>{{ Auth::user()->fuerza }}</strong></li>
            <li>🛡️ Defensa: <strong>{{ Auth::user()->defensa }}</strong></li>
            <li>🧠 Inteligencia: <strong>{{ Auth::user()->inteligencia }}</strong></li>
            <li>🎯 Puntos sin asignar: <strong>{{ Auth::user()->attribute_points }}</strong></li>
        </ul>

        <div class="text-center mt-8">
            <a href="{{ route('dashboard') }}"
                class="bg-yellow-500 text-gray-900 px-4 py-2 rounded shadow hover:bg-yellow-600">
                Volver
            </a>
        </div>
    </div>
</body>

</html>