<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Participant;
use App\Models\PersonEmail;
use Illuminate\Http\Request;
use App\Models\PersonCellphone;

class ParticipantController extends Controller
{
    protected $rules_store = [
                                'persons_id'                =>  'required|integer|exists:persons,id',
                                'programmers_id'            =>  'required|integer|exists:programmers,id',
                                'users_id'                  =>  'nullable|integer|exists:users,id',
                                'profiles_participants_id'  =>  'required|integer|exists:profiles_participants,id',
                                'description'               =>  'nullable|min:2|',

                            ];
    protected $rules_list_participants = [
                                            'programmers_id'    =>  'required|integer|exists:programmers,id',
                                            'users_id'          =>  'nullable|integer|exists:users,id',
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
     * Return a list of particpants and your data from ID programmer
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listFromProgrammer(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_list_participants);
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
            $user_id = $request->users_id;
            $participants = Participant::leftJoin('persons','persons_id','persons.id')
                                        ->select(
                                                    'participants.id','participants.programmers_id','participants.users_id',
                                                    'participants.profiles_participants_id','participants.description',
                                                    'persons.id AS persons_id','persons.first_name','persons.last_name',
                                                    'persons.birth_date','persons.position_company','persons.date_join_company',
                                                )
                                        ->where('participants.programmers_id', $request->programmers_id)
                                        ->when( $user_id, function( $query, $user_id ){
                                            return $query->whereNull('participants.users_id')
                                                        ->orWhere('participants.users_id','!=', $user_id);
                                        } )
                                        ->get();
            //Search emails and cellphones
            foreach($participants as $index => $participant)
            {
                //Search emails
               $emails = PersonEmail::where('persons_id', $participant->persons_id )
                                    ->get();
                $participant['emails'] = $emails;
                $participants[ $index ] = $participant;
                //Search cellphones
               $mobiles = PersonCellphone::where('persons_id', $participant->persons_id )
                                    ->get();
                $participant['cellphones'] = $mobiles;
                $participants[ $index ] = $participant;
            }
            return response()->json(
                                        array(
                                                'status'        =>  200,
                                                'participants'  =>  $participants
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
