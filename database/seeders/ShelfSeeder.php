<?php

namespace Database\Seeders;

use App\Models\Cafes\Shelf;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        Shelf::query()->create([
            'cafe_id' => 1,
            'genre' => 'Fantasy',
            'image'  => 'shelves/fantasy.png',
        ]);

        //2
        Shelf::query()->create([
            'cafe_id' => 1,
            'genre' => 'Romance',
            'image'  => 'shelves/romance.png',
        ]);

        //3
        Shelf::query()->create([
            'cafe_id' => 1,
            'genre' => 'Poetry',
            'image'  => 'shelves/poetry.png',
        ]);

        //4
        Shelf::query()->create([
            'cafe_id' => 1,
            'genre' => 'Drama',
            'image'  => 'shelves/drama.png',
        ]);

        //5
        Shelf::query()->create([
            'cafe_id' => 1,
            'genre' => 'Literature',
            'image'  => 'shelves/literature.png',
        ]);

        //6
        Shelf::query()->create([
            'cafe_id' => 1,
            'genre' => 'Fairy tales & Folklore',
            'image'  => 'shelves/fairy_tales.png',
        ]);

        //7
        Shelf::query()->create([
            'cafe_id' => 2,
            'genre' => 'Mystery',
            'image'  => 'shelves/mystery.png',
        ]);

        //8
        Shelf::query()->create([
            'cafe_id' => 2,
            'genre' => 'Crime',
            'image'  => 'shelves/crime.png',
        ]);

        //9
        Shelf::query()->create([
            'cafe_id' => 2,
            'genre' => 'Thriller',
            'image'  => 'shelves/thriller.png',
        ]);

        //10
        Shelf::query()->create([
            'cafe_id' => 2,
            'genre' => 'Horror',
            'image'  => 'shelves/horror.png',
        ]);

        //11
        Shelf::query()->create([
            'cafe_id' => 2,
            'genre' => 'Adventure',
            'image'  => 'shelves/adventure.png',
        ]);

        //12
        Shelf::query()->create([
            'cafe_id' => 3,
            'genre' => 'Science',
            'image'  => 'shelves/science.png',
        ]);

        //13
        Shelf::query()->create([
            'cafe_id' => 3,
            'genre' => 'Science fiction',
            'image'  => 'shelves/science-fiction.png',
        ]);

        //14
        Shelf::query()->create([
            'cafe_id' => 3,
            'genre' => 'Technology',
            'image'  => 'shelves/technology.png',
        ]);

        //15
        Shelf::query()->create([
            'cafe_id' => 4,
            'genre' => 'Comic',
            'image'  => 'shelves/comic.png',
        ]);

        //16
        Shelf::query()->create([
            'cafe_id' => 4,
            'genre' => 'Manga',
            'image'  => 'shelves/manga.png',
        ]);

        //17
        Shelf::query()->create([
            'cafe_id' => 4,
            'genre' => 'Humor',
            'image'  => 'shelves/humor.png',
        ]);

        //18
        Shelf::query()->create([
            'cafe_id' => 5,
            'genre' => 'Travel',
            'image'  => 'shelves/travel.png',
        ]);

        //19
        Shelf::query()->create([
            'cafe_id' => 5,
            'genre' => 'Religion',
            'image'  => 'shelves/religion.png',
        ]);

        //20
        Shelf::query()->create([
            'cafe_id' => 5,
            'genre' => 'History',
            'image'  => 'shelves/history.png',
        ]);

        //21
        Shelf::query()->create([
            'cafe_id' => 5,
            'genre' => 'Philosophy',
            'image'  => 'shelves/philosophy.png',
        ]);

        //22
        Shelf::query()->create([
            'cafe_id' => 6,
            'genre' => 'Psychology',
            'image'  => 'shelves/psychology.png',
        ]);

        //23
        Shelf::query()->create([
            'cafe_id' => 6,
            'genre' => 'Life stories',
            'image'  => 'shelves/life_stories.png',
        ]);

        //24
        Shelf::query()->create([
            'cafe_id' => 6,
            'genre' => 'Health',
            'image'  => 'shelves/health.png',
        ]);

        //25
        Shelf::query()->create([
            'cafe_id' => 6,
            'genre' => 'Business',
            'image'  => 'shelves/business.png',
        ]);

        //26
        Shelf::query()->create([
            'cafe_id' => 6,
            'genre' => 'Self help',
            'image'  => 'shelves/self-help.png',
        ]);

        //27
        Shelf::query()->create([
            'cafe_id' => 6,
            'genre' => 'Education',
            'image'  => 'shelves/education.png',
        ]);

        //28
        Shelf::query()->create([
            'cafe_id' => 7,
            'genre' => 'Children Literature',
            'image'  => 'shelves/children_literature.png',
        ]);

        //29
        Shelf::query()->create([
            'cafe_id' => 7,
            'genre' => 'Picture book',
            'image'  => 'shelves/picture_book.png',
        ]);

        //30
        Shelf::query()->create([
            'cafe_id' => 7,
            'genre' => 'Young adult',
            'image'  => 'shelves/young_adult.png',
        ]);
    }
}
