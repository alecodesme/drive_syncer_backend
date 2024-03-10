<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\HandlesValidationErrors;

class RoleCreateRequest extends FormRequest
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
            'name' => 'required|string|unique:roles',
        ]
        ;
    }

    public function messages() : array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name already exists',
        ];
    }
}
