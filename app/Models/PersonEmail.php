<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use App\Mail\PersonEmailConfirmation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonEmail extends Model
{
    use HasFactory;
    protected $table = "persons_emails";

    const INITIAL_REGISTER_YES = 1;
    const INITIAL_REGISTER_NO = 0;
    const USED_EVENTS_YES = 1;
    const USED_EVENTS_NO = 0;
    const STATUS_PERSONS_EMAILS_ACTIVE= 1;
    const STATUS_PERSONS_EMAILS_PENDING= 2;
    const STATUS_PERSONS_EMAILS_CONFIRMING= 3;
    const STATUS_PERSONS_EMAILS_INACTIVE= 4;

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

    /**
     * Send email for verification
     * @param $person_email PersonEmail
     */
    public static function sendEmailConfirmation( PersonEmail $person_email )
    {
        if( isset($person_email) && isset($person_email->email) )
        {
            //generate URL with data Encrypt
            $params = [ 'id' => $person_email->id ];
            $link = route('persons_emails_confirmation', [ 'data' => Crypt::encrypt($params) ] );
            //Send email
            return Mail::to( $person_email->email )
                        ->send( new PersonEmailConfirmation($person_email, $link) );
        }

        return null;
    }
}
