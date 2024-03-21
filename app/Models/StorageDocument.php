<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageDocument extends Model
{
    use HasFactory;

    protected $fillable = [ // Поля которые можно вносить
        'url',
        'file_name',
    ];

    protected $guarded = [  // Нельзя

    ];

    public function cocktails(){
        return $this->morphedByMany(Cocktail::class, 'object', 'connected_documents', 'id');  // Полиморф к различным моделям с которым связана
    }

    public function ingredients(){
        return $this->morphedByMany(Ingredient::class, 'object', 'connected_documents', 'id');  // Полиморф к различным моделям с которым связана
    }

    public function notes(){
        return $this->morphedByMany(Note::class, 'object', 'connected_documents', 'id');  // Полиморф к различным моделям с которым связана
    }



}
