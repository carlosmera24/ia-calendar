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
                                                'error'     =>  "BadRequest",
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
                                                });
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
        //
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
