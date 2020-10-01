<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Global()
 * @method static static Section()
 */
final class PassingGradeStatus extends Enum implements LocalizedEnum
{
    const Global = 1;
    const Section = 2;
}
