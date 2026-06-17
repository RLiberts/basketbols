<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'manager_id',
        'city',
        'logo'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function homeGames()
    {
        return $this->hasMany(Game::class, 'team1_id');
    }

    public function awayGames()
    {
        return $this->hasMany(Game::class, 'team2_id');
    }
}
