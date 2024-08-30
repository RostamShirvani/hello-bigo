<?php

namespace App\Enums;

class EPaymentPinStatus extends BaseEnum
{
    const UNUSED = 1;
    const USED = 2;
    const REJECTED = 3;
}
