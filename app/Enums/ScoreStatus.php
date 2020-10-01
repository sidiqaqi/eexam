<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Global()
 * @method static static Section()
 * @method static static Question()
 */
final class ScoreStatus extends Enum implements LocalizedEnum
{
    const Global = 1;
    const Section = 2;
    const Question = 3;
}
