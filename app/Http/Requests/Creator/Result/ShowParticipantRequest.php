<?php

namespace App\Http\Requests\Creator\Result;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;

/**
 * @property mixed participant
 */
class ShowParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $exam = Exam::find($this->participant->exam_id);

        return $exam->user_id == Auth::id() && $this->participant->finish_at;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
