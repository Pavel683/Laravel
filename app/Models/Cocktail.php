<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'description',
        'in_menu',
    ];

    protected $guarded = [];

    public function storage_documents(){
        return $this->morphToMany(StorageDocument::class, 'object', 'connected_documents', 'object_id', 'id');  // Полиморф связка(Модель, Связка с полями)
    }

    public function cocktail_properties()
    {
        return $this->belongsToMany(CocktailProperty::class, 'connected_properties');
    }

    public function setInMenu()
    {
        $this->update(['in_menu' => 1]);
    }
    public function delInMenu()
    {
        $this->update(['in_menu' => 0]);
    }

}
