<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class SignUpController extends Controller
{
	private $user, $defaultNumber;
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function signUp(request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => 'required',
			'username' => 'required|string',
			'email' => 'required|string',
            'password' => 'required|string'
		]);
		if ($validator->fails()) {
			$data = ['message' => $validator->errors()];
			return response()->json($data);
    }
        $credentials = $request->all();

        $user = User::create([
            'name'=>$request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            // 'password' => Hash::make($request->get('password')),
            'password' => $request->get('password'),

        ]);
        // dd($user);

        $token = JWTAuth::fromUser($user);

        // return response()->json(compact('user','token'),201);

		$data = array(
			'message' => 'User Register Successfully',
            'token' => $token,
			'result' => $user
		);

		return response()->json($data,201);
	}
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }
    public function getAuthenticatedUser()
    {
            try {

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
    }




}
