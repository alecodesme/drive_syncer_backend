<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;

use Exception;


class UserController extends Controller
{
    public function store(UserCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->validated());
            DB::commit();
            return $this->successResponse($user, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollback();
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
