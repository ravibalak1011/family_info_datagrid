<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run()
    {
        State::create(['name' => 'Maharashtra']);
        State::create(['name' => 'Gujarat']);
        State::create(['name' => 'Rajasthan']);
        State::create(['name' => 'Bihar']);
        State::create(['name' => 'Uttar Pradesh']);
    }
}
