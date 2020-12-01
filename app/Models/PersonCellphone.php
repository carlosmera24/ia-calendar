<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCellphone extends Model
{
    use HasFactory;
    protected $table = "persons_cellphones";

    public function person()
    {
        return $this->belongsTo('App\Models\Person','persons_id');
    }
}
