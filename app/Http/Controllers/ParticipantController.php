<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Participant;
use App\Models\PersonEmail;
use Laravolt\Avatar\Avatar;
use App\CustomClass\Helpers;
use Illuminate\Http\Request;
use App\Models\PersonCellphone;
use Illuminate\Support\Facades\DB;
use App\Models\LogStateParticipant;

class ParticipantController extends Controller
{
    protected $rules_store = [
                                'persons_id'                =>  'required|integer|exists:persons,id',
                                'programmers_id'            =>  'required|integer|exists:programmers,id',
                                'users_id'                  =>  'nullable|integer|exists:users,id',
                                'profiles_participants_id'  =>  'required|integer|exists:profiles_participants,id',
                                'description'               =>  'nullable|min:2',

                            ];
    protected $rules_update = [
                                'id'                        =>  'required|integer|exists:participants,id',
                                'persons_id'                =>  'nullable|integer|exists:persons,id',
                                'programmers_id'            =>  'nullable|integer|exists:programmers,id',
                                'users_id'                  =>  'nullable|integer|exists:users,id',
                                'profiles_participants_id'  =>  'nullable|integer|exists:profiles_participants,id',
                                'description'               =>  'nullable|min:2',
                                'profile_image'             =>  'nullable|min:5',

                            ];
    protected $rules_list_participants = [
                                            'programmers_id'    =>  'required|integer|exists:programmers,id',
                                            'users_id'          =>  'nullable|integer|exists:users,id',
                                            'search'            =>  'nullable|min:1',
                                            'page'              =>  'required|integer|min:1',
                                            'perPage'           =>  'required|integer|min:1',
                                        ];
    protected $rules_list_participants_leaders_suplents =   [
                                                                'programmers_id'    =>  'required|integer|exists:programmers,id',
                                                                'users_id'          =>  'nullable|integer|exists:users,id',
                                                            ];
    protected $rules_avatar =   [
                                    'name' => 'required|min:1'
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
     * Return a image string64 from string
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAvatarFromString( Request $request )
    {
        $validator = Validator::make($request->input(), $this->rules_avatar);
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
            $avatar = new Avatar();
            $avatar64 = $avatar->create( strtoupper( $request->name ) )
                                ->setBackground('#CCCCCC')
                                ->setBorder(1,'#CCCCCC')
                                ->setDimension( 128 )
                                ->setFontSize( 72 )
                                ->toBase64();

            return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'avatar'    =>  $avatar64
                                            ),
                                        200
                                    );
        }
    }

    /**
     * Return a list of particpants and your data from ID participant
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
                                                'error'     =>  __('messages.bad_request'),
                                                'data'      =>  $validator->getMessageBag()->toArray()
                                            ),
                                        400
                                    );
        }else
        {
            $user_id = $request->users_id;
            $search = $request->search;

            $totalData = Participant::leftJoin('persons','persons_id','persons.id')
                                        ->where('participants.programmers_id', $request->programmers_id)
                                        ->when( $search, function( $query, $search ){
                                            return $query->where(
                                                                    DB::raw('CONCAT(persons.first_name," ",persons.last_name)'),'LIKE', '%'. $search .'%'
                                                                );
                                        } )
                                        ->when( $user_id, function( $query, $user_id ){
                                            return $query->whereNull('participants.users_id')
                                                        ->orWhere('participants.users_id','!=', $user_id);
                                        } )
                                        ->count();

            $totalFiltered = $totalData;
            $limit = $request->perPage;
            $start = ($request->page - 1) * $limit;

            $participants = Participant::leftJoin('persons','persons_id','persons.id')
                                        ->select(
                                                    'participants.id','participants.programmers_id','participants.users_id',
                                                    'participants.profiles_participants_id','participants.description',
                                                    'participants.status_participants_id',
                                                    'persons.id AS persons_id','persons.first_name','persons.last_name',
                                                    'persons.birth_date','persons.position_company','persons.date_join_company',
                                                )
                                        ->where('participants.programmers_id', $request->programmers_id)
                                        ->when( $search, function( $query, $search ){
                                            return $query->where(
                                                                    DB::raw('CONCAT(persons.first_name," ",persons.last_name)'),'LIKE', '%'. $search .'%'
                                                                );
                                        } )
                                        ->when( $user_id, function( $query, $user_id ){
                                            return $query->whereNull('participants.users_id')
                                                        ->orWhere('participants.users_id','!=', $user_id);
                                        } )
                                        ->orderBy('persons.first_name')
                                        ->offset($start)
                                        ->limit($limit)
                                        ->get();

            //Search logs status participants, emails and cellphones
            foreach($participants as $index => $participant)
            {

                //logs status participants
                $log = LogStateParticipant::where('participants_id',$participant->id)
                                            ->latest()
                                            ->first();
                $participant['log_status'] = $log;
                $participants[ $index ] = $participant;
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
                                                'status'            =>  200,
                                                'recordsTotal'      => intval($totalData),
                                                'participants'      =>  $participants
                                            ),
                                        200
                                    );
        }
    }

    /**
     * Return a list of particpants leaders/admins suplent and your data from ID participant
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listLeadersSuplentsFromProgrammer(Request $request)
    {
       $validator = Validator::make($request->input(), $this->rules_list_participants_leaders_suplents);
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
            $user_id = $request->users_id;
            $participants = Participant::leftJoin('persons','persons_id','persons.id')
                                        ->select(
                                                    'participants.id','participants.programmers_id','participants.users_id',
                                                    'participants.profiles_participants_id','participants.description',
                                                    'participants.status_participants_id',
                                                    'persons.id AS persons_id','persons.first_name','persons.last_name',
                                                    'persons.birth_date','persons.position_company','persons.date_join_company',
                                                )
                                        ->where('participants.programmers_id', $request->programmers_id)
                                        ->whereIn('participants.profiles_participants_id', [
                                                                                                Participant::PROFILES_PARTICIPANTS_LEADER,
                                                                                                Participant::PROFILES_PARTICIPANTS_SUPLE_ADMIN
                                                                                            ])
                                        ->when( $user_id, function( $query, $user_id ){
                                            return $query->whereNull('participants.users_id')
                                                        ->orWhere('participants.users_id','!=', $user_id);
                                        } )
                                        ->orderBy('persons.first_name')
                                        ->get();

            return response()->json(
                                        array(
                                                'status'            =>  200,
                                                'participants'      =>  $participants
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
                                                'error'     =>  __('messages.bad_request'),
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
                                                                        "msg"    => __('messages.error_saving', [ 'attribute' => __('validation.attributes.participant') ])
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
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
            //search participant
            $participant = Participant::find( $request->id );

            //Not found
            if( empty($participant) )
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
            $extra = null; //Aditional data for request
            if( isset( $request->persons_id ) )
            {
                $participant->persons_id = $request->persons_id;
            }

            if( isset( $request->programmers_id ) )
            {
                $participant->programmers_id = $request->programmers_id;
            }

            if( isset( $request->profiles_participants_id ) )
            {
                $participant->profiles_participants_id = $request->profiles_participants_id;
            }

            if( isset( $request->description ) )
            {
                $participant->description = $request->description;
            }

            if( isset( $request->profile_image ) )
            {
                $name_image = empty($participant->profile_image) ? hash( 'md5', $participant->id .'-'. $participant->persons_id .'-'. $participant->programmers_id ) : $participant->profile_image;
                $res_image = Helpers::saveImageString64($request->profile_image, $name_image, Helpers::OPTION_DIR_IMAGE_PROFILE);
                if( isset($res_image) )
                {
                    $participant->profile_image = $res_image;
                    $extra = $res_image;
                }
            }

            if( isset( $request->users_id ) )
            {
                $participant->users_id = $request->users_id;
            }

            if( $participant->update() )
            {
                return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      =>  array(
                                                                        "id"    => $participant->id,
                                                                        "extra" => $extra
                                                                    )
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
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
