<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:10,25,50,100',
            'repeat' => 'required|in:none,daily,weekly,monthly',

        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'experience' => (int) $request->difficulty,
            'repeat' => $request->repeat,

        ]);

        return back()->with('task_created', 'Tarea creada correctamente.');
    }
 public function complete(Task $task)
{
    if ($task->user_id !== auth()->id() || $task->completed) {
        abort(403); // Evita que otro usuario complete tu tarea o se repita
    }

    $user = auth()->user();
    $task->completed = true;

    if ($task->repeat !== 'none') {
        $task->last_reset_at = now();
    }

    $task->save();

    // Añadir experiencia y subir nivel
    $xpAntes = $user->experience;
$xpGanada = $task->experience + $user->inteligencia;

    $nuevaXP = $xpAntes + $xpGanada;
    $nivelesGanados = intdiv($nuevaXP, 100);
    $xpRestante = $nuevaXP % 100;

    $user->update([
        'experience' => $xpRestante,
        'level' => $user->level + $nivelesGanados,
        'attribute_points' => $user->attribute_points + $nivelesGanados,
    ]);

    // 🔁 Refrescar los datos de sesión
    auth()->user()->refresh();

    return back()->with('success', '¡Has completado una tarea y ganado experiencia!');
}

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403); // Evita que un usuario borre tareas que no son suyas
        }

        $task->delete();

        return back()->with('task_deleted', 'Tarea eliminada correctamente.');
    }
}
