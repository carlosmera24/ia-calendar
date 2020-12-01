<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonEmail extends Model
{
    use HasFactory;
    protected $table = "persons_emails";

    public function person()
    {
        return $this->belongsTo('App\Models\Person','persons_id');
    }
}
