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
            if ($task->completed && $task->repeat !== 'none' && $task->last_reset_at) {
                $lastReset = Carbon::parse($task->last_reset_at);

                $shouldReset = match ($task->repeat) {
                    'daily' => $lastReset->diffInDays($now) >= 1,
                    'weekly' => $lastReset->diffInWeeks($now) >= 1,
                    'monthly' => $lastReset->diffInMonths($now) >= 1,
                    default => false,
                };

                if ($shouldReset) {
                    // 🔻 Calcular daño
                    $dañoBase = match ($task->experience) {
                        10 => 5,
                        25 => 12,
                        50 => 25,
                        100 => 50,
                        default => 0,
                    };

                    $dañoFinal = max(0, $dañoBase - $user->defensa);
                    $user->health = max(0, $user->health - $dañoFinal);

                    $task->update([
                        'completed' => false,
                        'last_reset_at' => null,
                    ]);
                }
            }
        }

        $user->save(); // ✅ Guardar vida después de aplicar daño
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
