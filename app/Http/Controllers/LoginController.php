<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotLogin;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login user
     *
     * @param  LoginRequest $request
     * @return UserResource|string
     */
    public function login( LoginRequest $request ): UserResource|string
    {
        if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ] ) ) {
            $user = Auth::user();
            $user->token = $user->createToken( 'AuthStore' )->accessToken;

            return UserResource::make( $user );
        }

        throw new UserNotLogin('User unauthorized');

    }
}
