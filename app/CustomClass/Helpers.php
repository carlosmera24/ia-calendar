<?php
namespace App\CustomClass;

use Illuminate\Support\Facades\Storage;

/**
 * Class for general functions
 */
class Helpers
{
    const PATH_IMG = "public/img/";
    const PATH_LOGO = self::PATH_IMG . "logos/";
    const PATH_PROFILE = self::PATH_IMG . "profiles/";

    /**
     * Function responsible for storing image from a String64 in the path
     * /storage/app/public/img/,
     * @param $str64 String content image in format 64
     * @param $name_image Name of image for the user, exist
     * @param $option nullable, 1=Logo, 2=Profile, default img directory
     * @return String for name if save sucess or null for error
     */
    public static function saveImageString64(String $str64, $name_image, $option = null)
    {
        $dir = self::PATH_IMG;
        switch($option)
        {
            case 1:
                $dir =  self::PATH_LOGO;
                break;
            case 2:
                $dir =  self::PATH_PROFILE;
                break;
            default:
                break;
        }
        $file = $dir . $name_image;

        if( Storage::put($file, $str64) )
        {
            return $name_image;
        }
        return null;
    }

}
