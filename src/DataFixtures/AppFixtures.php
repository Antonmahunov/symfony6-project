<?php

namespace App\DataFixtures;

use App\Entity\Micropost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(
        UserPasswordHasherInterface $userPasswordHasher,
    )
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
//        $this->loadMicropost($manager);
    }

    public function loadMicropost(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $micropost = new Micropost();
            $micropost
                ->setText('Some random micropost ' . rand(1, 10))
                ->setTime(new \DateTime());

            $manager->persist($micropost);
        }

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setUsername('jdoe')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'jdoe123'))
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setEmail('jdoe@example.com');
    }
}