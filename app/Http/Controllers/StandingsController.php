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
            $wins   = 0;
            $losses = 0;

            foreach ($team->homeGames as $game) {
                $team1_score = $game->stats->whereIn('player_id', $team->players->pluck('id'))->sum('points');
                $team2_score = $game->stats->whereNotIn('player_id', $team->players->pluck('id'))->sum('points');
                if ($team1_score > $team2_score) $wins++;
                elseif ($team1_score < $team2_score) $losses++;
            }

            foreach ($team->awayGames as $game) {
                $team2_score = $game->stats->whereIn('player_id', $team->players->pluck('id'))->sum('points');
                $team1_score = $game->stats->whereNotIn('player_id', $team->players->pluck('id'))->sum('points');
                if ($team2_score > $team1_score) $wins++;
                elseif ($team2_score < $team1_score) $losses++;
            }

            $played = $team->homeGames->count() + $team->awayGames->count();

            return [
                'team' => $team,
                'played' => $played,
                'wins' => $wins,
                'losses' => $losses,
                'players' => $team->players->count(),
            ];
        })->sortByDesc('wins')->values();

        return view('standings.index', compact('standings'));
    }
}