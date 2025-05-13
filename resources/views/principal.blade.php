<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>GameTask</title>
    @vite('resources/css/app.css')
    <!-- Toastr CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900">

    <div class="flex justify-between items-center px-6 pt-6">
        <div class="flex items-center space-x-4">
            <<div class="relative" x-data="{ showMenu: false }">
                <button @click="showMenu = !showMenu" class="focus:outline-none">
                    @php
                    $avatarIndex = min(4, floor(Auth::user()->level / 20) + 1);
                    @endphp
                    <img src="{{ asset("images/avatar$avatarIndex.png") }}" alt="Avatar"
                        class="h-auto rounded-full shadow" style="width: 5vw;">
                </button>

                <div x-show="showMenu"
                    @click.outside="showMenu = false"
                    x-transition
                    class="absolute mt-2 right-0 w-40 bg-white text-gray-800 rounded shadow-lg z-50">

                    <form method="POST" action="{{ route('logout') }}" class="text-left">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
        </div>

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

    <div class="py-12 min-h-screen px-6 max-w-4xl mx-auto" x-data="{ open: false }">
        <!-- Botón -->
        <div class="flex justify-end mt-4">
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

        <!-- Modal -->
        <div x-show="open" x-transition.opacity x-transition.scale
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div @click.outside="open = false"
                class="w-full max-w-xl bg-gray-800 border border-gray-700 p-6 rounded-xl shadow-xl">
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

        <!-- Lista de tareas -->
        <h3 class="text-xl font-bold text-yellow-400 mb-4 text-center mt-10">📋 Misiones disponibles</h3>
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



    <!-- SweetAlert para eliminar -->
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
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(session('task_created'))
        toastr.success("{{ addslashes(session('task_created')) }}");
        @endif

        @if(session('task_deleted'))
        toastr.error("{{ addslashes(session('task_deleted')) }}");
        @endif
    </script>
</body>

</html>