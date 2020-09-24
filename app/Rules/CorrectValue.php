<?php

namespace App\Rules;

use App\Enums\CorrectStatus;
use Illuminate\Contracts\Validation\Rule;

class CorrectValue implements Rule
{
    public $exist;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->exist = 0;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $item) {
            if (!isset($item['correct_id'])) {
                return false;
            }

            if ($item['correct_id'] == CorrectStatus::True) {
                $this->exist ++;
            }
        }
        return $this->exist == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.correct_value');
    }
}
