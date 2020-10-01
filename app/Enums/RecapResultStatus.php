<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Passed()
 * @method static static Failed()
 */
final class RecapResultStatus extends Enum implements LocalizedEnum
{
    const Passed = 1;
    const Failed = 2;
}
