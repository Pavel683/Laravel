<?php


namespace App\Services;


use App\Models\Ingredient;

class ValidIngredientsServes
{

    private $ingredients_list;

    public function __construct($ingredients_list)
    {
        $this->ingredients_list = $ingredients_list;
    }

    public function formatted()
    {

        $ingredients = $this->ingredients_list;
        $all_ingredients = Ingredient::pluck('name', 'id')->toArray();

        foreach ($all_ingredients as $id=>$ingredient){
            $ingredients = str_ireplace(
                strtolower($ingredient),
                '<a class="text-decoration-none" style="color: #007bff" href="/ingredients/'.$id.'">'.$ingredient.'</a>',
                strtolower($ingredients)
            );
        }

        return $ingredients;
    }

}
