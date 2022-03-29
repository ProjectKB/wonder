<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Service\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UserEntityTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $this->validator = self::getContainer()->get('validator');
    }

    public function assertHasErrors(User $user, int $errorCountExpected): void
    {
        $errorCount = $this->validator->validate($user);
        $this->assertCount($errorCountExpected, $errorCount);
    }

    public function testValidUser(): void
    {
        $this->assertHasErrors(UserFactory::getValidUser(), 0);
    }

    public function testInvalidUser(): void
    {
        $this->assertHasErrors(UserFactory::getInvalidUser(), 5);
    }
}
