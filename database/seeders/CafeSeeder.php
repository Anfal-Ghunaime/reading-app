<?php

namespace Database\Seeders;

use App\Models\Cafes\Cafe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        //fantasy romance
        Cafe::query()->create([
            'name' => 'The inner compass',
            'cafe_bio' => '',
            'image' => 'cafe/inner_compass.jpg',
        ]);

        //2
        //crime mystery
        Cafe::query()->create([
            'name' => 'Who is the perpetrator?',
            'cafe_bio' => '',
            'image' => 'cafe/crime.jpg',
        ]);

        //3
        //science fiction
        Cafe::query()->create([
            'name' => 'Vision',
            'cafe_bio' => '',
            'image' => 'cafe/vision.jpg',
        ]);

        //4
        Cafe::query()->create([
            'name' => 'Another dimension',
            'cafe_bio' => '',
            'image' => '',
        ]);

        //5
        Cafe::query()->create([
            'name' => 'cute',
            'cafe_bio' => '',
            'image' => '',
        ]);

        //6
        Cafe::query()->create([
            'name' => 'cute',
            'cafe_bio' => '',
            'image' => '',
        ]);

        //7
        Cafe::query()->create([
            'name' => 'Horizons',
            'cafe_bio' => '',
            'image' => '',
        ]);
    }
}
