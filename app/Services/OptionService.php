<?php

namespace App\Services;

use App\Enums\InputType;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class OptionService
{
    public static function storeOptions(Question $question, $options)
    {
        foreach ($options as $key => $option) {
            $data = [
                'user_id' => Auth::id(),
                'question_id' => $question->id,
                'type' => $option['type'],
                'value' => $option['type'] == InputType::Text ? $option['value'] : $option['image'],
                'correct_id' => $option['correct_id'],
                'order' => (int) $key + 1
            ];
            Option::create($data);
        }
    }

    public static function updateOptions(Question $question, $options)
    {
        $deleted = collect($options)->pluck('id');

        Option::where('question_id', $question->id)->whereNotIn('id', $deleted)->delete();

        foreach ($options as $key => $option) {
            $data = [
                'user_id' => Auth::id(),
                'question_id' => $question->id,
                'type' => $option['type'],
                'value' => $option['type'] == InputType::Text ? $option['value'] : $option['image'],
                'correct_id' => $option['correct_id'],
                'order' => (int) $key + 1
            ];
            if (isset( $option['id'])) {
                Option::updateOrcreate(['id' => $option['id']], $data);
            } else {
                Option::create($data);
            }
        }
    }
}
