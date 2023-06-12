<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => 'required|string|unique:categories',
            'code' => 'required|string|unique:categories',
            'status' => 'required|integer',
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
