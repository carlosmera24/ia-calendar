<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\ParticipantCategorie;
use Illuminate\Http\Request;

class ParticipantCategorieController extends Controller
{
    protected $rules_list_categories = [
                                            'participants_id'   =>  'required|integer|exists:participants,id',
                                            'categories_ids'    =>  'nullable|array||min:1',
                                            'categories_ids.*'  =>  'required|integer|exists:permissions,id',
                                        ];
    protected $rules_store = [
                                'participants_id'   =>  'required|integer|exists:participants,id',
                                'categories_ids'    =>  'nullable|array|',
                                'categories_ids.*'  =>  'required|integer|exists:permissions,id',
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
     * List categories for the participant
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listParticipantCategorie(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_list_categories);
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
            $categories_ids = $request->categories_ids;
            $categories = ParticipantCategorie::where('participants_id', $request->participants_id )
                                                ->when($categories_ids, function($query, $categories_ids){
                                                    return $query->whereIn('categories_id', $categories_ids);
                                                })
                                                ->get();
            return response()->json(
                                        array(
                                                'status'        =>  200,
                                                'categories'    =>  $categories
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
            $ids_categories = $request->categories_ids;
            //Delete others categories
            $result['deleted'] = ParticipantCategorie::where('participants_id', $request->participants_id)
                                                    ->when( $ids_categories, function( $query, $ids_categories ){
                                                        return $query->whereNotIn('categories_id', $ids_categories);
                                                    } )
                                                    ->delete();
            //Store categories
            foreach( $ids_categories as $ids )
            {
                //validate if exist
                $cat = ParticipantCategorie::where('participants_id', $request->participants_id)
                                            ->where('categories_id',$ids)
                                            ->first();
                if( isset($cat) )
                {
                    $tmp['exists'] = true;
                    $tmp['id'] = $cat->id;
                }else{
                    $tmp = array( 'categories_id' => $ids );
                    $cat = new ParticipantCategorie();
                    $cat->categories_id = $ids;
                    $cat->participants_id = $request->participants_id;
                    $tmp['create'] = $cat->save();
                    $tmp['id'] = $cat->id;
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
     * @param  \App\Models\ParticipantCategorie  $participantCategorie
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipantCategorie $participantCategorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParticipantCategorie  $participantCategorie
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipantCategorie $participantCategorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParticipantCategorie  $participantCategorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParticipantCategorie $participantCategorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParticipantCategorie  $participantCategorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipantCategorie $participantCategorie)
    {
        //
    }
}
