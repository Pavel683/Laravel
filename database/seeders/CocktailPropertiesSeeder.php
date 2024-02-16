<?php

namespace Database\Seeders;

use App\Models\CocktailProperty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CocktailPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $props = [
            'Крепкий', 'Не крепкий',
            'Сладкий', 'Кислый', 'Горький', 'Сливочный',
            'Лонг', 'Шорт', 'Шот',
            'Избранное',
        ];

        foreach ($props as $prop){
            CocktailProperty::create(['name' => $prop]);
        }
    }
}
