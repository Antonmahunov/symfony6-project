<?php

namespace App\DataFixtures;

use App\Entity\Micropost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $micropost = new Micropost();
            $micropost
                ->setText('Some random micropost ' . rand(1, 10))
                ->setTime(new \DateTime())
                ;

            $manager->persist($micropost);
        }

        $manager->flush();
    }
}