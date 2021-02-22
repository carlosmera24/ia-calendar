<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $rules_id = [ 'id' => 'required|exists:users,id' ];
    protected $rules_update_password =  [
                                            'id'                    =>  'required|exists:users,id',
                                            'password'              =>  'required',
                                            'new_password'          =>  'required',
                                            'confirmation_password' =>  'required',
                                        ];

    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * Return the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data( Request $request )
    {
        $validator = Validator::make($request->input(), $this->rules_id);
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
            //search Usuario
            $user = User::find( $request->id );

            //Not found
            if( empty($user) )
            {
                return response()->json(
                                            array(
                                                'status'    =>  204,
                                                'error'     =>  __('messages.no_content'),
                                                'data'      =>  array(
                                                                        __('messages.no_found', [
                                                                                                    'attribute' => __('validation.attributes.user'),
                                                                                                    'id' => $request->id
                                                                                                ]
                                                                            )
                                                                    )
                                            ),
                                            200
                                        );
            }else{
                return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      =>  $user,
                                            ),
                                        200
                                    );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_update_password);
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
            //search user
            $user = User::find( $request->id );

            //Not found
            if( empty($user) )
            {
                return response()->json(
                                            array(
                                                'status'    =>  204,
                                                'error'     =>  __('messages.no_content'),
                                                'data'      =>  array(
                                                                        __('messages.no_found', [
                                                                                                    'attribute' => __('validation.attributes.user'),
                                                                                                    'id' => $request->id
                                                                                                ]
                                                                            )
                                                                    )
                                            ),
                                            200
                                        );
            }else
            {
                //validate password
                if( Hash::check( $request->password, $user->password ) )
                {
                    //check passwords
                    if( $request->new_password === $request->confirmation_password )
                    {
                        $user->password = Hash::make( $request->new_password );
                        if( $user->update() )
                        {
                            //Logout other devices
                            Auth::logoutOtherDevices( $request->new_password );
                            return response()->json(
                                                        array(
                                                                'status'    =>  200,
                                                                'data'      =>  $user,
                                                            ),
                                                        200
                                                    );
                        }
                    }else{
                       return response()->json(
                                                    array(
                                                            'status'    =>  400,
                                                            'error'     =>  __('messages.bad_request'),
                                                            'data'      =>  array( __('validation.custom.password.not_match', [
                                                                                                                                    'attribute' => __('validation.attributes.password'),
                                                                                                                                ])
                                                                                )
                                                        ),
                                                    200
                                                );
                    }
                }else{
                    return response()->json(
                                                array(
                                                        'status'    =>  403,
                                                        'error'     =>  __('messages.forbidden'),
                                                        'data'      =>  array( __('auth.failed') )
                                                    ),
                                                200
                                            );
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
