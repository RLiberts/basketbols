<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Arena;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['team1', 'team2', 'arena'])->orderBy('date')->get();
        return view('games.index', compact('games'));
    }
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Game::class)) {
            abort(403);
        }
        $teams = Team::all();
        $arenas = Arena::all();
        return view('games.create', compact('teams', 'arenas'));
    }
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Game::class)) {
            abort(403);
        }
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'arena_id' => 'required|exists:arenas,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        Game::create($request->all());
        return redirect()->route('games.index')->with('success', 'Spēle veiksmīgi pievienota!');
    }

    public function edit(Game $game)
    {
        if ($request->user()->cannot('update', $game)) {
            abort(403);
        }
        $teams = Team::all();
        $arenas = Arena::all();
        return view('games.edit', compact('game', 'teams', 'arenas'));
    }
    public function update(Request $request, Game $game)
    {
        if ($request->user()->cannot('update', $game)) {
            abort(403);
        }
        $request->validate([
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'arena_id' => 'required|exists:arenas,id',
            'date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        $game->update($request->all());
        return redirect()->route('games.index')->with('success', 'Spēle veiksmīgi atjaunināta!');
    }
    public function destroy(Game $game)
    {
        if ($request->user()->cannot('delete', $game)) {
            abort(403);
        }
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Spēle veiksmīgi dzēsta!');
    }
}