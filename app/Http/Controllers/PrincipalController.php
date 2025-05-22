<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    public function index(Request $request)
    {
        $showCompleted = $request->query('show_completed') === 'true';

        $user = Auth::user();

        $repeatFilter = $request->query('repeat');

        $validRepeats = ['none', 'daily', 'weekly', 'monthly'];
        if ($user->health <= 0) {
            $user->level = max(1, $user->level - 5);
            $user->health = 100 + ($user->fuerza ?? 0);
            session()->flash('you_died', true);
        }

        $user->save();

        $incompleteTasksQuery = $user->tasks()->where('completed', false);
        $completedTasksQuery = $user->tasks()->where('completed', true);

        if (in_array($repeatFilter, $validRepeats)) {
            $incompleteTasksQuery->where('repeat', $repeatFilter);
            $completedTasksQuery->where('repeat', $repeatFilter);
        }

        $incompleteTasks = $incompleteTasksQuery->orderByDesc('created_at')->paginate(5, ['*'], 'incomplete_page');
        $completedTasks = $completedTasksQuery->orderByDesc('created_at')->paginate(5, ['*'], 'completed_page');

        return view('principal', compact('user', 'incompleteTasks', 'completedTasks', 'repeatFilter', 'showCompleted'));
    }
}
