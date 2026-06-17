<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'team1_id',
        'team2_id',
        'arena_id',
        'date',
        'description',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function arena()
    {
        return $this->belongsTo(Arena::class);
    }

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
}
