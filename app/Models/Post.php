<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setIntroAttribute($value){ // Постоянное переопределение
        $id = self::max('id');
        $this->attributes['intro'] = "second_intro".++$id;
    }


}
