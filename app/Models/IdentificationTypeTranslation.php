<?php

namespace App\Models;

use App\Models\IdentificationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentificationTypeTranslation extends Model
{
    use HasFactory;
    protected $table = "identifications_types_translations";

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class,'identifications_types_id');
    }

}
