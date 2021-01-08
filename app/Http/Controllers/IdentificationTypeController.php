<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentificationType;

class IdentificationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Return a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $types = IdentificationType::all();
        $lang = app()->getLocale();

        foreach( $types as $key => $value )
        {
            $translation = $value->translations()->where('language',$lang)->first();
            $value['translation'] = $translation;
            $types[ $key ] = $value;
        }

        return response()->json(
                                        array(
                                                'status'                =>  200,
                                                'identifications_types' =>  $types,

                                            ),
                                        200
                                    );
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
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentificationType $identificationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationType $identificationType)
    {
        //
    }
}
