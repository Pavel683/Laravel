<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'status_id',
        'dop_note',
    ];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(CategoryNote::class);
    }
    public function status()
    {
        return $this->belongsTo(StatusNote::class);
    }

    public function storage_documents(){
        return $this->morphToMany(StorageDocument::class, 'object', 'connected_documents', 'object_id', 'id');  // Полиморф связка(Модель, Связка с полями)
    }

}
