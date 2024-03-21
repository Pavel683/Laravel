<?php

namespace Database\Seeders;

use App\Models\IngredientCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $props = [
            'Крепкая основа',
            'Ликеры',
            'Аромачитечкие биттеры',
            'Вермуты и Вина',
            'Пиво и Сидоры',
            'Сиропы и Джемы',
            'Безалкогольные напитки',
            'Фрукты и Ягоды',
            'Овощи и Травы',
            'Соусы, Специи и Пряности',
            'Гарниш',
        ];

        foreach ($props as $prop){
            IngredientCategory::create(['name' => $prop]);
        }
    }
}
