<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OnlyFullOrHalfHour extends Constraint
{
    public $message = 'Provided time {{time}} is not full or half hour.';
}