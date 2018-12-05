<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);

        if($validator->fails()) {
            return $this->errorResponse('bad_request', 401);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse('bad_credentials', 404);
                }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->errorResponse('server_error', $e->getCode());
            }
        // all good so return the token
        return $this->successResponse('login_ok', [ 'token' => $token ]);
    }


    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return $this->successResponse('logout_ok');
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->errorResponse('server_error', $e->getCode());
        }
    }

}