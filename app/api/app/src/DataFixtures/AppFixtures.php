<?php

namespace App\DataFixtures;

use App\Entity\HairdresserStand;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * This const has been added for tests purposes. It allows to ensure that test will use test purpose user email.
     */
    public const USER_EMAIL = 'test@example.com';

    /**
     * This const has been added for tests purposes. It allows to ensure that test will use test purpose user password.
     */
    public const USER_PASSWORD = '0123456789';

    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 19; $i++) {
            $product = new HairdresserStand();
            $product->setName('stand ' . $i);
            $manager->persist($product);
        }

        $user = new User();
        $user->setEmail(static::USER_EMAIL);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, static::USER_PASSWORD));
        $manager->persist($user);

        $manager->flush();
    }
}
