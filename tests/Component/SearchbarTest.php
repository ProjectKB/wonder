<?php

namespace App\Tests\Component;

require './vendor/autoload.php';

use App\Entity\Question;
use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class SearchbarTest extends PantherTestCase
{
    public function testSearchBar(): void
    {

        $client = Client::createFirefoxClient('./tests/driver/geckodriver');



//        $question = $this->getContainer()->get('doctrine.orm.entity_manager')
//            ->getRepository(Question::class)
//            ->find(1);
//
        $crawler = $client->request('GET', '/');
        $client->getWebDriver()->findElement(WebDriverBy::id('headerSearchbar'));
//
//        var_dump($question->getTitle());
    }
}
