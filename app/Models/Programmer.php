<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programmer extends Model
{
    use HasFactory;
    protected $table = "programmers";

    public function participants()
    {
        return $this->hasMany('App\Models\Participant','programmers_id');
    }
}
