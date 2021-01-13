<?php

namespace App\Models;

use App\Models\Participant;
use App\Models\LogStateParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StateParticipant extends Model
{
    use HasFactory;
    protected $table = "status_participants";

    public function participants()
    {
        return $this->hasMany(Participant::class,'status_participants_id');
    }

    public function statesParticipants()
    {
        return $this->hasMany(LogStateParticipant::class,'status_participants_id');
    }
}
