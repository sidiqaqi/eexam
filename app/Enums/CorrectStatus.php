<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Publish()
 */
final class CorrectStatus extends Enum implements LocalizedEnum
{
    const False = 1;
    const True = 2;
}
