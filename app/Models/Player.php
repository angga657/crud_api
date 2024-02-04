<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    
    use HasFactory;
    protected $fillable = ['nickname', 'username', 'email'];

    // Define the relationship with the Game model
    public function games()
    {
        return $this->hasMany(Game::class, 'id_player');
    }
}
