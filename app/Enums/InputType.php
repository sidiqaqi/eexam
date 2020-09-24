<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Publish()
 */
final class InputType extends Enum implements LocalizedEnum
{
    const Text = 1;
    const ImageUrl = 2;
}
