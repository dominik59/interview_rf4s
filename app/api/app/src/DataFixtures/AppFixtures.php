<?php

namespace App\DataFixtures;

use App\Entity\HairdresserStand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 19; $i++) {
            $product = new HairdresserStand();
            $product->setName('stand ' . $i);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
