<?php

namespace App\Http\Controllers;

use App\Models\PersonCellphone;
use Illuminate\Http\Request;
use Validator;

class PersonCellphoneController extends Controller
{
    protected $rules_cellphones_person =    [
                                                'persons_id'        =>  'required|exists:persons,id',
                                            ];
    protected $rules_store =    [
                                    'mobile'             =>  'required|regex:/^\d{10,12}/|unique:persons_cellphones',
                                    'initial_register'  =>  'nullable|regex:/^[0-1]$/',
                                    'persons_id'        =>  'required|exists:persons,id',
                                ];
    protected $rules_store_array = [
                                        'mobiles'                   =>  'required|array|min:1',
                                        'mobiles.*'                 =>  'required|regex:/^\d{10,12}/|unique:persons_cellphones,cellphone_number',
                                        'mobiles.initial_register'  =>  'nullable|regex:/^[0-1]$/',
                                        'persons_id'                =>  'required|exists:persons,id',

                                    ];
    protected $rules_mobile_exists = [
                                        'mobile' => 'required|regex:/^\d{10,12}/'
                                    ];
    protected $rules_mobiles_exists = [
                                        'mobiles'   =>  'required|array|min:1',
                                        'mobiles.*' =>  'required|regex:/^\d{10,12}/',
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
     * List of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cellphonesForPerson(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_cellphones_person);
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
            $phones = PersonCellphone::where('persons_id', $request->persons_id)
                                        ->get();

            return response()->json(
                                    array(
                                            'status'        =>  200,
                                            'cellphones'    =>  $phones
                                        ),
                                    200
                                );
        }
    }

    /**
     * Search email.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cellphoneExists(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_mobile_exists);
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
                                            'exist'      =>  PersonCellphone::cellphoneExist( $request->mobile )
                                        ),
                                    200
                                );
        }
    }

    /**
     * Search cellphones.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cellphonesExists(Request $request)
    {
        $validator = Validator::make($request->input(), $this->rules_mobiles_exists);
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
            foreach( $request->mobiles as $key => $val )
            {
                $mobile_exists = PersonCellphone::cellphoneExist( $val );
                $exists = $exists ? $exists : $mobile_exists;
                $array_validate[] = [
                                        'exists'    => $mobile_exists,
                                        'mobile'     => $val
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
            foreach( $request->mobiles as $key => $val )
            {
                $mobile = new PersonCellphone();
                $mobile->cellphone_number = $val;
                $mobile->persons_id = $request->persons_id;
                if( $request->initial_register)
                {
                    $mobile->initial_register = $request->initial_register;
                }

                if( $mobile->save() )
                {
                    $arrays_ids[] = $mobile->id;
                }else{
                    return response()->json(
                                                array(
                                                        'status'    =>  400,
                                                        'data'      =>  array(
                                                                                "msg"    => "Error saving the new person cellphone in the database"
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
                                                                                "msg"    => "Error saving the new persons cellphones in the database"
                                                                            )
                                                    ),
                                                400
                                            );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonCellphone  $personCellphone
     * @return \Illuminate\Http\Response
     */
    public function show(PersonCellphone $personCellphone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonCellphone  $personCellphone
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonCellphone $personCellphone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonCellphone  $personCellphone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonCellphone $personCellphone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonCellphone  $personCellphone
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonCellphone $personCellphone)
    {
        //
    }
}
