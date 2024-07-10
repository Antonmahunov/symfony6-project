<?php

namespace App\DataFixtures;

use App\Entity\Micropost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const USERS = [
        [
            'username' => 'john_doe',
            'email' => 'john_doe@doe.com',
            'password' => 'john123',
            'fullName' => 'John Doe',
        ],
        [
            'username' => 'rob_smith',
            'email' => 'rob_smith@smith.com',
            'password' => 'rob12345',
            'fullName' => 'Rob Smith',
        ],
        [
            'username' => 'marry_gold',
            'email' => 'marry_gold@gold.com',
            'password' => 'marry12345',
            'fullName' => 'Marry Gold',
        ],
    ];

    private const POST_TEXT = [
        'Hello, how are you?',
        'It\'s nice sunny weather today',
        'I need to buy some ice cream!',
        'I wanna buy a new car',
        'There\'s a problem with my phone',
        'I need to go to the doctor',
        'What are you up to today?',
        'Did you watch the game yesterday?',
        'How was your day?'
    ];

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
        $this->loadMicropost($manager);
    }

    public function loadMicropost(ObjectManager $manager): void
    {
        for ($i = 0; $i < 30; $i++) {
            $micropost = new Micropost();
            $date = new \DateTime();
            $date->modify('-' . rand(0, 10) . ' day' );
            $micropost
                ->setText(self::POST_TEXT[rand(0,count(self::POST_TEXT)-1)])
                ->setTime(new \DateTime())
                ->setUser($this->getReference('jdoe'))
            ;

            $manager->persist($micropost);
        }

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager): void
    {
        $user = new User();
        foreach (self::USERS as $userData) {

            $user
                ->setUsername($userData['username'])
                ->setPassword($this->userPasswordHasher->hashPassword($user, 'jdoe123'))
                ->setFirstname($userData['firstname'])
                ->setLastname($userData['lastname'])
                ->setEmail($userData['email']);

            $this->addReference($userData['username'], $user);

            $manager->persist($user);
        }

        $manager->flush();

    }

}