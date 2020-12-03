<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = "persons";

    public function participant()
    {
        return $this->hasMany('App\Models\Participant','persons_id');
    }

    public function personsEmails()
    {
        return $this->hasMany('App\Models\PersonEmail','persons_id');
    }

    public function personsCellphones()
    {
        return $this->hasMany('App\Models\PersonCellphone','persons_id');
    }
}
