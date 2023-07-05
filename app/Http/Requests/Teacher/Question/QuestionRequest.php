<?php

namespace App\Http\Requests\Teacher\Question;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question' => 'required',
            'status' => 'required|integer',
            'score' => 'integer',
            'answers.*.answer' => 'required',
            'answers.*.is_correct' => 'present'
        ];
    }

    public function validate()
    {
        return $this->all();
    }
}
