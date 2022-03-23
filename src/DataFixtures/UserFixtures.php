<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $om): void
    {
        $user = (new User())
            ->setEmail("test@gmail.com")
            ->setPassword("123456")
            ->setFirstname("Firstname")
            ->setLastname("Lastname")
            ->setPicture("https://randomuser.me/api/portraits/men/85.jpg");
        
        $om->persist($user);
        $om->flush();
    }
}
