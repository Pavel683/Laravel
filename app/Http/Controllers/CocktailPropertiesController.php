<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\CocktailProperty;
use Illuminate\Http\Request;

class CocktailPropertiesController extends Controller
{

    public function add_properties(Request $request)
    {
        $cocktail = Cocktail::find($request->cocktail_id);
        $properties = $request->properties;
        $binding_properties = $cocktail->cocktail_properties;

        foreach ($properties as $property){
            if (!$binding_properties->contains($property)){
                $cocktail->cocktail_properties()->attach($property);  // Создать связи уже к существующим элементам в таблицах
            }
        }

        foreach ($binding_properties as $binding_property){
            if (!in_array($binding_property->id, $properties)){
                $cocktail->cocktail_properties()->detach($binding_property->id);
            }
        }

        return redirect(route('cocktails.show', compact('cocktail')));
    }


    public function create()
    {
        //
    }
}
