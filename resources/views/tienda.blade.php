<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/images/Icono2.png">
</head>

<body class="bg-gray-900 text-white min-h-screen px-6 py-12">


    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-bold text-purple-500 mb-8 text-center">🛒 Tienda de objetos</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($items as $item)
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg flex flex-col items-center text-center">
                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-32 h-32 object-contain mb-4 rounded">
                <h3 class="text-xl font-bold text-purple-500 mb-2">{{ $item->name }}</h3>
                <p class="text-gray-300 mb-2">{{ $item->description }}</p>
                <p class="text-green-400 font-semibold mb-4">💰 {{ $item->price }} oro</p>
                @if(in_array($item->id, $userItems))
                <button class="bg-gray-500 text-white font-bold px-4 py-2 rounded shadow opacity-50 cursor-not-allowed" disabled>
                    Adquirido
                </button>
                @else
                <form action="{{ route('shop.comprar', $item->id) }}" method="POST">
                    @csrf
                    <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold px-4 py-2 rounded shadow transition">
                        Comprar
                    </button>
                </form>
                @endif


            </div>
            @empty
            <p class="col-span-full text-center text-gray-400">No hay objetos disponibles en la tienda.</p>
            @endforelse
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('dashboard') }}" class="bg-purple-600 text-white px-4 py-2 rounded shadow hover:bg-purple-700">
                Volver
            </a>
        </div>
    </div>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(session('success'))
        toastr.success("{{ addslashes(session('success')) }}");
        @endif

        @if(session('error'))
        toastr.error("{{ addslashes(session('error')) }}");
        @endif
    </script>

</body>

</html>