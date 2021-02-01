<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\PersonEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PersonEmailController extends Controller
{
    protected $rules_store =    [
                                    'email'                     =>  'required|email|max:45|unique:persons_emails',
                                    'initial_register'          =>  'nullable|regex:/^[0-1]$/',
                                    'used_events'               =>  'nullable|regex:/^[0-1]$/',
                                    'persons_id'                =>  'required|exists:persons,id',
                                    'status_persons_emails_id'  =>  'nullable|exists:status_persons_emails,id',
                                ];
    protected $rules_update =   [
                                    'email'                     =>  'nullable|email|max:45|unique:persons_emails',
                                    'initial_register'          =>  'nullable|regex:/^[0-1]$/',
                                    'used_events'               =>  'nullable|regex:/^[0-1]$/',
                                    'persons_id'                =>  'nullable|exists:persons,id',
                                    'status_persons_emails_id'  =>  'nullable|exists:status_persons_emails,id',
                                ];
    protected $rules_store_array =  [
                                        'emails'                    =>  'required|array|min:1',
                                        'emails.*'                  =>  'required|email|max:45|unique:persons_emails,email',
                                        'emails.initial_register'   =>  'nullable|regex:/^[0-1]$/',
                                        'emails.used_events'        =>  'nullable|regex:/^[0-1]$/',
                                        'persons_id'                =>  'required|integer|exists:persons,id',

                                    ];
    protected $rules_email_exist =  [
                                        'email' => 'required|email|max:45'
                                    ];
    protected $rules_emails_exists =    [
                                            'emails'    =>  'required|array|min:1',
                                            'emails.*'  =>  'required|email|max:45',
                                        ];
    protected $rules_emails_admin = [
                                        'persons_id'    =>  'required|integer|exists:persons,id',
                                        'option'        =>  'nullable|regex:/^[0-2]$/', //0:All, 1: Initial register, 2: Used events
                                    ];
    protected $rules_confirm_email =    [
                                            'data'  =>  'required|min:100',
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
     * Return emailes.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEmailsAdmin(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_emails_admin);
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
            $initial = $request->option === 1 ? true : false;
            $used_events = $request->option === 2 ? true : false;

            $emails = PersonEmail::where('persons_id', $request->persons_id )
                                ->when( $initial, function( $query ){
                                        return $query->where('initial_register', PersonEmail::INITIAL_REGISTER_YES);
                                    })
                                ->when( $used_events, function( $query ){
                                        return $query->where('used_events', PersonEmail::USED_EVENTS_YES);
                                    })
                                ->get();

            return response()->json(
                                    array(
                                            'status'    =>  200,
                                            'emails'    =>  $emails,
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
        $validator = Validator::make($request->input(), $this->rules_store);
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
            $email = new PersonEmail();
            $email->email = $request->email;
            $email->persons_id = $request->persons_id;
            if( isset($request->initial_register) )
            {
                $email->initial_register = $request->initial_register;
            }
            if( isset($request->used_events) )
            {
                $email->used_events = $request->used_events;
            }
            if( isset($request->status_persons_emails_id) )
            {
                $email->status_persons_emails_id = $request->status_persons_emails_id;
            }

            //save new participant
            if( $email->save() )
            {
                if( isset( $request->used_events ) && $request->used_events == PersonEmail::USED_EVENTS_YES )
                {
                    //Send email
                    PersonEmail::sendEmailConfirmation( $email );
                    $email->status_persons_emails_id = PersonEmail::STATUS_PERSONS_EMAILS_CONFIRMING;
                    $email->update();
                }

                return response()->json(
                                            array(
                                                    'status'    =>  201,
                                                    'data'      =>  $email
                                                ),
                                            201
                                        );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => __('messages.error_saving', [ 'attribute' => __('validation.attributes.participant') ])
                                                                    )
                                            ),
                                        400
                                    );
        }
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
                if( $request->used_events)
                {
                    $email->used_events = $request->used_events;
                }

                if( $email->save() )
                {
                    $arrays_ids[] = $email->id;
                }else{
                    return response()->json(
                                                array(
                                                        'status'    =>  400,
                                                        'data'      =>  array(
                                                                                "msg"    => __('messages.error_saving', [ 'attribute' => __('validation.attributes.participant') ])
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
                                                                                "msg"    => __('messages.error_saving', [ 'attribute' => __('validation.attributes.participant') ])
                                                                            )
                                                    ),
                                                400
                                            );
            }
        }
    }

    public function confirmEmail( Request $request )
    {
        $data = null;
        $code = 200;

        if( isset($request->data ) )
        {
            //Decrypt params
            $params = Crypt::decrypt( $request->data ); // id => value
            //Get email
            $person_email = PersonEmail::find( $params['id'] );
            if( isset( $person_email ) )
            {
                $data = [ 'exists' => true ];
                if( $person_email->status_persons_emails_id == PersonEmail::STATUS_PERSONS_EMAILS_ACTIVE )
                {
                    $data['actived'] = true;
                }else //Confirm email
                {
                    $data['actived'] = false;
                    $person_email->status_persons_emails_id = PersonEmail::STATUS_PERSONS_EMAILS_ACTIVE;
                    $person_email->update();
                }
                $data['person_email'] = $person_email;
            }else{
                $data = [ 'exists' => false ];
            }
        }else{
            $data = [
                        'fails' => [
                                        'error' => __('messages.bad_request'),
                                        'data'  => __('validation.required', ['attribute' => 'data']),
                                    ]
                    ];
            $code = 400;
        }

        return response()->view( 'persons-emails.confirmation', $data, $code );
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
        $validator = Validator::make($request->input(), $this->rules_update);
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
            //search PersonEmail
            $email = PersonEmail::find( $request->id );

            //Not found
            if( empty($email) )
            {
                return response()->json(
                                            array(
                                                'status'    =>  204,
                                                'error'     =>  __('messages.no_content'),
                                                'data'      =>  array(
                                                                        __('messages.no_found', [
                                                                                                    'attribute' => __('validation.attributes.participant'),
                                                                                                    'id' => $request->id
                                                                                                ]
                                                                            )
                                                                    )
                                            ),
                                            200
                                        );
            }

            //Update
            if( isset( $request->email ) )
            {
                $email->email = $request->email;
            }

            if( isset( $request->initial_register ) )
            {
                $email->initial_register = $request->initial_register;
            }

            if( isset( $request->used_events ) )
            {
                $email->used_events = $request->used_events;
            }

            if( isset( $request->persons_id ) )
            {
                $email->persons_id = $request->persons_id;
            }

            if( isset( $request->status_persons_emails_id ) )
            {
                $email->status_persons_emails_id = $request->status_persons_emails_id;
            }

            if( $email->update() )
            {
                if( isset( $request->used_events ) && $request->used_events == PersonEmail::USED_EVENTS_YES )
                {
                    //Send email
                    PersonEmail::sendEmailConfirmation( $email );
                    $email->status_persons_emails_id = PersonEmail::STATUS_PERSONS_EMAILS_CONFIRMING;
                    $email->update();
                }

                return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      =>  $email,
                                            ),
                                        200
                                    );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => __('messages.error_updating', [ 'attribute' => __('validation.attributes.participant') ])
                                                                    )
                                            ),
                                        400
                                    );
        }
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
