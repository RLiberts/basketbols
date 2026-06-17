<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Models\Game;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function store(Request $request, Game $game)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isSecretary()) {
            abort(403, 'Nav piekļuves.');
        }

        $request->validate([
            'player_id' => 'required|exists:players,id',
            'points' => 'required|integer|min:0',
            'rebounds' => 'required|integer|min:0',
            'assists' => 'required|integer|min:0',
            'fouls' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0',
        ]);

        Stat::create([
            'game_id' => $game->id,
            'player_id' => $request->player_id,
            'secretary_id' => auth()->id(),
            'points'=> $request->points,
            'rebounds'=> $request->rebounds,
            'assists' => $request->assists,
            'fouls' => $request->fouls,
            'minutes' => $request->minutes,
        ]);

        return redirect()->route('games.show', $game)->with('success', 'Statistika veiksmīgi pievienota!');
    }

    public function edit(Stat $stat)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isSecretary()) {
            abort(403, 'Nav piekļuves.');
        }

        return view('stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isSecretary()) {
            abort(403, 'Nav piekļuves.');
        }

        $request->validate([
            'points'  => 'required|integer|min:0',
            'rebounds' => 'required|integer|min:0',
            'assists'=> 'required|integer|min:0',
            'fouls' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0',
        ]);

        $stat->update($request->all());
        return redirect()->route('games.show', $stat->game)->with('success', 'Statistika veiksmīgi atjaunināta!');
    }

    public function destroy(Stat $stat)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Nav piekļuves.');
        }

        $game = $stat->game;
        $stat->delete();
        return redirect()->route('games.show', $game)->with('success', 'Statistika veiksmīgi dzēsta!');
    }
}