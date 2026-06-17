<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Game;
use Illuminate\Http\Request;

class StandingsController extends Controller
{
    public function index()
    {
        $teams = Team::with(['players', 'homeGames', 'awayGames'])->get();

        $standings = $teams->map(function ($team) {
            $homeGames = $team->homeGames;
            $awayGames = $team->awayGames;
            $allGames = $homeGames->count() + $awayGames->count();

            return [
                'team' => $team,
                'played' => $allGames,
                'players' => $team->players->count(),
            ];
        })->sortByDesc('played')->values();

        return view('standings.index', compact('standings'));
    }
}