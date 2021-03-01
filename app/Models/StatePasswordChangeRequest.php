<?php

namespace App\Models;

use App\Models\PasswordChangeRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatePasswordChangeRequest extends Model
{
    use HasFactory;
    protected $table = "status_password_change_requests";

    public function passwordChangeRequests()
    {
        return $this->hasMany(PasswordChangeRequest::class,'status_password_change_requests_id');
    }
}
