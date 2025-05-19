<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstadisticasController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('items');
        $equipamiento = $user->items->where('type', 'equipamiento');

        return view('estadisticas', compact('equipamiento'));
    }
}
