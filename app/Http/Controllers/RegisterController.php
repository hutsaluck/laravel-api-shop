<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Register user
     *
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register( RegisterRequest $request )
    {
        $user = User::create($request->validated());
        $user->password = bcrypt( $user->password );
        $user->token = $user->createToken( 'AuthStore' )->accessToken;

        return UserResource::make($user);
    }
}
