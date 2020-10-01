<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static RecapAndResult()
 * @method static static ResultOnly()
 * @method static static HideAll()
 */
final class ResultStatus extends Enum implements LocalizedEnum
{
    const RecapAndResult = 1;
    const ResultOnly = 2;
    const HideAll = 3;
}
