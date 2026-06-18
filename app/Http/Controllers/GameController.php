<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Arena;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with(['team1', 'team2', 'arena', 'stats'])->orderBy('date');

        if ($request->filled('team')) {
            $query->where(function($q) use ($request) {
                $q->where('team1_id', $request->team)
                ->orWhere('team2_id', $request->team);
            });
        }

        if ($request->filled('arena')) {
            $query->where('arena_id', $request->arena);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        $games = $query->get();
        $teams = \App\Models\Team::all();
        $arenas = \App\Models\Arena::all();

        return view('games.index', compact('games', 'teams', 'arenas'));
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

        Game::create($request->only(['team1_id', 'team2_id', 'arena_id', 'date', 'description']));
        return redirect()->route('games.index')->with('success',  __('messages.game_added'));
    }

    public function edit(Request $request, Game $game)
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

        $game->update($request->only(['team1_id', 'team2_id', 'arena_id', 'date', 'description']));
        return redirect()->route('games.index')->with('success', __('messages.game_updated'));
    }
    public function destroy(Request $request, Game $game)
    {
        if ($request->user()->cannot('delete', $game)) {
            abort(403);
        }
        $game->delete();
        return redirect()->route('games.index')->with('success',  __('messages.game_deleted'));
    }
}