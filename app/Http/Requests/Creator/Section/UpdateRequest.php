<?php

namespace App\Http\Requests\Creator\Section;

use App\Exam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('section')->user_id == Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:10|max:150',
            'instruction' => 'required|min:10|max: 255',
            'score_per_question' => 'required|numeric',
            'passing_grade' => 'required|numeric',
        ];
    }
}
