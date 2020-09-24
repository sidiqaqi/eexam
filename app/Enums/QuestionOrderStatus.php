<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Sequence()
 * @method static static Random()
 */
final class QuestionOrderStatus extends Enum implements LocalizedEnum
{
    const Sequence = 1;
    const Random = 2;
}
