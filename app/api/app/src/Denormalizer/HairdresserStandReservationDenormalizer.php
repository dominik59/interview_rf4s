<?php

namespace App\Denormalizer;

use App\Entity\HairdresserStandReservation;
use Carbon\CarbonImmutable;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;
use Symfony\Component\Serializer\SerializerInterface;

class HairdresserStandReservationDenormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    /**
     * @var DenormalizerInterface
     */
    private DenormalizerInterface $decoratedNormalizer;

    public function __construct(NormalizerInterface $normalizer)
    {
        if (!$normalizer instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }

        $this->decoratedNormalizer = $normalizer;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return $this->decoratedNormalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $this->decoratedNormalizer->supportsDenormalization($data, $type, $format);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $arrayObject = $this->decoratedNormalizer->normalize($object, $format, $context);
        $start_hour = $arrayObject['start_hour'] ?? null;
        $end_hour = $arrayObject['end_hour'] ?? null;
        $date = $arrayObject['date'] ?? null;

        if ($start_hour) {
            $arrayObject['start_hour'] = CarbonImmutable::parse($start_hour)->format('H:i');
        }
        if ($end_hour) {
            $arrayObject['end_hour'] = CarbonImmutable::parse($end_hour)->format('H:i');
        }
        if ($date) {
            $arrayObject['date'] = CarbonImmutable::parse($date)->format('Y-m-d');
        }

        return $arrayObject;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $this->decoratedNormalizer->supportsNormalization($data, $format)
            && $data instanceof HairdresserStandReservation;
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if ($this->decoratedNormalizer instanceof SerializerAwareInterface) {
            $this->decoratedNormalizer->setSerializer($serializer);
        }
    }
}