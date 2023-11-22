<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [ // Поля которые можно вносить
        'place_id',
        'url',
    ];

    protected $guarded = [  // Нельзя

    ];

    public function places(){                                                    // Прямая зависимость одно из этой таблицы может быть в нескольких в другой
        return $this->hasMany(Place::class); // Как много (Из другой таблицы, где id искать в поле 'user_created_id')
        //
    }

//    public function ratings(){
//        return $this->morphMany(Rating::class, 'object');  // Полиморф связка(Модель, Связка с полями)
//    }

    public function ratings(){
        return $this->morphToMany(Rating::class, 'object', 'rateable', 'object_id', 'id');  // Полиморф связка(Модель, Связка с полями)
    }





}
