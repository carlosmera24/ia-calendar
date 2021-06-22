<?php

namespace App\Models;

use App\Models\Participant;
use App\Models\StateParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogStateParticipant extends Model
{
    use HasFactory;
    protected $table = "logs_status_participants";

    public function participant()
    {
        return $this->belongsTo(Participant::class,'participants_id');
    }

    public function stateParticipant()
    {
        return $this->belongsTo(StateParticipant::class,'status_participants_id');
    }
}
