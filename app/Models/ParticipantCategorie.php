<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipantCategorie extends Model
{
    use HasFactory;
    protected $table = "participants_categories";

    public function participant()
    {
        return $this->belongsTo(Participant::class,'participants_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categories_id');
    }
}
