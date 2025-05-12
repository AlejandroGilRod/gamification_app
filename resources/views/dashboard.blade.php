<x-app-layout>

<div class="flex justify-between items-center bg-gray-900">
          

            <div class="flex items-center space-x-4">
                <!-- Imagen tipo avatar -->
                <img src="{{ asset('images/avatar1.png') }}" alt="Avatar"
                    class="h-auto rounded-full shadow" style="width: 5vw;">


                <!-- Nombre de usuario -->
                <div class="text-right">
                    <div class="text-sm text-white font-semibold">
                        {{ Auth::user()->name }}
                    </div>

                    <!-- Barra de experiencia -->
                    <div class="w-40 bg-gray-700 rounded-full mt-1 h-2">
                        <div class="bg-yellow-400 h-2 rounded-full"
                             style="width: 65%;"></div> {{-- ← cambia el 65% por tu XP --}}
                    </div>
                </div>
            </div>
        </div>
    <div class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Lista de tareas -->
            <h3 class="text-xl font-bold text-yellow-400 mb-4 text-center">📋 Misiones disponibles</h3>

            <div class="space-y-4">
                <!-- Ejemplo de tarea -->
                <div class="bg-gray-800 border border-gray-700 p-4 rounded-xl shadow flex justify-between items-center">
                    <div>
                        <div class="font-semibold text-white">✔️ Limpiar base de datos</div>
                        <div class="text-sm text-gray-400">Gana 50 XP por completar esta tarea</div>
                    </div>
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-4 py-1 rounded shadow">
                        Completar
                    </button>
                </div>

                <!-- Puedes repetir más bloques de tareas aquí -->
            </div>
        </div>
    </div>
</x-app-layout>
