<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    protected $fillable = [
        'name',
        'address',
        'lat',
        'lng'
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
