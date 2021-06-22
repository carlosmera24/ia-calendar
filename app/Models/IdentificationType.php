<?php

namespace App\Models;

use App\Models\Programmer;
use Illuminate\Database\Eloquent\Model;
use App\Models\IdentificationTypeTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentificationType extends Model
{
    use HasFactory;
    protected $table = "identifications_types";

    public function translations()
    {
        return $this->hasMany(IdentificationTypeTranslation::class,'identifications_types_id');
    }

    public function programmers()
    {
        return $this->hasMany(Programmer::class,'identifications_types_id');
    }
}
