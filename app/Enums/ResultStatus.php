<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static False()
 * @method static static True()
 */
final class ResultStatus extends Enum implements LocalizedEnum
{
    const Show = 1;
    const Hide = 2;
}
