<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $guarded = [  // Нельзя

    ];

    public function places(){                       // Прямая зависимость одно из этой таблицы может быть в нескольких в другой
        return $this->hasMany(Place::class); // Как много (Из другой таблицы, где id искать в поле 'user_created_id')
        //
    }

}
