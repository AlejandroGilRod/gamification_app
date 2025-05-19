<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('tasks');
        $now = now();

        foreach ($user->tasks as $task) {
            if ($task->repeat !== 'none') {
                $lastReset = $task->last_reset_at ?? $task->created_at;

                $shouldReset = match ($task->repeat) {
                    'daily' => Carbon::parse($lastReset)->diffInDays($now) >= 1,
                    'weekly' => Carbon::parse($lastReset)->diffInWeeks($now) >= 1,
                    'monthly' => Carbon::parse($lastReset)->diffInMonths($now) >= 1,
                    default => false,
                };

                if ($shouldReset) {
                    // Si la tarea NO está completada, aplica daño
                    if (!$task->completed) {
                        $dañoBase = match ($task->experience) {
                            10 => 5,
                            25 => 12,
                            50 => 25,
                            100 => 50,
                            default => 0,
                        };
                        $dañoFinal = max(0, $dañoBase - $user->defensa);
                        $user->health = max(0, $user->health - $dañoFinal);
                    }

                    // En todos los casos se resetea la tarea
                    $task->update([
                        'completed' => false,
                        'last_reset_at' => $now,
                    ]);
                }
            }
        }

        $user->save();
        return redirect('/principal');
    }


    public function assignAttribute(Request $request)
    {
        $user = auth()->user();
        $attribute = $request->input('attribute');

        if ($user->attribute_points <= 0 || !in_array($attribute, ['fuerza', 'defensa', 'inteligencia'])) {
            return back()->with('error', 'No puedes asignar ese punto.');
        }

        if ($attribute === 'fuerza') {
            $user->fuerza += 1;
            $user->health += 1;
        } elseif ($attribute === 'defensa') {
            $user->defensa += 1;
        } elseif ($attribute === 'inteligencia') {
            $user->inteligencia += 1;
        }

        $user->attribute_points -= 1;
        $user->save();

        $user->save();

        return back()->with('success', '¡Has mejorado tu ' . $attribute . '!');
    }
    
}
