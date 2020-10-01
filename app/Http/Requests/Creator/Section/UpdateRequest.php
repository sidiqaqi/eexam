<?php

namespace App\Http\Requests\Creator\Section;

use App\Enums\PassingGradeStatus;
use App\Enums\ScoreStatus;
use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Config;

/**
 * @property mixed section
 */
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
            'score_per_question' => 'required|numeric|min:1|max:1000',
            'passing_grade' => 'required|numeric|min:1|max:100000',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $config = Config::query()->where('exam_id', $this->section->exam_id)->first();

        if ($config->passing_grade_status !== PassingGradeStatus::Section) {
            $this->merge([
                'passing_grade' => 100,
            ]);
        }

        if ($config->score_status !== ScoreStatus::Section) {
            $this->merge([
                'score_per_question' => 10,
            ]);
        }
    }
}
