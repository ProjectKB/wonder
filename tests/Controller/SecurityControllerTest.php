<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    public function testDisplayConnection(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h2', 'Connexion');
    }

    public function testLoginWithBadCredentials(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form([
            'email' => 'fake@gmail.com',
            'password' => 'fake',
        ]);

        $client->submit($form);
        $this->assertResponseRedirects('/login');

        $client->followRedirect();
        $this->assertSelectorExists('.form-errors', 'Identifiants invalides.');
    }

    public function testSuccessfullLogin(): void
    {
        $client = static::createClient();
        $user = $client->getContainer()->get('doctrine.orm.entity_manager')
            ->getRepository(User::class)
            ->find(1);

        $client->loginUser($user);
        $client->request('GET', '/user');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h2', 'Page de profil');
    }


}
