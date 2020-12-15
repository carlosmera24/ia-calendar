<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionParticipant extends Model
{
    use HasFactory;
    protected $table = "permissions_participants";

    public function participant()
    {
        return $this->belongsTo(Participant::class,'participants_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class,'permissions_id');
    }


}
