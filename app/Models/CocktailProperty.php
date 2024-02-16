<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocktailProperty extends Model
{
    use HasFactory;


    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class, 'connected_properties');
    }

}
