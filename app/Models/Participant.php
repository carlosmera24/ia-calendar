<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = "participants";

    public function user()
    {
        return $this->belongsTo('App\Models\User','users_id');
    }

    public function programmer()
    {
        return $this->belongsTo('App\Models\Programmer','programmers_id');
    }

    public function person()
    {
        return $this->belongsTo('App\Models\Person','persons_id');
    }

}
