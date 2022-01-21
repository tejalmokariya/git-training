<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function create(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
        $token = $user->createToken('mytoken')->accessToken;

        $success = [
            'token' => $token,
            'user' => $user,

        ];
        return $success;
    }
}
