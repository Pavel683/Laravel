<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Place extends Model
{
    use HasFactory;

//    protected $primaryKey = 'user_created_id';

    protected $fillable = [ // Поля которые можно вносить
        'name_place',
        'type_id',
        'user_created_id',
    ];

    protected $guarded = [  // Нельзя

    ];

    public function user_created()
    {                                                                            // Обратная зависимость
        return $this->belongsTo(User::class, 'user_created_id'); //
    }

    public function type()
    {                                                // Обратная зависимость
        return $this->belongsTo(Type::class); //
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

//    public function ratings(){
//        return $this->morphMany(Rating::class, 'object');  // Полиморф связка(Модель, Связка с полями)
//    }

    public function ratings(){
        return $this->morphToMany(Rating::class, 'object', 'rateable', 'object_id', 'id');  // Полиморф связка(Модель, Связка с полями)
    }


}
