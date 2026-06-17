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
            abort(403);
        }
        if (\Carbon\Carbon::parse($game->date)->isFuture()) {
            return redirect()->route('games.show', $game)
                            ->withErrors(['player_id' => __('messages.game_not_started')]);
        }

        $request->validate([
            'player_id' => 'required|exists:players,id',
            'points' => 'required|integer|min:0',
            'rebounds'=> 'required|integer|min:0',
            'assists' => 'required|integer|min:0',
            'fouls'=> 'required|integer|min:0',
            'minutes'=> 'required|integer|min:0',
        ]);

        $exists = Stat::where('game_id', $game->id)
                    ->where('player_id', $request->player_id)
                    ->exists();

        if ($exists) {
            return redirect()->route('games.show', $game)
                            ->withErrors(['player_id' => __('messages.player_stats_exists')]);
        }

        Stat::create([
            'game_id' => $game->id,
            'player_id' => $request->player_id,
            'secretary_id' => auth()->id(),
            'points' => $request->points,
            'rebounds' => $request->rebounds,
            'assists' => $request->assists,
            'fouls' => $request->fouls,
            'minutes' => $request->minutes,
        ]);

        return redirect()->route('games.show', $game)->with('success', __('messages.stats_added'));
    }
    public function edit(Stat $stat)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isSecretary()) {
            abort(403);
        }
        return view('stats.edit', compact('stat'));
    }
    public function update(Request $request, Stat $stat)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isSecretary()) {
            abort(403);
        }
        $request->validate([
            'points' => 'required|integer|min:0',
            'rebounds'=> 'required|integer|min:0',
            'assists' => 'required|integer|min:0',
            'fouls' => 'required|integer|min:0',
            'minutes' => 'required|integer|min:0',
        ]);
        $stat->update($request->only(['points', 'rebounds', 'assists', 'fouls', 'minutes']));
        return redirect()->route('games.show', $stat->game)->with('success', __('messages.stats_updated'));
    }
    public function destroy(Stat $stat)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        $game = $stat->game;
        $stat->delete();
        return redirect()->route('games.show', $game)->with('success', __('messages.stats_deleted'));
    }
}