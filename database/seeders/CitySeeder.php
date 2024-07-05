<?php

namespace Database\Seeders;
use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        
        $maharashtra = State::where('name', 'Maharashtra')->first();
        City::create(['name' => 'Mumbai', 'state_id' => $maharashtra->id]);
        City::create(['name' => 'Pune', 'state_id' => $maharashtra->id]);
        City::create(['name' => 'Nagpur', 'state_id' => $maharashtra->id]);
        City::create(['name' => 'Nashik', 'state_id' => $maharashtra->id]);

        $gujarat = State::where('name', 'Gujarat')->first();
        City::create(['name' => 'Ahmedabad', 'state_id' => $gujarat->id]);
        City::create(['name' => 'Surat', 'state_id' => $gujarat->id]);
        City::create(['name' => 'Vadodara', 'state_id' => $gujarat->id]);
        City::create(['name' => 'Rajkot', 'state_id' => $gujarat->id]);

        $rajasthan = State::where('name', 'Rajasthan')->first();
        City::create(['name' => 'Jaipur', 'state_id' => $rajasthan->id]);
        City::create(['name' => 'Jodhpur', 'state_id' => $rajasthan->id]);
        City::create(['name' => 'Udaipur', 'state_id' => $rajasthan->id]);
        City::create(['name' => 'Kota', 'state_id' => $rajasthan->id]);

        $bihar = State::where('name', 'Bihar')->first();
        City::create(['name' => 'Patna', 'state_id' => $bihar->id]);
        City::create(['name' => 'Gaya', 'state_id' => $bihar->id]);
        City::create(['name' => 'Bhagalpur', 'state_id' => $bihar->id]);
        City::create(['name' => 'Muzaffarpur', 'state_id' => $bihar->id]);

        $uttarPradesh = State::where('name', 'Uttar Pradesh')->first();
        City::create(['name' => 'Lucknow', 'state_id' => $uttarPradesh->id]);
        City::create(['name' => 'Kanpur', 'state_id' => $uttarPradesh->id]);
        City::create(['name' => 'Varanasi', 'state_id' => $uttarPradesh->id]);
        City::create(['name' => 'Agra', 'state_id' => $uttarPradesh->id]);
    }
}