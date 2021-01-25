<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonEmail extends Model
{
    use HasFactory;
    protected $table = "persons_emails";

    const INITIAL_REGISTER_YES = 1;
    const INITIAL_REGISTER_NO = 0;
    const USED_EVENTS_YES = 1;
    const USED_EVENTS_NO = 0;

    public function person()
    {
        return $this->belongsTo('App\Models\Person','persons_id');
    }

    /**
     * Validate if email exists
     * @param $email to validate
     * @return boolen
     */
    public static function emailExist( $email )
    {
        $email = PersonEmail::where('email', $email)->first();
        if( empty($email) )
        {
            return false;
        }else{
            return true;
        }
    }
}
