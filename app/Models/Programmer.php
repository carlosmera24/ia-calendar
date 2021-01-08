<?php

namespace App\Models;

use App\Models\Participant;
use App\Models\IdentificationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programmer extends Model
{
    use HasFactory;
    protected $table = "programmers";

    public function participants()
    {
        return $this->hasMany(Participant::class,'programmers_id');
    }

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class,'identifications_types_id');
    }
}
