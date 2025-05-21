<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstadisticasController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $equipamiento = $user->items; // obtener todos los objetos del usuario

        return view('estadisticas', compact('equipamiento'));
    }
}
