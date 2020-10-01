<?php

namespace App\Http\Requests\Creator\Section;

use App\Enums\PassingGradeStatus;
use App\Enums\ScoreStatus;
use App\Models\Config;
use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed exam
 */
class StoreRequest extends FormRequest
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
            'name' => 'required|min:10|max:150',
            'instruction' => 'required|min:10|max: 255',
            'score_per_question' => 'required|numeric|min:1|max:1000',
            'passing_grade' => 'required|numeric|min:1|max:100000',
        ];
    }

    /**
     * @param Exam $exam
     * @return array
     */
    public function data(Exam $exam)
    {
        return [
            'name' => $this->input('name'),
            'user_id' => Auth::id(),
            'exam_id' => $exam->id,
            'instruction' => $this->input('instruction'),
            'score_per_question' => $this->input('score_per_question'),
            'passing_grade' => $this->input('passing_grade'),
            'order' => (int) $exam->sections()->count() + 1,
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $config = Config::query()->where('exam_id', $this->exam->id)->first();

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
