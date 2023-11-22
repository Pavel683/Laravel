<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ // Поля которые можно вносить
        'product_name',
        'price',
    ];

    protected $guarded = [  // Нельзя

    ];

    protected $dates = ['deleted_at']; // Для мягкого удаления

    public function orders(){
        return $this->hasMany(Order::class, "product_id");
    }

}
