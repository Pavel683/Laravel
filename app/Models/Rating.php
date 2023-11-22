<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_rating',
    ];
    protected $guarded = [  // Нельзя
        'updated_at',
        'created_at',
    ];

    public function plase()
    {                                                // Обратная зависимость
        return $this->belongsTo(Place::class); //
    }

    public function object(){
        return $this->morphTo();  // Полиморф к различным моделям с которым связана
    }

     public function documents(){
        return $this->morphedByMany(Document::class, 'object', 'rateable', 'id');  // Полиморф к различным моделям с которым связана
    }

    public function places(){
        return $this->morphedByMany(Place::class, 'object', 'rateable', 'id');  // Полиморф к различным моделям с которым связана
    }

//    public function scopeTypeRating($query, $name){
//        dd($name);
//        return $query->where('fist_name', $name)->Orwhere('second_name', $name);
//    }


}
