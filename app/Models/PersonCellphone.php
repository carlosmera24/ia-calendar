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

    /**
     * Validate if cellphone exists
     * @param $mobile to validate
     * @return boolen
     */
    public static function cellphoneExist( $mobile )
    {
        $mobile = PersonCellphone::where('cellphone_number', $mobile)->first();
        if( empty($mobile) )
        {
            return false;
        }else{
            return true;
        }
    }
}
