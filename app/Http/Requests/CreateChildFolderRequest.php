<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\HandlesValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class CreateChildFolderRequest extends FormRequest
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
            'status' => 'required',
            'user_id' => 'required',
            'parent_folder_id' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'status.required' => 'Status is required',
            'user_id.requird' => 'User id is required',
            'parent_folder_id' => 'Parent folder is required'
        ];
    }
}
