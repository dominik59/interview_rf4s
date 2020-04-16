<?php

namespace App\Validator\Constraint;

use Carbon\CarbonImmutable;
use DateTime;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class HourWithinOpeningHoursValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof HourWithinOpeningHours) {
            throw new UnexpectedTypeException($constraint, HourWithinOpeningHours::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!$value instanceof DateTime) {
            throw new UnexpectedValueException($value, 'string');
        }

        $carbon = CarbonImmutable::parse($value);
        $parsedMinutes = $carbon->format('H');

        if (
            ((int)$parsedMinutes) < ((int)$_ENV['OPENING_START_HOUR'])
            || ((int)$parsedMinutes) > ((int)$_ENV['OPENING_END_HOUR'])
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{time}}', $carbon->toIso8601String())
                ->addViolation();
        }
    }
}