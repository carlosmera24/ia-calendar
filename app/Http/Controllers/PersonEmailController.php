<?php

namespace App\Http\Controllers;

use App\Models\PersonEmail;
use Illuminate\Http\Request;
use Validator;

class PersonEmailController extends Controller
{
    protected $rules_store = [
                                'email'             =>  'required|email|max:45|unique:persons_emails',
                                'initial_register'  =>  'nullable|regex:/^[0-1]$/',
                                'persons_id'        =>  'required|exists:persons,id',
                            ];
    protected $rules_store_array = [
                                        'emails'                    =>  'required|array|min:1',
                                        'emails.*'                  =>  'required|email|max:45|unique:persons_emails,email',
                                        'emails.initial_register'   =>  'nullable|regex:/^[0-1]$/',
                                        'persons_id'                =>  'required|exists:persons,id',

                                    ];
    protected $rules_email_exist = [
                                        'email' => 'required|email|max:45'
                                    ];
    protected $rules_emails_exists = [
                                        'emails'    =>  'required|array|min:1',
                                        'emails.*'  =>  'required|email|max:45',
                                    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Search email.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emailExists(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_email_exist);
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
            return response()->json(
                                    array(
                                            'status'    =>  200,
                                            'exist'      =>  PersonEmail::emailExist( $request->email )
                                        ),
                                    200
                                );
        }
    }

    /**
     * Search emailes.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emailsExists(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_emails_exists);
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
            $array_validate = array();
            $exists = false;
            foreach( $request->emails as $key => $val )
            {
                $email_exists = PersonEmail::emailExist( $val );
                $exists = $exists ? $exists : $email_exists;
                $array_validate[] = [
                                        'exists'    => $email_exists,
                                        'email'     => $val
                                    ];
            }

            return response()->json(
                                    array(
                                            'status'    =>  200,
                                            'exists'    =>  $exists,
                                            'validate'  =>  $array_validate
                                        ),
                                    200
                                );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeArray(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_store_array);
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
            $arrays_ids = array();
            foreach( $request->emails as $key => $val )
            {
                $email = new PersonEmail();
                $email->email = $val;
                $email->persons_id = $request->persons_id;
                if( $request->initial_register)
                {
                    $email->initial_register = $request->initial_register;
                }

                if( $email->save() )
                {
                    $arrays_ids[] = $email->id;
                }else{
                    return response()->json(
                                                array(
                                                        'status'    =>  400,
                                                        'data'      =>  array(
                                                                                "msg"    => "Error saving the new person email in the database"
                                                                            )
                                                    ),
                                                400
                                            );
                }

            }

            if( count($arrays_ids) > 0 )
            {
                return response()->json(
                                        array(
                                                'status'    =>  201,
                                                'data'      =>  array(
                                                                        "ids"    => $arrays_ids
                                                                    )
                                            ),
                                        201
                                    );
            }else{
                return response()->json(
                                                array(
                                                        'status'    =>  400,
                                                        'data'      =>  array(
                                                                                "msg"    => "Error saving the new persons emails in the database"
                                                                            )
                                                    ),
                                                400
                                            );
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonEmail  $personEmail
     * @return \Illuminate\Http\Response
     */
    public function show(PersonEmail $personEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonEmail  $personEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonEmail $personEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonEmail  $personEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonEmail $personEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonEmail  $personEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonEmail $personEmail)
    {
        //
    }
}
