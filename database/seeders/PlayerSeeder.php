<?php

namespace Database\Seeders;

use App\Models\Player;
use Database\Factories\PlayerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        player::factory(500)->create();
    }
}
