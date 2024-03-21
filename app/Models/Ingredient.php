<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class);
    }

    public function storage_documents(){
        return $this->morphToMany(StorageDocument::class, 'object', 'connected_documents', 'object_id', 'id');  // Полиморф связка(Модель, Связка с полями)
    }

}
