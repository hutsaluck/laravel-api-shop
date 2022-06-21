<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotLogin;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport;

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
//            $user->token = $user->createToken('token-name')->plainTextToken;
//            $user->token = $user->createToken( 'AuthStore' )->accessToken;
            $user->text_token = $user->createToken( 'AuthStore' )->plainTextToken;

            return [UserResource::make( $user ), $user->text_token];
        }

        throw new UserNotLogin('User unauthorized');

    }
}
