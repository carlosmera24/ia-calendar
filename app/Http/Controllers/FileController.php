<?php

namespace App\Http\Controllers;

use Validator;
use App\CustomClass\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    protected $rules_image = [
                                'name'      =>  'required',
                                'option'    =>  'nullable|regex:/^[0-2]$/'
    ];

    /**
     * Return image in 64 base.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function image64Base( Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_image);
        if( $validator->fails() )
        {
            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'error'     =>  __('messages.bad_request'),
                                                'data'      =>  $validator->getMessageBag()->toArray()
                                            ),
                                        400
                                    );
        }else
        {
            $dir = null;
            switch($request->option)
            {
                case '1': //Default logo directory
                    $dir = Helpers::PATH_LOGO;
                    break;
                case '2': //Default profile directory
                    $dir = Helpers::PATH_LOGO;
                    break;
                default: //Default image directory
                    $dir = Helpers::PATH_IMG;
                    break;
            }
            $path = $dir . $request->name;
            //Get content file
            $content = Storage::get($path);
            return response( $content,200)
                            ->header('Content-Type', 'text/plain');
        }
    }
}
