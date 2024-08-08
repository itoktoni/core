<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class NotificationType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    const Success = 'success';
    const Warning = 'warning';
    const Info = 'info';
    const Question = 'question';
    const Error = 'error';
}
