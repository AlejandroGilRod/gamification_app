<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" type="image/x-icon" href="/images/Icono2.png">

    <meta charset="UTF-8">
    <title>GameTask</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center h-screen">

    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">🎮 Bienvenido a <span class="text-purple-600">GameTask</span></h1>
        <p class="mb-6 text-lg">¡Gamifica tus tareas y sube de nivel!</p>
        <img src="{{ asset('images/iniciorpg.gif') }}" alt="RPG" class="mx-auto w-120 rounded-xl shadow-lg">

        <div class="mt-6">
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded mr-4">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">Registrarse</a>
        </div>
    </div>

</body>

</html>