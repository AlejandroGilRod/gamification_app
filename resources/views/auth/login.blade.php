<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 px-4">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 rounded-2xl shadow-2xl  text-sm">

            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-yellow-400 mb-2">🎯 Iniciar sesión en GameTask</h2>
                <p class="text-gray-300">Completa misiones, gana experiencia y sube de nivel.</p>
            </div>

            <img src="{{ asset('images/AnimacionCaminar.gif') }}" alt="Imagen RPG" class="w-32 mx-auto mb-6 rounded-xl shadow-md">

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block mb-1 text-white">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="block px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-yellow-400 focus:ring-yellow-400  w-full" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block mb-1 text-white">Contraseña</label>
                    <input id="password" type="password" name="password" required
                           class="block px-3 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-yellow-400 focus:ring-yellow-400  w-full" />
                </div>

                <div class="flex items-center mt-4">
                    <input type="checkbox" name="remember" id="remember_me"
                           class="rounded border-gray-600 text-yellow-500 shadow-sm focus:ring-yellow-400" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-300">Recuérdame</label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-400 hover:underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-2 px-4 rounded-lg shadow">
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
