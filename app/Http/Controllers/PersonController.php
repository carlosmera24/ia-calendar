<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Validator;

class PersonController extends Controller
{
    protected $rules_store =    [
                                    'first_name'        =>  'required | min:3 | max:100',
                                    'last_name'         =>  'required | min:3 | max:100',
                                    'birth_date'        =>  'required | date_format:Y-m-d',
                                    'position_company'  =>  'required | min:3 | max:60',
                                    'date_join_company' =>  'required | date_format:Y-m-d',
                                ];
    protected $rules_update =   [
                                    'id'                =>  'required|exists:persons,id',
                                    'first_name'        =>  'nullable | min:3 | max:100',
                                    'last_name'         =>  'nullable | min:3 | max:100',
                                    'birth_date'        =>  'nullable | date_format:Y-m-d',
                                    'position_company'  =>  'nullable | min:3 | max:60',
                                    'date_join_company' =>  'nullable | date_format:Y-m-d',
                                ];
    protected $rules_id = [ 'id' => 'required|exists:persons,id' ];

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
            $person = new Person();
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->birth_date = $request->birth_date;
            $person->position_company = $request->position_company;
            $person->date_join_company = $request->date_join_company;

            //save new person
            if( $person->save() )
            {
              return response()->json(
                                        array(
                                                'status'    =>  201,
                                                'data'      =>  array(
                                                                        "id"    => $person->id
                                                                    )
                                            ),
                                        201
                                    );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => __('messages.error_saving', [ 'attribute' => __('validation.attributes.person') ])
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
            //search Person
            $person = Person::find( $request->id );

            //Not found
            if( empty($person) )
            {
                return response()->json(
                                            array(
                                                'status'    =>  204,
                                                'error'     =>  __('messages.no_content'),
                                                'data'      =>  array(
                                                                        __('messages.no_found', [
                                                                                                    'attribute' => __('validation.attributes.person'),
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
                                                'data'      =>  $person,
                                            ),
                                        200
                                    );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
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
            //search Person
            $person = Person::find( $request->id );

            //Not found
            if( empty($person) )
            {
                return response()->json(
                                            array(
                                                'status'    =>  204,
                                                'error'     =>  __('messages.no_content'),
                                                'data'      =>  array(
                                                                        __('messages.no_found', [
                                                                                                    'attribute' => __('validation.attributes.person'),
                                                                                                    'id' => $request->id
                                                                                                ]
                                                                            )
                                                                    )
                                            ),
                                            200
                                        );
            }

            //Update
            if( isset( $request->first_name ) )
            {
                $person->first_name = $request->first_name;
            }

            if( isset( $request->last_name ) )
            {
                $person->last_name = $request->last_name;
            }

            if( isset( $request->birth_date ) )
            {
                $person->birth_date = $request->birth_date;
            }

            if( isset( $request->position_company ) )
            {
                $person->position_company = $request->position_company;
            }

            if( isset( $request->date_join_company ) )
            {
                $person->date_join_company = $request->date_join_company;
            }

            if( $person->update() )
            {

                return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      =>  $person,
                                            ),
                                        200
                                    );
            }

            return response()->json(
                                        array(
                                                'status'    =>  400,
                                                'data'      =>  array(
                                                                        "msg"    => __('messages.error_updating', [ 'attribute' => __('validation.attributes.person') ])
                                                                    )
                                            ),
                                        400
                                    );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
