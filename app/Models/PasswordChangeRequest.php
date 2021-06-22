<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\StatePasswordChangeRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordChangeRequest extends Model
{
    use HasFactory;
    protected $table = "password_change_requests";

    const STATE_PASSWORD_CHANGE_REQUEST_ACTIVE = 1;
    const STATE_PASSWORD_CHANGE_REQUEST_EXPIRED = 2;
    const STATE_PASSWORD_CHANGE_REQUEST_FINALIZED = 3;

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function statePasswordChangeRequest()
    {
        return $this->belongsTo(StatePasswordChangeRequest::class,'status_password_change_requests_id');
    }
}
