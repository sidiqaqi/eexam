<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Publish()
 */
final class ExamStatus extends Enum implements LocalizedEnum
{
    const Draft = 1;
    const Publish = 2;
}
