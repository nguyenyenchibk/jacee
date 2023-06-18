<?php

namespace App\Http\Requests\Teacher\Test;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'name' => 'required|string',
            'status' => 'required|integer',
            'validate_date' => 'string',
            'interval' => 'integer',
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
