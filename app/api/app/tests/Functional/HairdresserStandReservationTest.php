<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\AppFixtures;
use App\Entity\HairdresserStandReservation;
use Doctrine\Common\Annotations\Annotation\IgnoreAnnotation;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\HttpFoundation\Response;

class HairdresserStandReservationTest extends ApiTestCase
{
    use FixturesTrait;

    public function testReserveHairdresserStandInProperHours(): void
    {
        //given
        $this->loadFixtures([
            AppFixtures::class
        ]);
        $userToken = $this->getUserToken();

        //when
        static::createClient()->request('POST', '/api/hairdresser_stand_reservations', [
            'json' => [
                'start_hour' => '08:00',
                'end_hour' => '20:00',
                'hairdresserStand' => '/api/hairdresser_stands/1',
                'date' => '01-01-2020'
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $userToken,
                'Content-Type' => 'application/ld+json'
            ]
        ]);

        //then
        self::assertResponseIsSuccessful();
        self::assertJsonEquals([
            '@context' => '/api/contexts/HairdresserStandReservation',
            '@id' => '/api/hairdresser_stand_reservations/1',
            '@type' => 'HairdresserStandReservation',
            'start_hour' => '08:00',
            'end_hour' => '20:00',
            'id' => 1,
            'hairdresserStand' => '/api/hairdresser_stands/1',
            'user' => '/api/users/1',
            'date' => '2020-01-01',
        ]);
        self::assertMatchesResourceItemJsonSchema(HairdresserStandReservation::class);
    }

    public function testReserveOneHairdresserStandBeforeOpen(): void
    {
        //given
        $this->loadFixtures([
            AppFixtures::class
        ]);
        $userToken = $this->getUserToken();

        //when
        static::createClient()->request('POST', '/api/hairdresser_stand_reservations', [
            'json' => [
                'start_hour' => '00:00',
                'end_hour' => '20:00',
                'hairdresserStand' => '/api/hairdresser_stands/1',
                'date' => '01-01-2020'
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $userToken,
                'Content-Type' => 'application/ld+json'
            ]
        ]);

        //then
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testReserveOneHairdresserStandAfterClose(): void
    {
        //given
        $this->loadFixtures([
            AppFixtures::class
        ]);
        $userToken = $this->getUserToken();

        //when
        static::createClient()->request('POST', '/api/hairdresser_stand_reservations', [
            'json' => [
                'start_hour' => '09:00',
                'end_hour' => '21:00',
                'hairdresserStand' => '/api/hairdresser_stands/1',
                'date' => '01-01-2020'
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $userToken,
                'Content-Type' => 'application/ld+json'
            ]
        ]);

        //then
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function testReserveOneHairdresserStandNotFullOrHalfHour(): void
    {
        //given
        $this->loadFixtures([
            AppFixtures::class
        ]);
        $userToken = $this->getUserToken();

        //when
        static::createClient()->request('POST', '/api/hairdresser_stand_reservations', [
            'json' => [
                'start_hour' => '09:01',
                'end_hour' => '19:00',
                'hairdresserStand' => '/api/hairdresser_stands/1',
                'date' => '01-01-2020'
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $userToken,
                'Content-Type' => 'application/ld+json'
            ]
        ]);

        //then
        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

    public function getUserToken()
    {
        $response = static::createClient()->request('POST', '/authentication_token', [
            'json' => [
                'email' => AppFixtures::USER_EMAIL,
                'password' => AppFixtures::USER_PASSWORD
            ]
        ]);

        $responseContent = $response->toArray();

        return $responseContent['token'];
    }
}
