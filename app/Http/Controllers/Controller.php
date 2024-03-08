<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function successResponse($data, $statusCode = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $statusCode);
    }

    protected function errorResponse($message, $statusCode)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}
