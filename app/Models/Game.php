<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    protected $fillable = ['id_player', 'game_name', 'platform','game_type'];

    // Define the relationship with the Player model
    public function player()
    {
        return $this->belongsTo(Player::class, 'id_player');
    }

   
    
}
