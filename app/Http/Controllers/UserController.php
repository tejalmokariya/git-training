<?php

namespace App\Http\Controllers;

use App\Helpers\Passport\Token;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\OauthAccessToken;
use Illuminate\Http\Request;
use App\Http\Request\updateUserEmail;


use Illuminate\Support\Facades\Validator;
use App\Services\UserService;

class UserController extends BaseController
{

    public function login(Request $request)
    {

        if ($request->method() == "GET") {
            return $this->userError('Unauthorized');
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        $collection = $request->except(['_token', '_method']);
        $user = UserService::create($request);
        return $this->sendResponse($user, 'Logged in');
    }


    public function logout(Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'id' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Error validation', $validator->errors());
            }

            $deviceInfo = OauthAccessToken::where('user_id', $input['id'])->delete();
            if ($deviceInfo) {
                return $this->sendResponse($input['id'], 'User logout successfully.');
            } else {
                return $this->sendError($input['id'], 'invalid user.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


   
}
