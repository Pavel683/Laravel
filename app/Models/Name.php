<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [ // Поля которые можно вносить
        'fist_name',
        'second_name',
    ];

    protected $guarded = [  // Нельзя

    ];

    public function scopeIsJon($query){  // Самописные облегчающие функции
        return $query->where('fist_name', 'Jon');
    }

    public function scopeFindName($query, $name){
        return $query->where('fist_name', $name)->Orwhere('second_name', $name);
    }

    public function getFioAttribute(){ // Преобразование getter
        return $this->fist_name . " " . $this->second_name;
    }

    public function places(){                                                    // Прямая зависимость одно из этой таблицы может быть в нескольких в другой
        return $this->hasMany(Place::class, 'user_created_id'); // Как много (Из другой таблицы, где id искать в поле 'user_created_id')
                                                                                //
    }

}
