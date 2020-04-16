<?php


namespace App\Validator\Constraint;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HourWithinOpeningHours extends Constraint
{
    public $message = 'Provided time {{time}} is not within opening hours.';
}