<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'The Legend of Zelda: Ocarina of Time',
                'platform' => 'Nintendo 64',
                'year_released' => 1998,
                'condition' => 'Mint',
            ],
            [
                'title' => 'Super Mario World',
                'platform' => 'SNES',
                'year_released' => 1990,
                'condition' => 'Good',
            ],
            [
                'title' => 'Final Fantasy VII',
                'platform' => 'PlayStation',
                'year_released' => 1997,
                'condition' => 'Fair',
            ],
            [
                'title' => 'Sonic the Hedgehog',
                'platform' => 'Sega Genesis',
                'year_released' => 1991,
                'condition' => 'Poor',
            ],
            [
                'title' => 'Pokemon Red',
                'platform' => 'GameBoy',
                'year_released' => 1996,
                'condition' => 'Mint',
            ],
        ];

        foreach ($data as $game) {
            Game::create($game);
        }
    }
}