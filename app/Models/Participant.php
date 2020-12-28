<?php

namespace App\Models;

use App\Models\User;
use App\Models\Programmer;
use App\Models\ParticipantCategorie;
use App\Models\PermissionParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;
    protected $table = "participants";

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function programmer()
    {
        return $this->belongsTo(Programmer::class,'programmers_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class,'persons_id');
    }

    public function permissionsParticipants()
    {
        return $this->hasMany(PermissionParticipant::class,'participants_id');
    }
    public function partiipantsCategories()
    {
        return $this->hasMany(ParticipantCategorie::class,'participants_id');
    }

}
