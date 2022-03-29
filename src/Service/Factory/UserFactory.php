<?php

namespace App\Service\Factory;

use App\Entity\User;

class UserFactory
{
    public static function getValidUser(): User
    {
        return (new User())
            ->setEmail("valid@gmail.com")
            ->setPassword("123456")
            ->setFirstname("Firstname")
            ->setLastname("Lastname")
            ->setPicture("https://randomuser.me/api/portraits/men/85.jpg");
    }

    public static function getInvalidUser(): User
    {
        return (new User())
            ->setEmail("")
            ->setPassword("")
            ->setFirstname("")
            ->setLastname("")
            ->setPicture("");
    }
}