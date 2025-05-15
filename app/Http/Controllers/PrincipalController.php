<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PrincipalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        foreach ($user->tasks as $task) {
            if ($task->repeat === 'none') continue;

            $lastReset = $task->last_reset_at ?? $task->created_at;

            $shouldReset = match ($task->repeat) {
                'daily' => now()->diffInDays($lastReset) >= 1,
                'weekly' => now()->diffInWeeks($lastReset) >= 1,
                'monthly' => now()->diffInMonths($lastReset) >= 1,
                default => false,
            };

            if ($shouldReset) {
                if (!$task->completed) {
                    $damage = intval($task->experience / 2);
                    $user->health = max(0, $user->health - $damage);
                    $user->save();
                }

                $task->update([
                    'completed' => false,
                    'last_reset_at' => now(),
                ]);
            }
        }

        return view('principal');
    }
}
