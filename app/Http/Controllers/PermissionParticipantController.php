<?php

namespace App\Http\Controllers;

use App\Models\PermissionParticipant;
use Illuminate\Http\Request;
use Validator;

class PermissionParticipantController extends Controller
{
    protected $rules_list_permissions = [
                                            'participants_id'   =>  'required|integer|exists:participants,id',
                                            'permissions_ids'    =>  'nullable|array||min:1',
                                            'permissions_ids.*'  =>  'required|integer|exists:permissions,id',
                                        ];
    protected $rules_store = [
                                'participants_id'       =>  'required|integer|exists:participants,id',
                                'permissions_ids'       =>  'required|array||min:1',
                                'permissions_ids.*.id'    =>  'required|integer|exists:permissions,id',
                                'permissions_ids.*.value' =>  'required|boolean',
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
     * List permissioons for the participant
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listPermissionsParticipant(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_list_permissions);
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
            $permissions_ids = $request->permissions_ids;
            $permissions = PermissionParticipant::where('participants_id', $request->participants_id )
                                                ->when($permissions_ids, function($query, $permissions_ids){
                                                    return $query->whereIn('permissions_id', $permissions_ids);
                                                })
                                                ->get();
            return response()->json(
                                        array(
                                                'status'        =>  200,
                                                'permissions'  =>  $permissions
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
            $result = array();
            foreach( $request->permissions_ids as $ids )
            {
                //search permission
                $permission = PermissionParticipant::where('participants_id', $request->participants_id)
                                                    ->where('permissions_id', $ids['id'])
                                                    ->first();

                $tmp = array( 'permissions_id' => $ids['id'], 'exists' => isset($permission) );

                if( isset($permission)  && !$ids['value'] )
                {
                    //Delete permission participant
                    $tmp['id'] = $permission->id;
                    $tmp['delete'] = $permission->delete();
                }else if( !isset($permission) && $ids['value'] )
                {
                    //Create new permission participant
                    $new = new PermissionParticipant();
                    $new->participants_id = $request->participants_id;
                    $new->permissions_id = $ids['id'];
                    $tmp['create'] = $new->save();
                    $tmp['id'] = $new->id;
                }
                $result[] = $tmp;
            }

            return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      =>  $result
                                            ),
                                        200
                                    );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermissionParticipant  $permissionParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(PermissionParticipant $permissionParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermissionParticipant  $permissionParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionParticipant $permissionParticipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermissionParticipant  $permissionParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionParticipant $permissionParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermissionParticipant  $permissionParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionParticipant $permissionParticipant)
    {
        //
    }
}
