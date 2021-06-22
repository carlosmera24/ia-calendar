<?php

namespace App\Models;

use App\Models\PermissionParticipant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permissions";
    const CATEGORIES_INDEX = 1; //categories.index
    const CATEGORIES_CRETAE = 2; //categories.create'
    const CATEGORIES_EDIT = 3; //categories.edit
    const CATEGORIES_DELETE = 4; //categories.delete
    const CATEGORIES_SHARE = 5; //categories.share
    const EVENTS_INDEX = 6; //events.index
    const EVENTS_CREATE = 7; //events.create
    const EVENTS_EDIT = 8; //events.edit
    const EVENTS_DELETE = 9; //events.delete
    const EVENTS_SHARE = 10; //events.share
    const CATEGORIES_ADMIN_ACCESS = 11; //categories.administrator.access
    const EVENTS_ADMIN_ACCESS = 12; //events.administrator.access


    public function permissionsParticipants()
    {
        return $this->hasMany(PermissionParticipant::class,'permissions_id');
    }
}
