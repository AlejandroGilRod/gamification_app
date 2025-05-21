<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $userItems = auth()->user()->items->pluck('id')->toArray();
        return view('tienda', compact('items', 'userItems'));
    }

    public function comprar(Request $request, $itemId)
    {
        $user = Auth::user();
        $item = Item::findOrFail($itemId);

        // Verificar si es equipo y si ya fue comprado
        if ($item->type === 'equipment' && $user->items->contains($item->id)) {
            return redirect()->back()->with('error', '❌ Ya posees este equipo.');
        }

        // Verificar si tiene suficiente oro
        if ($user->gold < $item->price) {
            return redirect()->back()->with('error', '❌ No tienes suficiente oro.');
        }

        // Aplicar efectos según stat_target
        switch ($item->stat_target) {
            case 'vida':
                $user->health = min($user->health + $item->stat_bonus, 100 + $user->fuerza);
                break;

            case 'fuerza':
            case 'defensa':
            case 'inteligencia':
                $user->{$item->stat_target} += $item->stat_bonus;
                break;

            case 'experience':
                $nuevaXP = $user->experience + $item->stat_bonus;
                $nivelesGanados = intdiv($nuevaXP, 100);
                $xpRestante = $nuevaXP % 100;

                $user->experience = $xpRestante;
                $user->level += $nivelesGanados;
                $user->attribute_points += $nivelesGanados;
                break;
        }


        // Descontar el oro
        $user->gold -= $item->price;
        $user->save();

        // Registrar la compra (solo para equipos o si deseas historial)
        $user->items()->attach($item->id);

        return redirect()->back()->with('success', "✅ Has comprado {$item->name}.");
    }
}
