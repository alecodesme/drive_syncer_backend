<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Exception;




class RoleController extends Controller
{
    public function index() 
    {
        $roles = Role::all();
        return $this->successResponse($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $roleName = $request->input('name');
    
        $existingRole = Role::where('name', $roleName)->first();
    
        if ($existingRole) {
            return $this->errorResponse('The role already exists', Response::HTTP_CONFLICT);
        }
    
        try {
            $role = Role::create(['name' => $roleName]);
            return $this->successResponse($role, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return $this->errorResponse('Failed to create role', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
