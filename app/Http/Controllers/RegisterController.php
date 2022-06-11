<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register user
     *
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register( RegisterRequest $request ): UserResource
    {
        $validator = $request->validated();
        $validator['password'] = Hash::make($validator['password']);
        $user = User::create( $validator );
        $user->token = $user->createToken( 'AuthStore' )->accessToken;

        return UserResource::make( $user );
    }
}
