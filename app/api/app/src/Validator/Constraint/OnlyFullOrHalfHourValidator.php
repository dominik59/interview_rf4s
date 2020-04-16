<?php

namespace App\Validator\Constraint;

use Carbon\CarbonImmutable;
use DateTime;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class OnlyFullOrHalfHourValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof OnlyFullOrHalfHour) {
            throw new UnexpectedTypeException($constraint, OnlyFullOrHalfHour::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!$value instanceof DateTime) {
            throw new UnexpectedValueException($value, 'string');
        }

        $carbon = CarbonImmutable::parse($value);
        $parsedMinutes = $carbon->format('i');

        if ($parsedMinutes !== '00' && $parsedMinutes !== '30') {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{time}}', $carbon->toIso8601String())
                ->addViolation();
        }
    }
}