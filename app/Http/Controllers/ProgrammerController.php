<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Programmer;
use App\CustomClass\Helpers;
use Illuminate\Http\Request;

class ProgrammerController extends Controller
{
    protected $rules_update = [
                                'id'                            =>  'required|integer|exists:programmers,id',
                                'entity_name'                   =>  'nullable|min:2|max:120',
                                'identifications_types_id'      =>  'nullable|integer|exists:identifications_types,id',
                                'identification'                =>  'nullable|min:5|max:100',
                                'logo'                          =>  'nullable|min:5',
                                'activated_birthday'            =>  'nullable|regex:/^[0-1]$/',
                                'activated_date_join_company'   =>  'nullable|regex:/^[0-1]$/',
                                'activated_tax_calendar'        =>  'nullable|regex:/^[0-1]$/',
                                'activated_car_tax'             =>  'nullable|regex:/^[0-1]$/',
                                'activated_ss_tax'              =>  'nullable|regex:/^[0-1]$/',

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
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function show(Programmer $programmer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Programmer $programmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
            $programmer = Programmer::find( $request->id );
            //Not found
            if( empty( $programmer ) )
            {
                return response()->json(
                                            array(
                                                'status'    =>  204,
                                                'error'     =>  __('messages.no_content'),
                                                'data'      =>  array(
                                                                        __('messages.no_found', [
                                                                                                    'attribute' => __('validation.attributes.programmer'),
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
            if( isset( $request->entity_name ) )
            {
                $programmer->entity_name = $request->entity_name;
            }
            if( isset( $request->identifications_types_id ) )
            {
                $programmer->identifications_types_id = $request->identifications_types_id;
            }
            if( isset( $request->identification ) )
            {
                $programmer->identification = $request->identification;
            }
            if( isset( $request->logo ) )
            {
                $name_image = empty($programmer->logo) ? hash( 'md5', $programmer->id .'-'. $programmer->entity_name .'-'. $programmer->identification ) : $programmer->logo;
                $res_image = Helpers::saveImageString64($request->logo, $name_image, Helpers::OPTION_DIR_IMAGE_LOGO);
                if( isset($res_image) )
                {
                    $programmer->logo = $res_image;
                    $extra = $res_image;
                }
            }
            if( isset( $request->activated_birthday ) )
            {
                $programmer->activated_birthday = $request->activated_birthday;
            }
            if( isset( $request->activated_date_join_company ) )
            {
                $programmer->activated_date_join_company = $request->activated_date_join_company;
            }
            if( isset( $request->activated_tax_calendar ) )
            {
                $programmer->activated_tax_calendar = $request->activated_tax_calendar;
            }
            if( isset( $request->activated_car_tax ) )
            {
                $programmer->activated_car_tax = $request->activated_car_tax;
            }
            if( isset( $request->activated_ss_tax ) )
            {
                $programmer->activated_ss_tax = $request->activated_ss_tax;
            }

            if( $programmer->update() )
            {
                return response()->json(
                                        array(
                                                'status'    =>  200,
                                                'data'      =>  array(
                                                                        "id"    => $programmer->id,
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
                                                                        "msg"    => __('messages.error_updating', [ 'attribute' => __('validation.attributes.programmer') ])
                                                                    )
                                            ),
                                        400
                                    );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programmer  $programmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programmer $programmer)
    {
        //
    }
}
