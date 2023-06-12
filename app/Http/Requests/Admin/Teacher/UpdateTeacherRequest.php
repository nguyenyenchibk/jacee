<?php

namespace App\Http\Requests\Admin\Teacher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('teachers')->ignore($this->teacher)
            ],
            "password" => 'required|confirmed|min:8',
            'status' => 'required|integer'
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
