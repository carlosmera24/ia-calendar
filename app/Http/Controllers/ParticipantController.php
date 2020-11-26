<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Validator;

class ParticipantController extends Controller
{
    protected $rules_store = [
                                'persons_id'                =>  'required|integer|exists:persons,id',
                                'programmers_id'            =>  'required|integer|exists:programmers,id',
                                'users_id'                  =>  'nullable|integer|exists:users,id',
                                'profiles_participants_id'  =>  'required|integer|exists:profiles_participants,id',
                                'description'               =>  'nullable|min:2|',

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
                                                'error'     =>  "BadRequest",
                                                'data'      =>  $validator->getMessageBag()->toArray()
                                            ),
                                        400
                                    );
        }else
        {
            $participe = new Participant();
            $participe->persons_id = $request->persons_id;
            $participe->programmers_id = $request->programmers_id;
            $participe->users_id = $request->users_id;
            $participe->profiles_participants_id = $request->profiles_participants_id;
            $participe->description = $request->description;
            // if( isset($request->users_id) )
            // {
            //     $participe->users_id = $request->users_id;
            // }
            // if( isset($request->description) )
            // {
            //     $participe->description = $request->description;
            // }

            //save new participant
            if( $participe->save() )
            {
              return response()->json(
                                        array(
                                                'status'    =>  201,
                                                'data'      =>  array(
                                                                        "id"    => $participe->id
                                                                    )
                                            ),
                                        201
                                    );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => "Error saving the new participant in the database"
                                                                    )
                                            ),
                                        400
                                    );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
