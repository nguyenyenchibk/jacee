<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'required', 'string',
                Rule::unique('categories')->ignore($this->category)
            ],
            'name' => [
                'required', 'string',
                Rule::unique('categories')->ignore($this->category)
            ],
            'status' => 'required|integer',
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
