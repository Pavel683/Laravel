<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'second_name',
        'email',
        'password',
        'is_admin',
        'is_active',
    ];

    protected $guarded = [  // Нельзя

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFioAttribute(){ // Преобразование getter
        return $this->name . " " . $this->second_name;
    }

    public function places(){                                                    // Прямая зависимость одно из этой таблицы может быть в нескольких в другой
        return $this->hasMany(Place::class, 'user_created_id'); // Как много (Из другой таблицы, где id искать в поле 'user_created_id')
    }

    public function isAdmin(){
        return $this->is_admin === 1;
    }

    public function isActive(){
        return $this->is_active === 1;
    }

    public function setAdmin(){  // Установить переменную
        $this->update(['is_admin' => 1]);
    }
    public function delAdmin(){  // Установить переменную
        $this->update(['is_admin' => 0]);
    }
    public function setActive(){  // Установить переменную
        $this->update(['is_active' => 1]);
    }
    public function delActive(){  // Установить переменную
        $this->update(['is_active' => 0]);
    }


    public function scopeIsAdmin($query){
        return $query->where('is_admin', 1);
    }

}
