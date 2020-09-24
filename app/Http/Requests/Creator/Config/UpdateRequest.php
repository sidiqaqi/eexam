<?php

namespace App\Http\Requests\Creator\Config;

use App\Enums\AnswerOrderStatus;
use App\Enums\QuestionOrderStatus;
use App\Enums\RankingStatus;
use App\Enums\ResultStatus;
use App\Enums\TimeMode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'time_mode' => [
                'required',
                Rule::in(TimeMode::getValues())
            ],
            'time_limit' => [
                'required_if:time_mode,'.TimeMode::TimeLimit,
                'nullable',
                'numeric',
                'min:5',
                'max:360',
            ],
            'question_order' => [
                'required',
                Rule::in(QuestionOrderStatus::getValues()),
            ],
            'answer_order' => [
                'required',
                Rule::in(AnswerOrderStatus::getValues()),
            ],
            'result_status' => [
                'required',
                Rule::in(ResultStatus::getValues()),
            ],
            'ranking_status' => [
                'required',
                Rule::in(RankingStatus::getValues()),
            ]
        ];
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'time_limit' => $this->time_limit,
            'time_mode' => $this->time_mode,
            'question_order' => $this->question_order,
            'answer_order' => $this->answer_order,
            'result_status' => $this->result_status,
            'ranking_status' => $this->ranking_status,
        ];
    }
}
