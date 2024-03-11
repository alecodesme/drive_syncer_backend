<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Models\Role;

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
    public function show($id)
    {
        $user = User::with('roles')->find($id);

        if (!$user) {
            return $this->errorResponse("User not found", Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($user, Response::HTTP_OK);
    }
    public function assignRole($userId, $roleId){
        DB::beginTransaction();
        try {
            $user = User::find($userId);
            $role = Role::find($roleId);

            if(!$user){
                return $this->errorResponse("User not found", Response::HTTP_NOT_FOUND);
            }

            if(!$role){
                return $this->errorResponse("Role not found", Response::HTTP_NOT_FOUND);
            }

            if ($user->roles->contains($role)) {
                return $this->errorResponse('User already has this role', 422);
            }

            $user->roles()->attach($role);
            DB::commit();
            return $this->successResponse("Role assigned succesfully", Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollback();
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
