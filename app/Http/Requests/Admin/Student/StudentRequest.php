<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'email' => 'required|email|unique:students|max:255',
            "password" => 'required|confirmed|min:8',
            'status' => 'required|integer'
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
