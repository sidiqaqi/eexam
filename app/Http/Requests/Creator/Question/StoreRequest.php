<?php

namespace App\Http\Requests\Creator\Question;

use App\Enums\CorrectStatus;
use App\Enums\InputType;
use App\Rules\CorrectValue;
use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * @property mixed question_title
 * @property mixed question_value
 * @property mixed question_type
 * @property mixed question_image
 * @property mixed options
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
            'question_title' => [
                'required',
                'min:1',
                'max: 200',
            ],
            'question_value' => [
                'required',
                'min:10',
                'max: 255',
            ],
            'question_type' => [
                'required',
                Rule::in(InputType::getValues()),
            ],
            'question_image' => [
                'required_if:question_type,' . InputType::ImageUrl,
                'nullable',
                'active_url',
            ],
            'options' => [
                'bail',
                'required',
                'array',
                'min:2',
                'max:6',
                new CorrectValue(),
            ],
            'options.*.type' => [
                'required',
                Rule::in(InputType::getValues()),
            ],
            'options.*.value' => [
                'required_if:options.*.type,' . InputType::Text,
                'nullable',
                'distinct',
                'min:1',
                'max:200',
            ],
            'options.*.image' => [
                'required_if:options.*.type,' . InputType::ImageUrl,
                'nullable',
                'distinct',
                'active_url',
            ],
            'options.*.correct_id' => [
                'required',
                Rule::in(CorrectStatus::getValues()),
            ],
        ];
    }

    public function messages()
    {
        return [
            'question_image.required_if' => __('validation.required', ['attribute' => __('validation.attributes.question_image')]),
            'options.*.value.required_if' => __('validation.required', ['attribute' => __('validation.attributes.options')]),
            'options.*.image.required_if' => __('validation.required', ['attribute' => __('validation.attributes.options')]),
            'options.*.value.distinct' => __('validation.distinct', ['attribute' => __('validation.attributes.options')]),
            'options.*.image.distinct' => __('validation.distinct', ['attribute' => __('validation.attributes.options')]),
        ];
    }

    /**
     * @param Section $section
     * @return array
     */
    public function dataQuestion(Section $section)
    {
        return [
            'title' => $this->question_title,
            'value' => $this->question_value,
            'type' => $this->question_type,
            'image' => $this->question_image,
            'user_id' => Auth::id(),
            'section_id' => $section->id,
            'order' => $section->questions()->count() + 1,
        ];
    }

    /**
     * @return array
     */
    public function dataOptions()
    {
        return $this->options;
    }
}
