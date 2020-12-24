<?php

namespace App\enum;

use Spatie\Enum\Enum;

/**
 * @method static self tenK()
 * @method static self fiftyK()
 * @method static self hundredK()
 */

class Value extends Enum
{
    const MAP_VALUE = [
        'tenK' => 10000,
        'fiftyK' => 50000,
        'hundredK' => 100000
    ];
}
