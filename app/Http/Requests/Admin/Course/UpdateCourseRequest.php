<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'name' => [
                'required', 'string',
                Rule::unique('courses')->ignore($this->course)
            ],
            'code' => [
                'required', 'string',
                Rule::unique('courses')->ignore($this->course)
            ],
            'status' => 'required|integer',
            'started_at' => 'string',
            'ended_at' => 'string',
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
