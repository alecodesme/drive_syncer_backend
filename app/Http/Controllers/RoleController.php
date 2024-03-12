<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use App\Models\Role;
use App\Http\Requests\RoleCreateRequest;

use Exception;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return $this->successResponse($roles);
    }

    public function store(RoleCreateRequest $request)
    {
        try {
            $role = Role::create(['name' => $request->get('name')]);
            return $this->successResponse($role, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return $this->errorResponse('Failed to create role', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
