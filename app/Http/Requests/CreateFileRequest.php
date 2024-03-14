<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\HandlesValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class CreateFileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required',
            'size' => 'required',
            'type_file' => 'required',
            'user_id' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name field is required',
            'size.required' => 'Size field is required',
            'type_file.required' => 'Type file is required',
            'user_id.required' => 'User id is required',
            'user_id.number' => 'User id needs to be a number',
        ];
    }
}
