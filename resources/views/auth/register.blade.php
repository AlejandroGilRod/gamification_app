<x-guest-layout>
        <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/images/Icono2.png">

    <div class="min-h-screen flex items-center justify-center bg-gray-900  px-4">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 rounded-2xl shadow-2xl  text-sm">
            
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-purple-600 mb-2">🎮 Únete a GameTask</h2>
                <p class="text-gray-300">Gamifica tu productividad. ¡Sube de nivel completando tus tareas!</p>
            </div>

            <img src="{{ asset('images/Recepcionista.png') }}" alt="Imagen RPG" class="h-20 w-auto mx-auto mb-6 rounded-xl shadow-md">

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block mb-1 text-white">Nombre</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="block w-full px-3 py-2 text-white rounded-md bg-gray-700 border border-gray-600 focus:border-purple-600 focus:ring-purple-600 " />
                </div>

                <div class="mt-4">
                    <label for="email" class="block mb-1 text-white">Correo</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="block w-full px-3 py-2 text-white rounded-md bg-gray-700 border border-gray-600 focus:border-purple-600 focus:ring-purple-600 " />
                </div>

                <div class="mt-4">
                    <label for="password" class="block mb-1 text-white">Contraseña</label>
                    <input id="password" type="password" name="password" required
                           class="block w-full px-3 py-2 text-white rounded-md bg-gray-700 border border-gray-600 focus:border-purple-600 focus:ring-purple-600 text-white" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block mb-1 text-white">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="block w-full px-3 py-2 text-white rounded-md bg-gray-700 border border-gray-600 focus:border-purple-600 focus:ring-purple-600 text-white" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-gray-400 hover:underline">
                        ¿Ya tienes cuenta?
                    </a>
                    <button type="submit"
                            class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
