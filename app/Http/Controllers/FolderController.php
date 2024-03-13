<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChildFolderRequest;
use App\Http\Requests\CreateFolderRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Folder;
use Exception;

class FolderController extends Controller
{
    public function index()
    {
        return $this->successResponse(Folder::all(), Response::HTTP_OK);
    }
    public function store(CreateFolderRequest $request)
    {
        DB::beginTransaction();
        try {

            $validatedData = $request->validated();

            $existingFolder = Folder::where('name', $validatedData['name'])->first();

            if ($existingFolder) {
                $validatedData['name'] = $validatedData['name'] . ' Copy';
            }

            $folder = Folder::create($validatedData);

            DB::commit();
            return $this->successResponse($folder, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollback();
            return $this->errorResponse('Failed to create folder', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function createChildFolder(CreateChildFolderRequest $request)
    {
        DB::beginTransaction();
        try {
            $parentFolderId = Folder::find($request->get('parent_folder_id'));

            $validatedData = $request->validated();

            $existingFolder = Folder::where('name', $validatedData['name'])
                ->whereNotNull('parent_folder_id')->first();

            if (!$parentFolderId) {
                $this->errorResponse('Folder parent id not found', Response::HTTP_NOT_FOUND);
            }

            if ($existingFolder && $existingFolder->isChild()) {
                $validatedData['name'] = $validatedData['name'] . ' Copy';
            }

            $childFolder = Folder::create($validatedData);

            DB::commit();
            return $this->successResponse($childFolder, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollback();
            return $this->errorResponse('Failed to create child folder', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit($id)
    {
    }
    public function delete($id)
    {
    }
}
