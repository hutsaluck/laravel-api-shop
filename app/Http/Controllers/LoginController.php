<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login user
     *
     * @param  LoginRequest $request
     * @return UserResource|string
     */
    public function login( LoginRequest $request )
    {
        if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ] ) ) {
            $user = Auth::user();
            $user->token = $user->createToken( 'AuthStore' )->accessToken;

            return UserResource::make( $user );
        }

        return 'Unauthorised';
    }
}
