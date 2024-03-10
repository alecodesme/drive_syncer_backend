<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Traits\HandlesValidationErrors;
use Illuminate\Contracts\Validation\Validator;


class UserCreateRequest extends FormRequest
{

    use HandlesValidationErrors;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'The name field is required.',
            'lastname.required' => 'The lastname field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }
}
