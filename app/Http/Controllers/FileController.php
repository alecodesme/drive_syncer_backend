<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Models\File;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function index()
    {
    }
    public function store(CreateFileRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->only('user_id'));
            if (!$user) {
                return $this->errorResponse('User not found', Response::HTTP_NOT_FOUND);
            }

            DB::commit();
            $newFile = File::create($request->validated());
            return $this->successResponse($newFile, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update()
    {
    }
    public function delete()
    {
    }
    public function addFileToFolder()
    {
    }
}
