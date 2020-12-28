<?php

namespace App\Models;

use App\Models\User;
use App\Models\ParticipantCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    protected $table = "categories";

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function ParticipantsCategories()
    {
        return $this->belongsTo(ParticipantCategorie::class,'categories_id');
    }

}
