<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthenticationRequest $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = User::where('email', $request->get('email'))->first();
                return $this->successResponse([
                    'user' => $user,
                    'token' => $user->createToken("CLOUD_FILES")->plainTextToken
                ], Response::HTTP_OK);
            } else {
                return $this->errorResponse('Invalid data or user didnt found', Response::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $exception) {
            return $exception;
            return $this->errorResponse('Internal Server Error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
