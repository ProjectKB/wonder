<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(User::class)->find(1);
        $question = (new Question())
            ->setTitle("Pourquoi la mer est salee ?")
            ->setContent("Ac tortor dignissim convallis aenean. Diam vulputate ut pharetra sit amet aliquam. Dolor purus non enim praesent elementum facilisis. At in tellus integer feugiat scelerisque varius morbi enim.")
            ->setNbrOfResponse(0)
            ->setRating(0)
            ->setAuthor($user)
            ->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($question);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
