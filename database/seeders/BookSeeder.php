<?php

namespace Database\Seeders;

use App\Models\Cafes\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        $books = [
            '1st_book' => [
              'book_data' => [
                  'book_id' => '#25hN6u8',
                  'book' => 'books/crime_and_punishment.pdf',
                  'name' => 'Crime and punishment',
                  'writer' => 'Fyodor Dostoevsky',
                  'cover' => 'covers/crime_and_punishment.png',
                  'summary' => ' هي رواية معقدة تدور حول الطالب الجامعي الفقير، روديون راسكولنيكوف، يطور نظرية تبرر الجريمة لأولئك الذين يعتبرهم مميزين أو "متفوقين". يقرر تطبيق نظريته من خلال ارتكاب جريمة قتل ضد مرابية جشعة. ما يلي هو عذاب نفسي عميق ومعاناة يعانيها بسبب جريمته.',
                  'pages_num' => '984',
                  'lang' => 'Arabic',
                  'published_at' => '1985',
                  'is_novel' => true,
                  'is_locked' => false,
                  'points' => 0,
                  'approved' => true
              ],
            'shelves' => [1,2,3]
            ],

            '2nd_book' => [
                'book_data' => [
                    'book_id' => '#R5hN7u8',
                    'book' => 'books/lost_symbol.pdf',
                    'name' => 'The lost symbol',
                    'writer' => 'Dan Brown',
                    'cover' => 'covers/lost_symbol.png',
                    'summary' => 'كتاب من تأليف دان براون يتمحور حول مغامرة جديدة لروبرت لانغدون، أستاذ علم الرموز، الذي يجد نفسه مشتركًا في لغز معقد يتعلق بتاريخ الماسونية وأسرارها في واشنطن العاصمة.',
                    'pages_num' => '480',
                    'lang' => 'Arabic',
                    'published_at' => '1984',
                    'is_novel' => true,
                    'is_locked' => false,
                    'points' => 0,
                    'approved' => true
                ],
                'shelves' => [20,13,30]
            ]
        ];

        foreach ($books as $book){
            $book_to_save = Book::query()->create($book['book_data']);
            $book_to_save->shelves()->sync($book['shelves']);
        }
    }
}
