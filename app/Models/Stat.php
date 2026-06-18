<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'game_id',
        'player_id',
        'secretary_id',
        'points',
        'rebounds',
        'assists',
        'fouls',
        'minutes'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function secretary()
    {
        return $this->belongsTo(User::class, 'secretary_id');
    }
}
