<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('user', 'password');
        $credentials['status_users_id'] = 1;//Activo

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return response()->json(
                                        array(
                                                'status'    => 200,
                                            ),
                                        200
            );
        }

         return response()->json(
                                    array(
                                            'status'    =>  204,
                                            'error'     =>  "Sin contenido",
                                            'data'      =>  array( trans('auth.failed') )
                                        ),
                                    200
                                );
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(
                                    array(
                                            'status'    => 200,
                                        ),
                                    200
        );
    }
}
