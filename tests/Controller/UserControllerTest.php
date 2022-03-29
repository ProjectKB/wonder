<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testUserPageIsRestricted(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user');

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testWhenUnloggedUserPageRedirectToLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user');

        $this->assertResponseRedirects('/login');
    }
}
