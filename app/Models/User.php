<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Participant;
use App\Models\UpdatedPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class,'users_id');
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class,'users_id');
    }

    public function updatedsPasswords()
    {
        return $this->hasMany(UpdatedPassword::class,'users_id');
    }
}
