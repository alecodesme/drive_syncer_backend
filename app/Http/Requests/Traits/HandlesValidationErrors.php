<?php

namespace App\Http\Requests\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait HandlesValidationErrors
{
    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors()->messages())->flatten()->toArray();

        $response = [
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors,
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}