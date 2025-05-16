<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PrincipalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

       $user = Auth::user()->load('tasks');

return view('principal', compact('user'));


    }
}
