<?php

namespace Database\Seeders;

use App\Models\CategoryNote;
use App\Models\StatusNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Книги', 'Фильмы', 'Сериалы', 'Игры', 'Мысли/Реализации'
        ];
        $statuses = [
            'Не смотрел', 'В процессе', 'Закончил', 'Пауза', 'Возможно когда-нибудь',
        ];

        foreach ($types as $type){
            CategoryNote::create(['name' => $type]);
        }
        foreach ($statuses as $status){
            StatusNote::create(['name' => $status]);
        }

    }
}
