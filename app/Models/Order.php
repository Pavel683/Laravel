<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ // Поля которые можно вносить
        'seller_id',
        'telephone',
        'product_id',
        'email',
    ];

    protected $guarded = [];

    protected $visible = [ // Какие поля выводить методами toJson toArray
        'seller_id',
        'telephone',
        'product_id'
    ];

    protected $hidden = []; // Какие поля скрывать


    public function product(){  // Создаем связку что бы при получении из базы списка orders можно было вытащить продукты привязанные к копкретному заказу
        return $this->belongsTo(Product::class); // Методом $orders->product
    }

    public function user(){
        return $this->belongsTo(User::class, "seller_id");
    }

}
