<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UpdatedPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $rules_id = [ 'id' => 'required|exists:users,id' ];
    protected $rules_store =    [
                                    'name'              =>  'required|max:200',
                                    'user'              =>  'required|max:45|unique:users,user',
                                    'password'          =>  'required|min:8',
                                    'roles_id'          =>  'required|exists:roles,id',
                                    'status_users_id'   =>  'required|exists:status_users,id',
                                ];
    protected $rules_update =    [
                                    'id'                =>  'required|exists:users,id',
                                    'name'              =>  'nullable|max:200',
                                    'user'              =>  'nullable|max:45|unique:users,user',
                                    'password'          =>  'nullable|min:8',
                                    'roles_id'          =>  'nullable|exists:roles,id',
                                    'status_users_id'   =>  'nullable|exists:status_users,id',
                                ];
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
            $user = new User();
            $user->name = $request->name;
            $user->user = $request->user;
            $user->password = Hash::make( $request->password );
            $user->roles_id = $request->roles_id;
            $user->status_users_id = $request->status_users_id;

            //save new user
            if( $user->save() )
            {
              return response()->json(
                                        array(
                                                'status'    =>  201,
                                                'data'      =>  array(
                                                                        "id"    => $user->id
                                                                    )
                                            ),
                                        201
                                    );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => __('messages.error_saving', [ 'attribute' => __('validation.attributes.user') ])
                                                                    )
                                            ),
                                        400
                                    );
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
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
            }

            //update
            if( isset( $request->name ) )
            {
                $user->name = $request->name;
            }
            if( isset( $request->user ) )
            {
                $user->user = $request->user;
            }
            if( isset( $request->password ) )
            {
                $user->password = Hash::make( $request->password );
            }
            if( isset( $request->roles_id ) )
            {
                $user->roles_id = $request->roles_id;
            }
            if( isset( $request->status_users_id ) )
            {
                $user->status_users_id = $request->status_users_id;
            }

            if( $user->update() )
            {
                return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      => $user
                                            ),
                                        200
                                    );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => __('messages.error_updating', [ 'attribute' => __('validation.attributes.user') ])
                                                                    )
                                            ),
                                        400
                                    );
        }
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
                            //Register updated password with current password
                            $old_password = new UpdatedPassword();
                            $old_password->old_password = Hash::make( $request->password );
                            $old_password->created = $user->updated_at;
                            $old_password->users_id = $user->id;
                            $old_password->save();
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
