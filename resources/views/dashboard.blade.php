        <x-app-layout>
            <div class="flex justify-between items-center bg-gray-900 px-6 pt-6">
                <div class="flex items-center space-x-4">
                    <!-- Imagen tipo avatar -->
                    <img src="{{ asset('images/avatar1.png') }}" alt="Avatar"
                        class="h-auto rounded-full shadow" style="width: 5vw;">

                    <!-- Nombre de usuario y barra de experiencia -->
                    <div class="text-right">
                        <div class="text-sm text-white font-semibold">
                            {{ Auth::user()->name }} (Nivel {{ Auth::user()->level }})
                        </div>
                        @php
                        $xp = Auth::user()->experience;
                        $percent = min(100, ($xp % 100));
                        @endphp
                        <div class="w-40 bg-gray-700 rounded-full mt-1 h-2">
                            <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $percent }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12 bg-gray-900 min-h-screen ">
                <div class="max-w-4xl mx-auto px-6">

                    <!-- Feedback -->


                    <div x-data="{ open: false }" class="relative">
                        <!-- Botón + centrado arriba -->
                        <div x-data="{ open: false }" class="relative z-50">

                            <!-- Botón flotante arriba a la derecha -->
                            <div class="w-full flex justify-end mt-4 pr-6">
                                <button @click="open = !open"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 text-3xl w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition"
                                    title="Crear tarea">
                                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>

                                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Formulario centrado flotante -->
                            <!-- Formulario modal centrado en pantalla -->
                            <div x-show="open"
                                x-transition.opacity
                                x-transition.scale
                                class="fixed inset-0 flex items-center justify-center z-50">

                                <div @click.outside="open = false"
                                    class="w-full max-w-xl bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-xl ">

                                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                                        @csrf
                                        <h3 class="text-yellow-400 font-bold text-xl text-center">📝 Crear nueva misión</h3>

                                        <input type="text" name="title" placeholder="Nombre de la tarea" required
                                            class="w-full bg-gray-700 px-3 py-2 rounded-md border border-gray-600 focus:ring-2 focus:ring-yellow-400">

                                        <input type="number" name="experience" placeholder="XP" required min="1"
                                            class="w-full bg-gray-700 px-3 py-2 rounded-md border border-gray-600 focus:ring-2 focus:ring-yellow-400">

                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-4 py-2 rounded shadow">
                                                Crear tarea
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>


                        <!-- Lista de tareas -->
                        <h3 class="text-xl font-bold text-yellow-400 mb-4 text-center">📋 Misiones disponibles</h3>

                        <div class="space-y-4">
                            @forelse(Auth::user()->tasks as $task)
                            <div class="bg-gray-800 border border-gray-700 p-4 rounded-xl shadow flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-white">{{ $task->title }}</div>
                                    <div class="text-sm text-gray-400">Otorga {{ $task->experience }} XP</div>
                                </div>

                                <div class="flex space-x-2">
                                    @if(!$task->completed)
                                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-4 py-1 rounded shadow">
                                            Completar
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-green-400 font-semibold self-center">✔ Completada</span>
                                    @endif

                                    <form method="POST"
                                        action="{{ route('tasks.destroy', $task->id) }}"
                                        class="delete-task-form"
                                        data-title="{{ $task->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-1 rounded shadow">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </div>

                            @empty
                            <div class="text-center text-gray-400">No tienes tareas creadas.</div>
                            @endforelse

                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const deleteForms = document.querySelectorAll('.delete-task-form');

                        deleteForms.forEach(form => {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault();

                                const taskName = form.getAttribute('data-title') || 'esta tarea';

                                Swal.fire({
                                    title: '¿Eliminar tarea?',
                                    text: `¿Estás seguro de que quieres eliminar "${taskName}"?`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                });
                            });
                        });
                    });
                </script>
              


        </x-app-layout>