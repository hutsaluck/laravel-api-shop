<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    public function register( RegisterRequest $request )
    {
        $user = User::create($request->validated());
        $user->password = bcrypt( $user->password );
        $user->token = $user->createToken( 'AuthStore' )->accessToken;

        return UserResource::make($user);
    }

    public function login( Request $request )
    {
        if ( Auth::attempt( [ 'email' => $request->email, 'password' => $request->password ] ) ) {
            $user = Auth::user();
            $user->token = $user->createToken( 'AuthStore' )->accessToken;

            return UserResource::make( $user );
        }

        return 'Unauthorised';
    }
}
