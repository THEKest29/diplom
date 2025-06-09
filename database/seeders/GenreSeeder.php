<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    \App\Models\Genre::truncate();
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $genres = [
        'Экшен', 'Приключения', 'Комедия', 'Драма', 
        'Фэнтези', 'Ужасы', 'Мистика', 'Романтика',
        'Научная фантастика', 'Повседневность'
    ];

    foreach ($genres as $genre) {
        \App\Models\Genre::create([
            'name' => $genre,
            'slug' => \Illuminate\Support\Str::slug($genre)
        ]);
    }
}
}