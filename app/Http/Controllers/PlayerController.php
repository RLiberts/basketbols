<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }
    public function store(Request $request, Team $team)
    {
        if (!auth()->user()->isAdmin() && auth()->user()->id !== $team->manager_id) {
            abort(403, __('messages.no_access'));
        }
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        Player::create([
            'first_name' => $request->first_name,
            'last_name'=> $request->last_name,
            'team_id' => $team->id,
        ]);

        return redirect()->route('teams.show', $team)->with('success', __('messages.player_added'));
    }

    public function edit(Player $player)
    {
        if (!auth()->user()->isAdmin() && auth()->user()->id !== $player->team->manager_id) {
            abort(403, __('messages.no_access'));
        }
        return view('players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        if (!auth()->user()->isAdmin() && auth()->user()->id !== $player->team->manager_id) {
            abort(403, __('messages.no_access'));
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $player->update($request->only(['first_name', 'last_name']));
        return redirect()->route('teams.show', $player->team)->with('success', __('messages.player_updated'));
    }

    public function destroy(Player $player)
    {
        if (!auth()->user()->isAdmin() && auth()->user()->id !== $player->team->manager_id) {
            abort(403, __('messages.no_access'));
        }

        $team = $player->team;
        $player->delete();
        return redirect()->route('teams.show', $team)->with('success', __('messages.player_deleted'));
    }
}